<?php

$paymentResult = [];

$paymentResult['version'] = SdkRestApi::getParam('pluginVersion', 'unknown');
$paymentResult['url'] = SdkRestApi::getParam('urls');
$paymentResult['id'] = SdkRestApi::getParam('id');
$paymentResult['transactionId'] = '1234567890';
$paymentResult['paymentUrl'] = 'paymentURI';

return $paymentResult;
