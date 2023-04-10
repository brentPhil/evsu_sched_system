<?php
$conn = mysqli_connect("localhost", "root", "", "sched_system");
include '../db_conn/operations.php';
$db = new operations();

if(isset($_POST['cancel'])){
    $id = $_POST['rq_id'];
    $db->del_rq($id) ? header("Location: st_main.php?success") : header("Location: st_main.php?failed");
    exit();
}

include 'linkScript.php';
$uid = $_SESSION['id'];
$dept_id = $_SESSION['dept_id'];
$rq_rows = $db->view_st_rq($uid, $dept_id);
?>
    <style>
        tr td, th{
            font-size: .8rem;
        }
        tr td{
            text-transform: capitalize;
        }
        tr td:nth-child(3){
            text-transform: lowercase;
        }
        .create{
            background: #ff5a5a;
        }
        .create:hover{
            background: #ff3e3e !important;
        }
        .btn{
            font-size: .8rem
        }
        .overflow-ellipsis{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }
    </style>
    <div class="d-flex body">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/st_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/st_navBar.php' ?>

            <div class="container pt-5 px-5">
                <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                    <a href="select_sched.php" class="btn btn-danger border-0 text-light mb-3 bg_primary" style="font-size: .8rem;">Create Appointment</a>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=>Home</a></li>
                        <li class="breadcrumb-item text-secondary" aria-current="page">My Request</li>
                    </ol>
                </nav>
                <div class="card border-0 shadow-lg" style="height: 75vh;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Appointment Schedules
                        </h6>
                    </div>
                    <!-- View Appointments -->
                    <div class="card-body">
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
                                foreach($rq_rows as $row){?>
                                    <tr>
                                        <td><?php  echo $row['app_type']; ?></td>
                                        <td><?php  echo $row['lname'].', '.$row['fname'].' '.$row['middle'].'.'; ?></td>
                                        <td><?php  echo date('F d, Y | h: i a', strtotime($row['rq_schedule'])); ?></td>
                                        <td>
                                            <div class="td fw-bold text-<?php echo $color = $row['request_status'] != 'pending' ? 'success' : 'primary';?>"><?php echo $row['request_status']?></div>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-outline-success" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?php  echo $row['rq_id']; ?>">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i> View details
                                            </button>
                                            <div class="btn-group dropstart">
                                                <a type="button" class="btn data-toggle rounded-3 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>
                                                <div class="dropdown-menu p-2">
                                                    <form action="" class="mb-2" method="post">
                                                        <input type="hidden" name="rq_id" value="<?php echo $row['rq_id'];?>">
                                                        <button type="submit" class="btn btn-danger mb-0 w-100" name="cancel">Cancel</button>
                                                    </form>
                                                    <form action="select_sched.php" class="mb-2" method="post">
                                                        <input type="hidden" name="rq_id" value="<?php echo $row['rq_id'];?>">
                                                        <button type="submit"<?php echo $row['request_status'] == 'pending...' ? '' : 'disabled';?> name="edit" class="btn btn-danger w-100">Edit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include 'modal.php'?>
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