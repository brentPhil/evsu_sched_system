<?php
include '../db_conn/view.php';
$view = new view();
$departments=$view->dept_view();
$courses=$view->course_view();

include 'activity_check.php' ?>
    <div class="d-flex body w-100">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/navBar.php'?>
            <div class="container px-5 pt-5">
                <div class="row">
                    <div class="col-6">
                        <div class="card border-0 shadow-lg mb-4" style="height: 79vh;">
                            <div class="card-header d-flex justify-content-between align-items-center py-3">
                                <h6 class="m-0 font-weight-bold text-secondary">
                                    Department
                                </h6>
                                <button type="button" class="btn btn-outline-dark" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#add_dept">
                                    <i class="fa fa-plus-circle me-1"></i> New Department
                                </button>
                                <?php include 'includes/dept_course_modal.php'?>
                            </div>
                            <!-- View Appointments -->
                            <div class="card-body h-100">
                                <div class="table-responsive">
                                    <table id="deptTable" class="display">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($departments as $dept){ if ($dept['dept'] != ''){?>
                                            <tr>
                                                <td><div class="overflow-ellipsis" style="max-width: 250px;"><?php echo $dept['dept'] ?></div></td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-light" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#dept<?php echo $dept['id'] ?>">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="dept<?php echo $dept['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered border-3">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Department</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                                                                <div class="row py-1 border-bottom">
                                                                    <div class="col-4 py-2">Department</div>
                                                                    <div class="col-8 py-2 bg-light"><?php  echo $dept['dept']; ?></div>
                                                                </div>
                                                                <div class="row py-1 border-bottom">
                                                                    <div class="col-4 py-2">Description</div>
                                                                    <div class="col-8 py-2 bg-light"><?php  echo $dept['description']; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-lg mb-4" style="height: 79vh;">
                            <div class="card-header d-flex justify-content-between align-items-center py-3">
                                <h6 class="m-0 font-weight-bold text-secondary">
                                    Courses
                                </h6>
                                <button type="button" class="btn btn-outline-dark" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#add_course">
                                    <i class="fa fa-plus-circle me-1"></i> New Course
                                </button>
                            </div>
                            <!-- View Appointments -->
                            <div class="card-body h-100">
                                <div class="table-responsive">
                                    <table id="courseTable" class="display">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($courses as $course){ if ($course['name'] != ''){?>
                                            <tr>
                                                <td><div class="overflow-ellipsis" style="width: 250px;"><?php echo $course['name'] ?></div></td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-light" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#course<?php echo $course['id'] ?>">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="course<?php echo $course['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered border-3">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Course</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                                                                <div class="row py-1 border-bottom">
                                                                    <div class="col-4 py-2">Course</div>
                                                                    <div class="col-8 py-2 bg-light"><?php  echo $course['name']; ?></div>
                                                                </div>
                                                                <div class="row py-1 border-bottom">
                                                                    <div class="col-4 py-2">Description</div>
                                                                    <div class="col-8 py-2 bg-light"><?php  echo $course['description']; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>