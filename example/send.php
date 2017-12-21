<?php

/**
 * SMSGatewayCenter - Send OTP SMS 
 *
 * @package  SMSGatewayCenter
 * @version  1.0.0
 * @author   psmpl <psmpl@psmpl.com>
 * @api      <https://www.smsgateway.center/docs/api/>
 * @license  <https://www.smsgateway.center> (SMSGatewayCenter)
*/

include("../smsgatewaycenter.otpsms.api.class.php");

/**
 * Send OTP SMS
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
$smsgatewaycenter->setMsg('Your OTP code is $otp$'); // Your message
$smsgatewaycenter->setMsgType(psmplSMSGatewayCenter::MSG_TYPE_TEXT); //Change to MSG_TYPE_UNICODE for Unicode message
$smsgatewaycenter->setSenderId("SMSGAT"); // Your approved sender name
$smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SEND_GENERATE);
$smsgatewaycenter->setMedium(psmplSMSGatewayCenter::MEDIUM_DEFAULT);
$smsgatewaycenter->setRetryExpiry(psmplSMSGatewayCenter::RETRY_MIN);
$smsgatewaycenter->setFormat("json");
$smsgatewaycenter->sendOTPSMS(psmplSMSGatewayCenter::OTPSMSAPI,'send');
echo $smsgatewaycenter->getResponse();
