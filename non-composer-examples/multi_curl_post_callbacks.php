<?php
require __DIR__ . '/../src/Curl/Autoloader.php';
Curl\Autoloader::register();

use \Curl\Curl;
use \Curl\MultiCurl;

$multi_curl = new MultiCurl();
$multi_curl->success(function($instance) {
    echo 'call to "' . $instance->url . '" was successful.' . "\n";
    //echo 'response: ' . $instance->response . "\n";
    print_r($instance->response->form);
});
$multi_curl->error(function($instance) {
    echo 'call to "' . $instance->url . '" was unsuccessful.' . "\n";
    echo 'error code: ' . $instance->errorCode . "\n";
    echo 'error message: ' . $instance->errorMessage . "\n";
});
$multi_curl->complete(function($instance) {
    echo 'call completed' . "\n";
});

$multi_curl->addPost('https://httpbin.org/post', array(
    'to' => 'alice',
    'subject' => 'hi',
    'body' => 'hi Alice',
));
$multi_curl->addPost('https://httpbin.org/post', array(
    'to' => 'bob',
    'subject' => 'hi',
    'body' => 'hi Bob',
));

$multi_curl->start();

