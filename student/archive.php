<?php
include '../db_conn/operations.php';
$db = new operations();
$approved=$db->archives();

include 'linkScript.php';
?>
    <div class="d-flex body w-100">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/st_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/st_navBar.php'?>
            <div class="container row px-5 pt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item text-secondary" aria-current="page">Archives</li>
                    </ol>
                </nav>
                <div class="card border-0 shadow-lg col-12 p-0" style="height: 75vh;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Request archives
                        </h6>
                    </div>
                    <!-- View Appointments -->
                    <div class="card-body h-100">
                        <div class="table-responsive py-2 text-capitalize">
                            <table id="myTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Full Name</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($approved as $request){
                                    $id = $request['rq_id'];?>
                                    <tr>
                                        <td><?php  echo $request['app_type']; ?></td>
                                        <td><div class="overflow-ellipsis" style="max-width: 120px"><?php  echo $request['lname'].', '.$request['fname'].' '.$request['middle'].'.'; ?></div></td>
                                        <td><div class="overflow-ellipsis" style="max-width: 120px"><?php  echo date('F d, Y | h: i a', strtotime($request['rq_schedule'])); ?></div></td>
                                        <td><div class="td fw-bold text-<?php echo $color = $request['request_status'] == 'on progress' ? 'primary' : 'warning';?>"><?php echo $request['request_status']?>...</div></td>
                                        <td class="text-end d-flex justify-content-end">
                                            <button type="button" class="btn btn-outline-secondary me-2" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?php  echo $request['rq_id']; ?>">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i> View details
                                            </button>
                                            <div class="btn-group dropstart">
                                                <a type="button" class="btn data-toggle rounded-3 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>
                                                <div class="dropdown-menu p-2">
                                                    <form class="m-0" action="" method="post">
                                                        <input type="hidden" name="rq_id" value="<?php echo $request['rq_id'];?>">
                                                        <button type="submit" class="btn btn-danger mb-0 w-100" style="font-size: .8rem" name="remove" href="#">archive</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include '../db_conn/modal.php' ?>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>