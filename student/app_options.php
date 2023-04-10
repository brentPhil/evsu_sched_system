<?php
include 'linkScript.php';
$id ='';
$type ='';
$sched ='';
$personal = 'checked';
$authorize = '';
if (isset($_POST['submit'])){$date = $_POST['date']; $time = $_POST['time']; $sched = $date.'T'.$time;}

if (isset($_POST['edit'])){
    $sched = $_POST['date'];
    $type = $_POST['type'];
    $id = $_POST['id'];
}

if($type == 'authorize'){
    $personal = '';
    $authorize = 'checked';
}
?>
<body>
<div class="py-5 d-flex align-items-center justify-content-center">
    <div class="card shadow shadow-md px-4 pt-4 col-sm-12 col-s-6 col-md-8 col-lg-5">
        <div class="h3 border-bottom pb-3 mb-3">
            <div class="img">
                <img src="../img/registrar.png" style="width: 100%" alt="evsu logo">
            </div>
        </div>
        <form action="st_appointment.php" method="post">
            <input type="hidden" name="sched" value="<?php echo $sched ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div>
                <div class="d-grid">
                    <label class="mb-3" for="personal">
                        <div class="rounded-3 border p-3 fs-5">
                            <input class="form-check-input me-2" type="radio" name="app_type" value="personal" id="personal" <?php echo $personal ?>>
                            Personal
                        </div>
                    </label>
                    <label class="mb-3" for="authorize">
                        <div class="rounded-3 border p-3 fs-5">
                            <input class="form-check-input me-2" type="radio" name="app_type" value="authorize" id="authorize" <?php echo $authorize ?>>
                            Authorize
                        </div>
                    </label>
                </div>
                <div class="h3 border-bottom pb-1 mb-3">
                </div>
                <div class="d-flex justify-content-end">
                    <a href="select_sched.php" type="button" class="btn btn-light px-4 me-2" role="button">Back</a>
                    <button type="submit" name="edit" class="btn btn-primary px-4" role="button">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>