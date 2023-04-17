<?php
$conn = mysqli_connect("localhost", "root", "", "sched_system");
include '../db_conn/archive.php';
$archive = new archive();

include 'linkScript.php';
$uid = $_SESSION['id'];
$requests = $archive->st_request_archive($uid);
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
<?php include '../toast.php' ?>
    <div class="d-flex body">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/st_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/st_navBar.php' ?>

            <div class="container pt-5 px-5">
                <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=>Home</a></li>
                        <li class="breadcrumb-item text-secondary" aria-current="page">Archives</li>
                    </ol>
                </nav>
                <div class="card border-0 shadow-lg" style="height: 75vh;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Request Archives
                        </h6>
                    </div>
                    <!-- archive Appointments -->
                    <div class="card-body">
                        <div class="table-responsive py-2 text-capitalize">
                            <table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Request Type</th>
                                    <th>Full Name</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 1;
                                foreach($requests as $request){
                                    $status = $status_map[$request['RequestStatus']] ?? 'pending...';
                                    ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $request['RequestType']; ?></td>
                                        <td><?php echo $request['StudentFullName']; ?></td>
                                        <td><?php echo date('F d, Y | h: i a', strtotime($request['Schedule'])); ?></td>
                                        <td>
                                            <div class="fw-bold text-<?php echo $request['RequestStatus'] === 'canceled' ? 'danger' : 'success' ?>">
                                                <?php echo $request['RequestStatus'] ?>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-outline-success" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?php echo $request['RequestID']; ?>">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i> archive details
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#delete<?php echo $request['RequestID']; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    include 'modal.php';
                                    $counter++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>