<?php
	session_start();
	session_set_cookie_params(360);
	include("../smsgatewaycenter.otpsms.api.class.php");
	//echo $_SESSION['MOBILE'];
        //if ($_SERVER['REQUEST_METHOD'] != "POST") die;
	if(isset($_POST['sendotp']) && $_POST['sendotp'] == 1){
		if ($_POST['otpcode'] == ''){
			die('Please input OTP Code');
		} else {
			$smsgatewaycenter = new psmplSMSGatewayCenter("YourUsername", "YourPassword");//Your username and password
			$smsgatewaycenter->setMobile($_SESSION['MOBILE']); //Your customer's mobile number with country code
			$smsgatewaycenter->setOtp($_POST['otpcode'] ); // customer input otp token value
			$smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SEND_VERIFY);
			$smsgatewaycenter->setFormat("json");
			$smsgatewaycenter->verifyOTPSMS(psmplSMSGatewayCenter::OTPSMSAPI,'send');
			$response = json_decode($smsgatewaycenter->getResponse());
			//print_r($response);
			$status = strtoupper($response->status);
			if($status == 'SUCCESS'){
				echo "Thank you for verifying mobile number";
				exit;
			}
			elseif($status == 'ERROR'){
				echo $response->reason;
				exit;
			}
		}
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Verify OTP SMS Example - Test - SMSGatewayCenter</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.0/css/AdminLTE.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="#SMSGatewayCenter.com"><b>SMSGatewayCenter</b> OTP SMS</a>
			</div>
			<div class="login-box-body">
				<p class="login-box-msg">Enter OTP Code</p>
				<form action="" method="post">
					<div class="form-group has-feedback">
						<input type="text" name="otpcode" class="form-control" placeholder="OTP Code">
						<span class="glyphicon glyphicon-exclamation-sign form-control-feedback"></span>
					</div>
					<input type="hidden" name="sendotp" value="1">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
				</form>
				<div class="social-auth-links text-center">
					<p>&nbsp;</p>
				</div>
				<a href="#"><span class="glyphicon glyphicon-arrow-right"></span> OTP API Documentation</a><br>
				<a href="#" class="text-center"><span class="glyphicon glyphicon-arrow-right"></span> Buy OTP SMS</a>
			</div>
		</div>
		<!-- jQuery 3 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
