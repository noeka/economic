# Economic REST API Wrapper
Small test can be found in the "index.php" file

### Usage
First create an instance of the `Noeka\Economic` class with 'appsecret' and the 'grantToken'.
```php
$economic = new Economic($appSecret, $grantToken);
```

Then you can access customer, layout, invoice, paymentTerms, vatZone and product this way:
```php
$economic->customer->get($customerNumber);
$economic->customer->getAll();
$economic->customer->getCollection();
$economic->customer->post($someData);
```
