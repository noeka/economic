<?php

require __DIR__ . '/vendor/autoload.php';

use Noeka\Economic;

$economic = new Economic('lNoF9pRsu1bCC10FiXUMAJflOBQgxOFamhkgcVuLNAk1', 'fLWMPS3mCRMPoHa5hSBcAINlgTPST81fAlqtTL9oUqM1');

$customers = $economic->customer->getCollection();
$layouts = $economic->layout->getCollection();
$products = $economic->product->getCollection();
?>

<style>
    body {
        max-width: 500px;
        width: 100%;
        margin: 1rem auto 0;
    }

    label, input, select {
        display: block;
        width: 100%;
    }

    .form-field {
        width: 100%;
        margin-bottom: 1rem;
    }

    .title {
        margin: 0;
        border-bottom: 1px solid grey;
        margin-bottom: 0.5rem;
        padding-bottom: 0.25rem;
        margin-top: 2rem;
    }
</style>

<form action='<?php echo $_SERVER['REQUEST_URI'] . 'create-invoice.php' ?>' method='post'>

    <h3 class='title'>Kunde</h3>
    <div class='form-field'>
        <label for='customer'>Vælg kunde</label>
        <select name='customer' id='customer'>
            <?php foreach ($customers as $customer) { ?>
                <option value='<?php echo $customer->customerNumber ?>'><?php echo $customer->name ?></option>
            <?php } ?>
        </select>
    </div>

    <div class='form-field'>
        <label for='layout'>Vælg layout</label>
        <select name='layout' id='layout'>
            <?php foreach ($layouts as $layout) { ?>
                <option value='<?php echo $layout->layoutNumber ?>'><?php echo $layout->name ?></option>
            <?php } ?>
        </select>
    </div>

    <h3 class='title'>Produkter</h3>
    <?php foreach ($products as $product) { ?>
        <div class='form-field'>
            <label for='product_<?php echo $product->productNumber ?>'><?php echo $product->name ?></label>
            <input type='number' name='product_<?php echo $product->productNumber ?>' id='product_<?php echo $product->productNumber ?>'>
        </div>
    <?php } ?>

    <div class='form-field'>
        <input type='submit' value='Opret Faktura'>
    </div>

</form>