<?php

    include("../smsgatewaycenter.otpsms.api.class.php");
    if (isset($_POST['sendotp']) && $_POST['sendotp'] == 1) {
        $_SESSION['MOBILE'] = $_POST['mobile'];
        $smsgatewaycenter = new psmplSMSGatewayCenter("YourUserName", "YourPassword"); //Your username and password
        $smsgatewaycenter->setMobile($_POST['mobile']);
        $smsgatewaycenter->setMsg('Your OTP code is $otp$');
        $smsgatewaycenter->setMsgType(psmplSMSGatewayCenter::MSG_TYPE_TEXT);
        $smsgatewaycenter->setSenderId("SMSGAT");
        $smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SEND_GENERATE);
        $smsgatewaycenter->setMedium(psmplSMSGatewayCenter::MEDIUM_DEFAULT);
        $smsgatewaycenter->setRetryExpiry(psmplSMSGatewayCenter::RETRY_MIN);
        $smsgatewaycenter->setFormat("json");
        $smsgatewaycenter->sendOTPSMS(psmplSMSGatewayCenter::OTPSMSAPI, 'send');
        $response = json_decode($smsgatewaycenter->getResponse());
        //print_r($response);
        echo $response->status;
        exit;
    } elseif (isset($_POST['verifyotp']) && $_POST['verifyotp'] == 1) {
        $smsgatewaycenter = new psmplSMSGatewayCenter("YourUserName", "YourPassword"); //Your username and password
        $smsgatewaycenter->setMobile($_POST['mobile_no']); //Your customer's mobile number with country code
        $smsgatewaycenter->setOtp($_POST['otpcode']); // customer input otp token value
        $smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SEND_VERIFY);
        $smsgatewaycenter->setFormat("json");
        $smsgatewaycenter->verifyOTPSMS(psmplSMSGatewayCenter::OTPSMSAPI, 'send');
        $response = json_decode($smsgatewaycenter->getResponse());
        echo $response->status;
        exit;
    }
