<?php

require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

$params = array(
    'credentials' => array(
        'key' => 'add_your_key_here',
        'secret' => 'add_your_secret_here',
    ),
    'region' => 'us-east-1', // < your aws from SNS Topic region
    'version' => 'latest'
);

use Aws\Exception\AwsException;
$sns = new \Aws\Sns\SnsClient($params);

$args = array(
    "MessageAttributes" => [
                'AWS.MM.SMS.OriginationNumber' => [
                    'DataType' => 'String',
                    'StringValue' => '+18557280786'
                ],
                'AWS.SNS.SMS.SenderID' => [
                    'DataType' => 'String',
                    'StringValue' => 'BRAND'
                ],
                'AWS.SNS.SMS.SMSType' => [
                    'DataType' => 'String',
                    'StringValue' => 'Transactional'
                ]
            ],
    "Message" => "Hello World! Visit i.am.online!",
    "PhoneNumber" => "+917878787878"
);


try {
    $result = $sns->publish($args);
    echo "<pre>";
    var_dump($result);
    echo "</pre>";
} catch (AwsException $e) {
    // output error message if fails
    var_dump($e);
}