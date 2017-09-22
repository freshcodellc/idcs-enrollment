<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CreditUrl;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit_urls = CreditUrl::where('user_id', Auth::user()->id)->get();

        if (count($credit_urls) == 0) {
            //$this->enroll();
        }

        return view('home', [
            'credit_urls' => $credit_urls
        ]);
    }

    public function enroll()
    {
        $client = new \SoapClient(env('IDCS_ENROLL_ENDPOINT'), array(
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
            $result = $client->IDSEnrollmentXML($parameters);
            dd($result);
            return $result;
        } catch (\Exception $e) {
            if (env("APP_DEBUG")) {
                echo "<h3>EXCEPTION:</h3>";
                echo $e->getMessage(). " on " . $e->getFile(). ":".$e->getLine();

                echo "<h3>REQUEST:</h3>><pre>";
                echo $client->__getLastRequestHeaders();
                echo htmlentities($client->__getLastRequest());
                echo "</pre>";
            }
            throw $e;
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
                    "Memberid" => "",
                    "EmailAddress" => "test@test.com",
                    "Password" => "123Password",
                    "Address" => [
                        "Address1" => "222 N Alison Rd",
                        "Address2" => "",
                        "City" => "Arlington",
                        "State" => "VA",
                        "ZipCode" => "22209",
                    ],
                    "Phone" => [
                        "PhoneNumber" => "5555555555",
                        "PhoneType" => "Home"
                    ],
                    "Person" => [
                        "FirstName" => "Test",
                        "LastName" => "Testboy",
                        "MiddleName" => ""
                    ]
                ]
            ],
            "Partner" => [
                "partnerAccount" => env('IDCS_USERNAME'),
                "partnerCode" => "",
                "partnerPassword" => env('IDCS_PASSWORD'),
                "Branding" => ""
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
