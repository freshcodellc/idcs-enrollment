<?php

namespace App\Api;

use App\CreditUrl;
use \Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class IdcsApiException extends \Exception {}

class IdcsApi
{
    private $user = null;

    /**
     * @var bool Flag on whether to save an existing URL to the CreditUrl model
     */
    private $saveExistingUrl = false;

    private $endpoints = [
        "AlertCenter" => "https://xml.idcreditservices.com/rest/api/alerts/AlertCenter?type=json",
        "CreditScoreHistory" => "https://xml.idcreditservices.com/rest/api/alerts/CreditScoreHistory?type=json",
        "cancel" => "https://xml.idcreditservices.com/PartnerWebServices/UpdateStatusRequest.asmx?WSDL",
        "enroll" => "https://xml.idcreditservices.com/IDSWebServicesNG/IDSEnrollment.asmx?WSDL",
        "enrollDataMonitoring" => "https://xml.idcreditservices.com/IDSWebServicesNG/IDSDataMonitoring.asmx?WSDL",
        "getCreditUrl" => "https://xml.idcreditservices.com/SIDUpdateServices/MemberUpdate.asmx?WSDL"
    ];

    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function getAlertCenterReport() {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $this->endpoints['AlertCenter'], [
            'verify' => env('APP_ENV') == "local" ? false : true,
            'json' => [
                "memberId" => $this->user->uuid,
                "partnerAccount" => env('IDCS_USERNAME'),
                "partnerCode" => env('IDCS_USERNAME'),
                "partnerPassword" => env('IDCS_PASSWORD')
            ]
        ]);

        $result = json_decode($response->getBody()->getContents());

