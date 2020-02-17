<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use GuzzleHttp\Client;

(new Dotenv(__DIR__))->load();

$firstName = addslashes($_POST["first_name"]);
$lastName = addslashes($_POST["last_name"]);
$company = addslashes($_POST["company"]);
$email = addslashes($_POST["email"]);
$phone = addslashes($_POST["phone"]);
$retUrl = addslashes($_POST["retURL"]);

$client = new Client();
$response = $client->request('POST', $_ENV["mainUrl"], [
    'form_params' => [
        "oid" => $_ENV["OID"],
        "retURL" => $retUrl,
        "formID" => $_ENV["formID"],
        "enableServerValidation" => $_ENV["enableServerValidation"],
        "enable303Redirect" => $_ENV["enable303Redirect"],
        "00N1U00000RATkz" => $_ENV["00N1U00000RATkz"],
        "lead_source" => $_ENV["lead_source"],
        "00N1U00000Swjt3" => $_ENV["00N1U00000Swjt3"],
        'first_name' => $firstName,
        'last_name' => $lastName,
        'company' => $company,
        'email' => $email,
        'phone' => $phone
    ]
]);

echo "Registration: " . (200 == $response->getStatusCode() ? "success" : "failed with code {$response->getStatusCode()}");