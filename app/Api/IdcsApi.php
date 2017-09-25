<?php

namespace App\Api;

use App\CreditUrl;
use \Illuminate\Contracts\Auth\Authenticatable;

class IdcsApiException extends \Exception {}

class IdcsApi
{
    private $user = null;

    /**
     * @var bool Flag on whether to save an existing URL to the CreditUrl model
     */
    private $saveExistingUrl = false;

    private $endpoints = [
        "enroll" => "http://xml.idcreditservices.com/IDSWebServicesNG/IDSEnrollment.asmx?WSDL",
        "getCreditUrl" => "https://xml.idcreditservices.com/SIDUpdateServices/MemberUpdate.asmx?WSDL"
    ];

    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
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

                throw new IdcsApiException("You are already enrolled.");
            }

            if ($result->ErrorCode == "IDSW_603_F") {
                // email already used on another enrollment
                throw new IdcsApiException("Email already in use.");
            }
        }

        return $credit_url;
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