        //dd($result);
        if ($result->Response->Status == "SUCCESS") {
            return $result->Response->Report;
        } else {
            Log::error("Error getting Alert Center on user id {$this->user->id} -- " . $result->Response->ErrorCode . ": " . $result->Response->ErrorMessage);
            throw new IdcsApiException($result->Response->ErrorCode . ": " . $result->Response->ErrorMessage);
        }
    }

    public function getCreditScoreHistory() {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $this->endpoints['CreditScoreHistory'], [
            'verify' => env('APP_ENV') == "local" ? false : true,
            'json' => [
                "memberId" => $this->user->uuid,
                "partnerAccount" => env('IDCS_USERNAME'),
                "partnerCode" => env('IDCS_USERNAME'),
                "partnerPassword" => env('IDCS_PASSWORD')
            ]
        ]);

        $result = json_decode($response->getBody()->getContents());

        if ($result->Response->Status == "SUCCESS") {
            return $result->Response->DataPoints;
        } else {
            Log::error("Error getting Credit Score History on user id {$this->user->id} -- " . $result->Response->ErrorCode . ": " . $result->Response->ErrorMessage);
            throw new IdcsApiException($result->Response->ErrorCode . ": " . $result->Response->ErrorMessage);
        }
    }

    public function cancel() {
        $client = new \SoapClient($this->endpoints['cancel'], array(
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'soap_version' => SOAP_1_2,
            //'use' => SOAP_LITERAL
            //'features' => SOAP_SINGLE_ELEMENT_ARRAYS
        ));

        $xml = '<MPIUpdateStatusRequest xmlns="request.reactiveuser.xml.mpi" xmlns:ac="addresstype.common.xml.mpi" xmlns:cm="common.xml.mpi" xmlns:ct="customerinfotype.common.xml.mpi" xmlns:ec="emailtype.common.xml.mpi" xmlns:n1="mpi.xml.common.addresstype" xmlns:nt="nametype.common.xml.mpi" xmlns:pt="partnerinfotype.common.xml.mpi" xmlns:ns1="phonetype.common.xml.mpi" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="request.reactiveuser.xml.mpi">';
        $xml .= '<GUID>' . uniqid() . '</GUID>';
        $xml .= '<Transaction>Cancel</Transaction>';
        $xml .= '<CustomerId>' . $this->user->uuid . '</CustomerId>';
        $xml .= '<PartnerAccountInfo>';
        $xml .= '<pt:PartnerName>' . env('IDCS_USERNAME') . '</pt:PartnerName>';
        $xml .= '<pt:PartnerAccount>' . env('IDCS_USERNAME') . '</pt:PartnerAccount>';
        $xml .= '<pt:PartnerPassword>' . env('IDCS_PASSWORD') . '</pt:PartnerPassword>';
        $xml .= '<pt:ServerDate>' . gmdate("Y-m-d\TH:i:s\Z") . '</pt:ServerDate>';
        $xml .= '</PartnerAccountInfo>';
        $xml .= '</MPIUpdateStatusRequest>';

        try {
            $parameters = new \stdClass();
            $parameters->customerStatusInformation = $xml;

            $response_soap = $client->UpdateCustomerStatus($parameters);

            $result = (array) $response_soap;
            $status_sf = $result["UpdateCustomerStatusResult"];

            if (stristr($status_sf, "SUCCESS")) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage() . " on user with ID #" . $this->user->id;
            Log::error($msg);

            return false;
        }
    }

    public function enrollDataMonitoring() {
        $client = new \SoapClient($this->endpoints['enrollDataMonitoring'], array(
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'soap_version' => SOAP_1_2,
            //'use' => SOAP_LITERAL
            //'features' => SOAP_SINGLE_ELEMENT_ARRAYS
        ));

        $parameters = [
            "Product" => [
                "ProductUser" => [
                    "Memberid" => $this->user->uuid
                ]
            ],
            "MonitorRequest" => [],
            "Partner" => [
                "partnerAccount" => env('IDCS_USERNAME'),
                "partnerCode" => env('IDCS_USERNAME'),
                "partnerPassword" => env('IDCS_PASSWORD')
            ]
        ];


        $xml = new \SimpleXMLElement("<Request></Request>");

        $this->array_to_xml($parameters, $xml);
        $raw_xml = $xml->asXML();
        $raw_xml = trim(str_replace('<?xml version="1.0"?>', '', $raw_xml));

        $parameters = [
            'xmlRequest' => [
                'any' => new \SoapVar($raw_xml, XSD_ANYXML)
            ]
        ];

        $result_xml = $client->IDSDataEnrollmentXML($parameters);

        $result = new \SimpleXMLElement($result_xml->IDSDataEnrollmentXMLResult->any);
        if (isset($result->ErrorCode) || isset($result->ErrorMessage)) {
            Log::error("Error enrolling data monitoring on user id {$this->user->id} -- " . $result->ErrorCode . ": " . $result->ErrorMessage);
            return false;
        }
        return true;
    }

    /**
     * Enroll user with IDCS
     *
     * @return CreditUrl
     * @throws \Exception
     */
    public function enroll()
    {
        $client = new \SoapClient($this->endpoints['enroll'], array(
            'login' => env('IDCS_USERNAME'),
            'password' => env('IDCS_PASSWORD'),
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'soap_version' => SOAP_1_2,
            //'use' => SOAP_LITERAL
            //'features' => SOAP_SINGLE_ELEMENT_ARRAYS
        ));

        $parameters = $this->getEnrollParameters();

        try {
            $result_xml = $client->IDSEnrollmentXML($parameters);

            if (env("APP_DEBUG")) {
                echo "<h3>RESULT:</h3><pre>";
                print_r($result_xml);
                echo "</pre>";
            }

        } catch (\Exception $e) {
            if (env("APP_DEBUG")) {
                echo "<h3>EXCEPTION:</h3>";
                echo $e->getMessage(). " on " . $e->getFile(). ":".$e->getLine();

                echo "<h3>REQUEST:</h3><pre>";
                echo $client->__getLastRequestHeaders();
                echo htmlentities($client->__getLastRequest());
                echo "</pre>";
            } else {
                throw $e;
            }
        }

        // Save Credit URL for user
        $result = new \SimpleXMLElement($result_xml->IDSEnrollmentXMLResult->any);
        if (env("APP_DEBUG")) {
            echo "<h3>RESULT out of XML:</h3><pre>";
            print_r($result);
            echo "</pre>";
        }

        $errors = [];
        $credit_url = new CreditUrl;

        if ($result->Status == "SUCCESS" && isset($result->CreditReportInfo->CreditReportUrl)) {
            $credit_url->url = $result->CreditReportInfo->CreditReportUrl;
            $credit_url->sale_id = $result->SaleId;
            $credit_url->user_id = $this->user->id;
            $credit_url->save();
        } else {
            // fail response
            if ($result->ErrorCode == "PART_608_F") {
                // duplicate memberId, so lets get the existing credit url

                //TODO: Get existing Credit URL for user and update
                // this is broke
                // --> $this->getExistingCreditUrl();
                Log::notice("User id {$this->user->id} is already enrolled. Credit URL might be missing.");
            }

            if ($result->ErrorCode == "IDSW_603_F") {
                // email already used on another enrollment
                $error = "Email ({$this->user->email}) is already in use on another enrollment";
                $errors[] = $error;
                Log::error($error);
            }
        }

        return [
            'credit_url' => $credit_url,
            'errors' => $errors
        ];
    }

    public function getExistingCreditUrl()
    {
        $client = new \SoapClient($this->endpoints['getCreditUrl'], array(
            'login' => env('IDCS_USERNAME'),
            'password' => env('IDCS_PASSWORD'),
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'soap_version' => SOAP_1_2,
            //'use' => SOAP_LITERAL
            //'features' => SOAP_SINGLE_ELEMENT_ARRAYS
        ));

        //dd($client->__getTypes());
        //dd($client->__getFunctions());

        $parameters = [
            "partnerAccount" => env("IDCS_USERNAME"),
            "partnerPassword" => env("IDCS_PASSWORD"),
            "MemberId" => $this->user->uuid
        ];

        $xml = new \SimpleXMLElement("<GetCreditURL></GetCreditURL>");

        $this->array_to_xml($parameters, $xml);
        $raw_xml = $xml->asXML();
        $raw_xml = trim(str_replace('<?xml version="1.0"?>', '', $raw_xml));

        $parameters = new \SoapVar($raw_xml, XSD_ANYXML);

        //$parameters = json_decode(json_encode($parameters));
        //dd($parameters);

        try {
            // THIS IS BROKE TOO
            $result_xml = $client->GetCreditURL($parameters);

            echo "<h3>RESULT:</h3><pre>";
            print_r($result_xml);
            echo "</pre>";

            if ($this->saveExistingUrl) {
                // TODO: Save existing URL to user
            }

            return $result_xml;
        } catch (\Exception $e) {
            if (env("APP_DEBUG")) {
                echo "<h3>EXCEPTION:</h3>";
                echo $e->getMessage(). " on " . $e->getFile(). ":".$e->getLine();

                echo "<h3>REQUEST:</h3><pre>";
                echo $client->__getLastRequestHeaders();
                echo htmlentities($client->__getLastRequest());
                echo "</pre>";
            } else {
                throw $e;
            }
        }
    }

    /**
     * Get parameters to enroll with IDCS
     *
     * @return array
     */
    private function getEnrollParameters()
    {
        // array we need to convert to XML
        $parameters = [
            "RequestSource" => "PartnerCode",
            "Product" => [
                "PackageId" => env('IDCS_PACKAGE'),
                "ProductUser" => [
                    "Memberid" => $this->user->uuid,
                    "EmailAddress" => $this->user->email,
                    "Password" => str_random(12),
                    "Address" => [
                        "Address1" => $this->user->address,
                        "Address2" => "",
                        "City" => $this->user->city,
                        "State" => $this->user->state,
                        "ZipCode" => $this->user->zip,
                    ],
                    "Phone" => [
                        "PhoneNumber" => $this->user->phone,
                        "PhoneType" => "Home"
                    ],
                    "Person" => [
                        "FirstName" => $this->user->first_name,
                        "LastName" => $this->user->last_name,
                        "MiddleName" => ""
                    ]
                ]
            ],
            "Partner" => [
                "partnerAccount" => env('IDCS_USERNAME'),
                "partnerCode" => env('IDCS_USERNAME'),
                "partnerPassword" => env('IDCS_PASSWORD'),
                "Branding" => env('IDCS_USERNAME')
            ]
        ];


        $xml = new \SimpleXMLElement("<Request></Request>");

        $this->array_to_xml($parameters, $xml);
        $raw_xml = $xml->asXML();
        $raw_xml = trim(str_replace('<?xml version="1.0"?>', '', $raw_xml));

        $parameters = [
            'xmlRequest' => [
                'any' => new \SoapVar($raw_xml, XSD_ANYXML)
            ]
        ];

        return $parameters;
    }

    /**
     * Convert an array to XML
     */
    private function array_to_xml($array, &$xml_user_info)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_user_info->addChild("item$key");
                    $this->array_to_xml($value, $subnode);
                }
            } else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}
