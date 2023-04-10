<?php
include '../db_conn/operations.php';
$db = new operations();
$admins_r=$db->admins();

include 'activity_check.php' ?>
    <div class="d-flex body w-100">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/navBar.php'?>
            <div class="container px-5 pt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item text-secondary" aria-current="page">Employees</li>
                    </ol>
                </nav>
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Employees
                        </h6>
                        <a href="PhpHandler/admins.php" class="btn btn-outline-secondary">Add Employee</a>
                    </div>
                    <!-- View Appointments -->
                    <div class="card-body h-100">
                        <div class="table-responsive">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admins_r as $admins){?>
                                    <tr>
                                        <td><?php echo $admins['dept'] ?></td>
                                        <td><?php echo $admins['username'] ?></td>
                                        <td><?php echo $admins['email'] ?></td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-outline-warning me-2 disabled" style="font-size: .8rem">
                                                <i class="fa fa-edit" aria-hidden="true"></i> Update
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'?>