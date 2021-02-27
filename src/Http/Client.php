<?php


namespace Noeka\Http;


class Client
{
    private string $baseUrl;
    private array $headers;
    public $curl;

    public function __construct($baseUrl, $headers)
    {
        $this->baseUrl = $baseUrl;
        $this->headers = $headers;
    }

    public function start($route)
    {
        $this->curl = curl_init($this->baseUrl . $route);
        curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $this->curl, CURLOPT_HTTPHEADER, $this->headers);
    }

    public function data($data)
    {
        $payload = json_encode($data, JSON_PRETTY_PRINT);
        curl_setopt( $this->curl, CURLOPT_POSTFIELDS, $payload );
    }

    public function exec()
    {
        $response = curl_exec($this->curl);
        curl_close($this->curl);

        return $response;
    }
}