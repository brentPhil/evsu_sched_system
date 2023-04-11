<?php
include '../../db_conn/operations.php';
$db = new operations();
$dept_r=$db->dept_view();

$conn = mysqli_connect("localhost", "root", "", "sched_system");

if (isset($_POST['register'])){
    if (!isset($_POST['student_id'], $_POST['user_name'], $_POST['password'])) {
        header("Location: add_student.php?error=Pls fill up all the fields");
        exit();
    }
    if (isset($_POST['student_id']) == ''){
        header("Location: add_student.php?error=Enter student id");
        exit();
    }
    if (isset($_POST['user_name']) == ''){
        header("Location: add_student.php?error=Enter username");
        exit();
    }
    if (isset($_POST['password']) == ''){
        header("Location: add_student.php?error=Enter password");
        exit();
    }

    if ($stmt = $conn->prepare('SELECT id, password FROM admin WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['student_id']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            header("Location: admins.php?error = Username exists, please choose another");
            exit();
        } else {
            if ($stmt = $conn->prepare('INSERT INTO student (dept_id, student_id, user_name, password) VALUES (?, ?, ?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ssss', $_POST['dept'], $_POST['student_id'], $_POST['user_name'], $password);
                $stmt->execute();
                header("Location: ../student.php?success");
            } else {
                header("Location: add_student.php?error=registration failed pls try again later");
            }
        }
        $stmt->close();
    } else {
        header("Location: add_student.php?error=Could not prepare statement!");
    }
}
$conn->close();?>

<script src="https://kit.fontawesome.com/cd6fddfc69.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<div class="container h-100">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="card shadow shadow-md w-50">
            <div class="text-sm-center bg_primary card-header pt-3">
                <img src="../../img/logo.png" alt="" style="width: 120px; padding-bottom: 1em">
                <div class="fs-5 mb-2">OFFICE OF THE REGISTRAR EVSU-TC</div>
            </div>
            <form class="m-0" action="" method="POST">
                <div class="card-body">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="text-danger"><i class="fa-solid fa-warning me-3"></i><?php echo $_GET['error']; ?></span>
                        </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="dept" aria-label="Floating label select example">
                            <?php while($dept = mysqli_fetch_assoc($dept_r))if($dept['id'] != 12){?>
                                <option value="<?php echo $dept['id'] ?>"><?php echo $dept['dept'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Select Department</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="student_id" placeholder="student ID no." oninput="formatStudentId(this)" pattern="[0-9]{4}-[0-9]{5}" maxlength="10">
                        <label for="floatingInput"><i class="fa-solid fa-user me-3"></i>Student ID no.</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="user_name" placeholder="username">
                        <label for="floatingInput"><i class="fa-solid fa-user me-3"></i>Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInput" name="password" placeholder="password">
                        <label for="floatingInput"><i class="fa-solid fa-lock me-3"></i>Password</label>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div><a href="../student.php" class="btn btn-link" type="submit"><i class="fa-solid fa-arrow-left-long me-2"></i>Go Back</a></div>
                    <div><button class="btn btn-primary px-4" name="register" type="submit">Register</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function formatStudentId(input) {
        // Remove non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');

        // Add a dash after the fourth character
        if (input.value.length > 4) {
            input.value = input.value.slice(0, 4) + '-' + input.value.slice(4);
        }

        // Limit the input to the specified pattern
        if (!input.value.match(/^\d{4}-\d{5}$/)) {
            input.setCustomValidity('Please enter a valid student ID number in the format 0000-00000.');
        } else {
            input.setCustomValidity('');
        }
    }
</script>