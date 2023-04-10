<?php
include '../db_conn/operations.php';
$db = new operations();
$dept_r=$db->dept_view();
$course_r=$db->course_view();
$options=$db->certificates();

$conn = mysqli_connect("localhost", "root", "", "sched_system");

$Graduate = 'checked';
$yr = '';
$id = '';
$full_name = '';
$number = '';
$M = '';
$F = '';
$s_yr = 'disabled';
$a = '';
$b = '';
$c = '';
$d = '';
$edit = '';
$course = '';
$id_cert = '';
$selected_cert = [];

if(isset($_POST['edit'])){
    if($_POST['id'] != ''){
        $edit = 1;
        $sched = $_POST['sched'];
        $id = $_POST['id'];
        $results = mysqli_query($conn, "SELECT * FROM st_request WHERE rq_id = '$id'");
        $rp_data = mysqli_fetch_assoc($results);
        $full_name = $rp_data['full_name'];
        $course = $rp_data['course_id'];
        $number = $rp_data['a_phone'];
        $gender = $rp_data['a_gender'];
        $id_cert = $rp_data['rq_cert'];
        $selected_cert=$db->view_rq_cert($id_cert);
        if ($rp_data['edu_status'] == '1st year'){
            $a = 'selected';
        }
        if ($rp_data['edu_status'] == '2nd year'){
            $b = 'selected';

        }
        if ($rp_data['edu_status'] == '3rd year'){
            $c = 'selected';
        }
        if ($rp_data['edu_status'] == '4th year'){
            $d = 'selected';
        }
        if ($gender != 'Male'){
            $M = '';
            $F = 'selected';
        }
        if ($rp_data['edu_status'] != 'Graduate'){
            $Graduate = '';
            $yr = 'checked';
            $s_yr = '';
        }
    }
}
include 'linkScript.php';
?>
<body>
<div class="py-5 d-flex align-items-center justify-content-center">
    <div class="card shadow shadow-md px-4 pt-4 col-sm-12 col-s-6 col-md-8 col-lg-6">
        <div class="h3 pb-3 mb-3">
            <div class="img">
                <img src="../img/registrar.png" style="width: 100%" alt="evsu logo">
            </div>
        </div>
        <form action="PhpHandler/app_request.php" method="post">
            <input type="hidden" name="type" value="<?php echo $_POST['app_type']; ?>">
            <input type="hidden" name="rq_id" value="<?php echo $_POST['id']; ?>">
            <input type="hidden" name="sched" value="<?php echo $_POST['sched']; ?>">
            <input type="hidden" name="id_cert" value="<?php echo $id_cert; ?>">
            <div id="note" class="alert alert-danger d-none" role="alert">
                Note: please bring a Valid ID and the students ID and the authorization letter
            </div>
            <div id="mb-3">
                <h4>Education Status</h4>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="dept" aria-label="Floating label select example">
                                <?php while($dept = mysqli_fetch_assoc($dept_r)){if ($dept['id']!=12){?>
                                    <option <?php echo ($_SESSION['dept_id'] == $dept['id']) ? 'selected' : 'disabled'; ?> value="<?php echo $dept['id'] ?>"><?php echo $dept['dept'] ?></option>
                                <?php }} ?>
                            </select>
                            <label for="floatingSelect">Department</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="course" aria-label="Floating label select example">
                                <?php while($courses = mysqli_fetch_assoc($course_r)){if ($courses['dept_id'] == $_SESSION['dept_id']){?>
                                    <option <?php if ($course == $courses['id']){echo 'selected';} ?> value="<?php echo $courses['id'] ?>"><?php echo $courses['name'] ?></option>
                                <?php }} ?>
                            </select>
                            <label for="floatingSelect">Section/Course</label>
                        </div>
                    </div>
                </div>
                <div class="row my-3 mb-3">
                    <div class="col">
                        <label class="btn btn-outline-primary me-2" style="margin-left: 1px" for="Graduate">
                            <input class="button-check" type="radio" name="graduate" id="Graduate" value="Graduate" <?php echo $Graduate ?> >
                            Graduate
                        </label>
                        <label class="btn btn-outline-primary" for="Under">
                            <input class="button-check" type="radio" name="graduate" id="Under" <?php echo $yr ?>>
                            Undergraduate
                        </label>
                    </div>
                    <div class="col">
                        <select class="form-select" name="year" id="year" aria-label="Default select example" <?php echo $s_yr ?>>
                            <option>Select year level</option>
                            <option <?php echo $a ?> value="1st year">1st year</option>
                            <option <?php echo $b ?> value="2nd year">2nd year</option>
                            <option <?php echo $c ?> value="3rd year">3rd year</option>
                            <option <?php echo $d ?> value="4th year">4th year</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="authorized" class="d-none">
                <h5>Authorized Personnel</h5>
                <div class="row g-2">
                    <div class="form-floating mb-3 col-md">
                        <input type="text" name="fullname" class="form-control" id="floatingInput" placeholder="Full Name" value="<?php echo $full_name; ?>">
                        <label for="floatingInput">Full Name</label>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="form-floating col">
                        <select class="form-select" name="gender" id="floatingSelect" aria-label="Floating label">
                            <option selected value="">Select Gender</option>
                            <option <?php echo $M; ?> value="Male">Male</option>
                            <option <?php echo $F; ?> value="Female">Female</option>
                        </select>
                        <label for="floatingSelect">Gender</label>
                    </div>
                    <div class="form-floating mb-3 col">
                        <input type="number" name="contact" class="form-control" id="floatingContact" placeholder="Contact No." value="<?php echo $number; ?>">
                        <label for="floatingContact">Contact No.</label>
                    </div>
                </div>
            </div>

            <h5>Transactions</h5>
            <div class="card mb-3">
                <div class="card-body">
                    <blockquote class="blockquote">
                        <p>Certification(s)</p>
                        <?php foreach ($options as $option){
                            $checked = '';
                            foreach ($selected_cert as $cert){
                                if ($cert['id'] == $option['id']){
                                    $checked = 'checked';
                                }}?>
                            <div class="form-check">
                                <input class="form-check-input" <?php echo $checked?> name="cert_options[]" type="checkbox" value="<?php echo $option['id']?>" id="<?php echo $option['id']?>">
                                <label class="form-check-label" for="<?php echo $option['id']?>">
                                    <?php echo $option['name']?>
                                </label>
                            </div>
                        <?php } ?>
                    </blockquote>
                </div>
            </div>
            <?php
            if ($edit == 1){?>
                <div class="d-flex justify-content-end">
                    <a href="app_options.php" type="button" class="btn btn-light px-4 me-2" role="button">Back</a>
                    <button type="submit" name="edit" class="btn btn-primary px-4" role="button">Submit</button>
                </div>
            <?php }else{?>
                <div class="d-flex justify-content-end">
                    <a href="app_options.php" type="button" class="btn btn-light px-4 me-2" role="button">Back</a>
                    <button type="submit" name="submit" class="btn btn-primary px-4" role="button">Submit</button>
                </div>
            <?php } ?>
    </div>
    </form>
</div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    const type = '<?php echo $_POST['app_type']; ?>';
    $(document).ready(function() {
        $('#Graduate').click(function () {
            $('#year').attr("disabled", true);
        });
        $('#Under').click(function () {
            $('#year').attr("disabled", false);
        });
        if (type === 'authorize'){
            $('#authorized').removeClass('d-none');
            $('#note').removeClass('d-none');
        }
    });
    // function getPartID(id){
    //     alert(id);
    // }
</script>