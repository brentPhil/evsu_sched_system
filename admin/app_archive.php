<?php
include '../db_conn/archive.php';
$db = $archive = new archive();
$archive_request=$archive->request_archive();
include 'activity_check.php';
include '../toast.php';
?>

<div class="d-flex body w-100">
    <div id="side_bar" class="sideNav flex-column flex-shrink-1 bg-light text-dark open">
        <?php include 'includes/ad_sideBar.php' ?>
    </div>
    <div class="w-100">
        <?php include 'includes/navBar.php'?>
        <div class="container px-5 pt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item text-secondary" aria-current="page">Requests</li>
                </ol>
            </nav>
            <div class="card border-1 shadow-lg" style="height: 75vh;">
                <div class="card-header py-3">
                    <h6 class="m-1 font-weight-bold text-secondary">
                        archive Request
                    </h6>
                </div>
                <!-- archive Appointments -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rq" class="display">
                            <thead class="text-uppercase">
                            <tr>
                                <th>Full Name</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $status_map = [Null => 'pending...',0 => 'in progress',1 => 'for release'];
                            $btn_map = [Null => 'Approve',0 => 'Done',1 => 'Released'];
                            foreach ($archive_request as $request) {
                                $status = $status_map[$request['RequestStatus']] ?? 'pending...';
                                $btn_txt = $btn_map[$request['RequestStatus']] ?? 'Approve';
                                $btn_class = !$request['RequestStatus'] ? 'primary' : 'warning';
                                ?>
                                <tr>
                                    <td><?= $request['StudentFullName'] ?></td>
                                    <td><?= (new DateTime($request['Schedule']))->format('F d, Y | h:i a') ?></td>
                                    <td>
                                        <div class="fw-bold text-<?= !$request['RequestStatus'] === null ? 'secondary' : ($request['RequestStatus'] ? 'warning' : 'primary') ?>">
                                            <?= $status ?>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-light btn-sm me-1" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?= $request['RequestID'] ?>">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#delete<?php  echo $request['RequestID']; ?>">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php include '../db_conn/modal.php' ?>
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
