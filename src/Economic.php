<?php

namespace Noeka;

use Noeka\Http\Client;
use Noeka\Ressources\Invoice;

class Economic
{
    /**
     * @var string
     */
    private string $appSecret;

    /**
     * @var string
     */
    private string $grantToken;

    /**
     * @var string
     */
    public string $baseUrl;

    /**
     * @var Client
     */
    public Client $client;

    /**
     * @var Resource
     */
    public Resource $customer;

    /**
     * @var Invoice
     */
    public Invoice $invoice;

    /**
     * @var Resource
     */
    public Resource $layout;

    /**
     * @var Resource
     */
    public Resource $paymentTerms;

    /**
     * @var Resource
     */
    public Resource $vatZone;

    /**
     * @var Resource
     */
    public Resource $product;

    /**
     * Economic constructor.
     * @param string $appSecret
     * @param string $grantToken
     * @param string $baseUrl
     */
    public function __construct(string $appSecret, string $grantToken, string $baseUrl = 'https://restapi.e-conomic.com/')
    {
        $this->appSecret = $appSecret;
        $this->grantToken = $grantToken;
        $this->baseUrl = $baseUrl;

        $this->client = new Client($this->baseUrl, $this->headers());

        $this->customer = new Resource($this->client, 'customers');
        $this->layout = new Resource($this->client, 'layouts');
        $this->invoice = new Invoice($this->client, 'invoices');
        $this->paymentTerms = new Resource($this->client, 'payment-terms');
        $this->vatZone = new Resource($this->client, 'vat-zones');
        $this->product = new Resource($this->client, 'products');
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        return [
            'Content-Type: application/json',
            'X-AppSecretToken: ' . $this->appSecret,
            'X-AgreementGrantToken: ' . $this->grantToken
        ];
    }
}