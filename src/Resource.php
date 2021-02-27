<?php


namespace Noeka;


use Noeka\Http\Client;

class Resource
{
    protected string $resource;
    protected Client $client;

    public function __construct($client, $resource)
    {
        $this->resource = $resource;
        $this->client = $client;
    }

    public function getAll()
    {
        $this->client->start($this->resource);
        $response = $this->client->exec();

        return json_decode($response);
    }

    public function getCollection()
    {
        return $this->getAll()->collection;
    }

    public function get($lookup)
    {
        $this->client->start($this->resource . '/' . $lookup);
        $response = $this->client->exec();

        return json_decode($response);
    }

    public function post($data)
    {
        $this->client->start($this->resource);
        $this->client->data($data);

        $response = $this->client->exec();

        return json_decode($response);
    }
}