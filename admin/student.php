<?php
include '../db_conn/view.php';
$view = new view();
$students=$view->students();
$dept_r=$view->dept_view();
require_once 'admin_middleware.php';
include '../main_libraries.php';
?>
    <div class="d-flex body">
        <div class="sideNav shadow-sm position-fixed z-3 flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="sidebar open"></div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>
            <div class="container-fluid">
                <div class="p-3 p-lg-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item text-secondary" aria-current="page">Student</li>
                        </ol>
                    </nav>
                    <div class="card border-0 shadow-lg mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-secondary">
                                Student
                            </h6>
                            <a href="PhpHandler/add_student.php" class="btn btn-light"><i class="fa fa-plus-circle fs-5"></i></a>
                        </div>
                        <!-- View Appointments -->
                        <div class="card-body h-100">
                            <div class="d-flex justify-content-between mb-3">
                                <select id="dept-select" class="form-select w-25" aria-label="Default select example">
                                    <option value="" selected>Select Department</option>
                                    <?php while($dept = mysqli_fetch_assoc($dept_r)) if($dept['id'] != 12){?>
                                        <option value="<?php echo $dept['dept']  ?>"><?php echo $dept['dept'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group w-25">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" id="search-input">
                                </div>
                            </div>
                            <div class="table-responsive overflow-y-auto" style="max-height: 60vh">
                                <table id="myTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Username</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($students as $student) { ?>
                                        <tr>
                                            <td><?php echo $student['dept'] ?></td>
                                            <td><?php echo $student['user_name'] ?></td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-light me-2" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#dept_course<?php echo $student['student_id'] ?>">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="dept_course<?php echo $student['student_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                                                            <div class="row py-1 border-bottom">
                                                                <div class="col-4 py-2">Department</div>
                                                                <div class="col-8 py-2 bg-light"><?php  echo $student['dept']; ?></div>
                                                            </div>
                                                            <div class="row py-1 border-bottom">
                                                                <div class="col-4 py-2">Student ID</div>
                                                                <div class="col-8 py-2 bg-light"><?php  echo $student['student_id']; ?></div>
                                                            </div>
                                                            <div class="row py-1 border-bottom">
                                                                <div class="col-4 py-2">Full name:</div>
                                                                <div class="col-8 py-2 bg-light"><?php  echo $student['user_name']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>