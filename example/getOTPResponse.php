<?php
//Save this file as getOTPResponse.php
$oSMS = new otpSMScallback($_REQUEST);

echo $oSMS->getMobile();
echo $oSMS->getCreateTime();
echo $oSMS->getExpiryTime();
echo $oSMS->getRetryAfter();
echo $oSMS->getOtp();
echo $oSMS->getType();
echo $oSMS->getMethod();
echo $oSMS->getStatus();
echo $oSMS->getReason();

    //or write to a file
    $content = $oSMS->getMobile().", ".$oSMS->getOtp()."\r\n";
    $fp = fopen('otpsmsresponse.csv', 'a');
    fwrite($fp, $content);
    fclose($fp);
    
    //or write to database
    $sgc_db_username = 'yourdatabaseusername';
    $sgc_db_password = 'yourdatabasepassword';
    $sgc_db_name = 'yourdatabasename';
    $sgcsmsc = new mysqli('localhost', $sgc_db_username, $sgc_db_password, $sgc_db_name);
    if($sgcsmsc->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    
    $sgcsqlinsert = "INSERT INTO `otp_sms_response` (`mobile`, `otp`)
        VALUES ('".$oSMS->getMobile()."', '".$oSMS->getOtp()."')";

    if ($sgcsmsc->query($sgcsqlinsert) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sgcsqlinsert . "<br>" . $sgcsmsc->error;
    }
    $sgcsmsc->close();


//class for OTP SMS Callback
class otpSMScallback {

    private $mobile;
    private $createTime;
    private $expiryTime;
    private $otp;
    private $type;
    private $method;
    private $status;
    private $reason;

    public function __construct($REQUEST) {
        $this->mobile = $REQUEST['mobile'];//recipient mobile number
        $this->createTime = $REQUEST['createTime'];//time in unix format
        $this->expiryTime = $REQUEST['expiryTime'];//time in unix format
        $this->retryAfter = $REQUEST['retryAfter'];//time in unix format
        $this->otp = $REQUEST['otp'];//otp code
        $this->type = $REQUEST['type'];//new|existing
        $this->method = $REQUEST['method'];//generate|verify
        $this->status = $REQUEST['status']; //success|fail
        $this->reason = $REQUEST['reason']; //Actual reason
    }

    function getMobile() {
        return $this->mobile;
    }

    function getCreateTime() {
        return $this->createTime;
    }

    function getExpiryTime() {
        return $this->expiryTime;
    }

    function getRetryAfter() {
        return $this->retryAfter;
    }
    
    function getOtp() {
        return $this->otp;
    }

    function getType() {
        return $this->type;
    }

    function getMethod() {
        return $this->method;
    }

    function getStatus() {
        return $this->status;
    }

    function getReason() {
        return $this->reason;
    }
}
