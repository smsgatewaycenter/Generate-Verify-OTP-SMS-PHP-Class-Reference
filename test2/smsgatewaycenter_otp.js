$(document).ready(function() {
    $(document).on('click', '.btn-sendotp-submit', function(ev) {
        ev.preventDefault();
        var data = $("#smsgatewaycenterotpform").serialize();
        $.post('otp.php', data, function(data, status) {
            console.log("Submitting Result ====> Data: " + data + "\nStatus: " + status);
            if (data == "success") {
                $("#verification_code").text("success");
                $("#mobile_no").val($("#mobile").val());
                $("#spanmob").text($("#mobile").val());
                $("#sgc_verify_div").fadeIn();
                $("#smsgatewaycenterotpform").fadeOut();
                var counter = 60;
                setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                        $("#count").text(counter);
                    }
                    if (counter === 0) {
                        $("#exp").text("Code Expired!").addClass('alert alert-danger');
                        clearInterval(counter);
                    }
                }, 1000);
                //$("#count").text(timer());
            } else {
                $("#showError").text(data).addClass('alert alert-danger');
            }

        });
    });
    $(document).on('click', '.btn-verifyotp-submit', function(ev) {
        ev.preventDefault();
        $("#mobile_no").val($("#mobile").val());
        var data = $("#smsgatewaycenterotpverifyform").serialize();
        $.post('otp.php', data, function(data, status) {
            console.log("Submitting Result ====> Data: " + data + "\nStatus: " + status);
            if (data == "success") {
                $("#status").text("Mobile Number Verified");
                $('#status').addClass('alert alert-success');
                $("#sgc_verify_div").fadeOut();
                $("#extras").fadeOut();
            } else {
                $("#showError").text(data).addClass('alert alert-danger');
            }

        });
    });
});
