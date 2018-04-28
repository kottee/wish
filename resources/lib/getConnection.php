<?php

use Sofort\SofortLib\Sofortueberweisung;

$paymentResult = [];

/* @var $sofortueberweisung Sofortueberweisung */
$sofortueberweisung = new Sofortueberweisung(SdkRestApi::getParam('configKey', true));

$sofortueberweisung->setVersion(SdkRestApi::getParam('pluginVersion', 'unknown'));

$urls = SdkRestApi::getParam('urls');

$sofortueberweisung->setAbortUrl($urls['cancel']);
$sofortueberweisung->setTimeoutUrl($urls['cancel']);
$sofortueberweisung->setSuccessUrl($urls['success']);
$sofortueberweisung->setNotificationUrl($urls['notification']);
$sofortueberweisung->setSuccessLinkRedirect(TRUE);

$sofortueberweisung->setCurrencyCode(SdkRestApi::getParam('currency'));
$sofortueberweisung->setAmount(SdkRestApi::getParam('amount'));

$reasons = SdkRestApi::getParam('reasons', []);
$sofortueberweisung->setReason($reasons['reason1'], $reasons['reason2']);

$sofortueberweisung->setLanguageCode(SdkRestApi::getParam('country'));

$sofortueberweisung->sendRequest();

if ($sofortueberweisung->isError()) {
	$paymentResult['error'] = TRUE;
	$paymentResult['error_msg'] = $sofortueberweisung->getError();
} else {
	$paymentResult['transactionId'] = $sofortueberweisung->getTransactionId();
	$paymentResult['paymentUrl'] = $sofortueberweisung->getPaymentUrl();
}

return $paymentResult;
