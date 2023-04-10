<?php include 'linkScript.php' ?>
<body>
    <div class="row p-6 h-100 pb-3 d-flex align-items-center justify-content-center">
        <div class="card shadow shadow-md px-4 pt-4 col-sm-12 col-s-6 col-md-8 col-lg-8 pb-3">
            <div class="card text-center">
                <div class="card-header" >
                    <h5 class="card-title">Appointment Schedule Successfully submitted</h5>
                </div>
                <div class="card-body">
                    <div class="img">
                        <img src="../img/check.png" class="w-25">
                    </div>
                    <p>Redirecting...<span id="counter">10</span> second(s).</p>
                    <p class="card-text mb-3">Your transaction is being processed. Please wait for the admin to send you a confirmation email.</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="st_appointment.php" type="button" class="btn btn-light px-4 me-2" role="button">Back to page</a>
                        <a href="st_main.php" type="submit" name="submit" class="btn btn-success px-4" role="button">Proceed</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = 'st_main.php';
        }
        if (parseInt(i.innerHTML)!==0) {
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
    }
    setInterval(function(){ countdown(); },1000);
</script>