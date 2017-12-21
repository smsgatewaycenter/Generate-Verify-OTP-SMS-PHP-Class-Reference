<?php

/**
 * SMSGatewayCenter - Verify OTP SMS 
 *
 * @package  SMSGatewayCenter
 * @version  1.0.0
 * @author   psmpl <psmpl@psmpl.com>
 * @api      <https://www.smsgateway.center/docs/api/>
 * @license  <https://www.smsgateway.center> (SMSGatewayCenter)
*/

include("../smsgatewaycenter.otpsms.api.class.php");

/**
 * Verify OTP SMS
 *
 */
$smsgatewaycenter = new psmplSMSGatewayCenter("YourUsername", "YourPassword");//Your username and password
/**
* generateOtp
* $url string APIURL
* $component API URL Component
* $param array array of required fields
*/

$smsgatewaycenter->setMobile("919999999999"); //Your customer's mobile number with country code
$smsgatewaycenter->setOtp("2835"); // customer input otp token value
$smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SEND_VERIFY);
$smsgatewaycenter->setFormat("json");
$smsgatewaycenter->verifyOTPSMS(psmplSMSGatewayCenter::OTPSMSAPI,'send');
echo $smsgatewaycenter->getResponse();
