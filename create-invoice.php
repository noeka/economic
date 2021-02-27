<?php

require __DIR__ . '/vendor/autoload.php';

use Noeka\Economic;

$economic = new Economic('lNoF9pRsu1bCC10FiXUMAJflOBQgxOFamhkgcVuLNAk1', 'fLWMPS3mCRMPoHa5hSBcAINlgTPST81fAlqtTL9oUqM1');

$products = [];

foreach ($_POST as $key => $value) {
    $exp_key = explode('_', $key);

    if($exp_key[0] == 'product'){
        if ($value) {
            $products[] = [
                'productNumber' => (int) str_replace('product_', '', $key),
                'value' => $value
            ];
        }
    }
}

$resp = $economic->invoice->createDraft($_POST['customer'], $_POST['layout'], $products);

var_dump($resp);
