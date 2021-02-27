<?php


namespace Noeka\Ressources;


use Noeka\Resource;

class Invoice extends Resource
{
    public function createDraft($customerNumber, $layoutNumber, $products)
    {
        $paymentTermsResource = new Resource($this->client, 'payment-terms');
        $vatZoneResource = new Resource($this->client, 'vat-zones');
        $layoutResource = new Resource($this->client, 'layouts');

        if (isset($products)) {
            $lines = $this->getProductLines($products);
        }

        $customer = $this->getCustomer($customerNumber);

        $invoice = [
            'currency' => $customer->currency,
            'customer' => $customer,
            'date' => date('c'),
            'layout' => $layoutResource->get($layoutNumber),
            'paymentTerms' => $paymentTermsResource->get($customer->paymentTerms->paymentTermsNumber),
            'recipient' => [
                'name' => $customer->name,
                'address' => $customer->address,
                'zip' => $customer->zip,
                'vatZone' => $vatZoneResource->get($customer->vatZone->vatZoneNumber)
            ],
            'lines' => $lines
        ];

        $this->client->start($this->resource . '/drafts');
        $this->client->data($invoice);
        $response = $this->client->exec();

        return json_decode($response);
    }

    private function getProductLines($products): array {
        $productResource = new Resource($this->client, 'products');

        $lines = [];

        foreach ($products as $key => $prod) {
            $product = $productResource->get($prod['productNumber']);

            $lines[] = [
                'product' => [
                    'productNumber' => (string) $product->productNumber
                ],
                'quantity' => 1.00,
                'unitNetPrice' => (int) $prod['value']
            ];
        }

        return $lines;
    }

    private function getCustomer($customerNumber) {
        $customer = new Resource($this->client, 'customers');

        return $customer->get($customerNumber);
    }
}