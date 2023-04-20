<?php
include '../db_conn/view.php';
$db = $view = new view();
$requests = $view->approved_requests();
require_once 'middleware.php';
include '../main_libraries.php';
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
                            Approved Request
                        </h6>
                    </div>
                    <!-- View Appointments -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="rq" class="display">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Requested documents</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 1;
                                $status_map = [Null => 'pending...',0 => 'in progress',1 => 'for release'];
                                $btn_map = [Null => 'Approve',0 => 'Done',1 => 'Released'];
                                foreach ($requests as $request) {
                                    $documents=$view->document_mappings($request['RequestID']);
                                    $status = $status_map[$request['RequestStatus']] ?? 'pending...';
                                    $btn_txt = $btn_map[$request['RequestStatus']] ?? 'Approve';
                                    $btn_class = !$request['RequestStatus'] ? 'primary' : 'warning';
                                    ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?= $request['StudentFullName'] ?></td>
                                        <td><?= (new DateTime($request['Schedule']))->format('F d, Y | h:i a') ?></td>
                                        <td>
                                            <div class="fw-bold text-<?= $request['RequestStatus'] === null ? 'secondary' : ($request['RequestStatus'] ? 'warning' : 'primary') ?>">
                                                <?= $status ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-file"></i> View Documents
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end p-3" style="width: 400px">
                                                    <div class="row gx-3">
                                                        <?php foreach($documents as $doc): ?>
                                                            <div class="col">
                                                                <div class="bg-white doc_card border rounded shadow-sm">
                                                                    <div class="docCardIMG">
                                                                        <img src="../img/ID_cardDefault.jpg" class="card-img-top" alt="<?= $doc['DocumentName'] ?>">
                                                                    </div>
                                                                    <div class="px-2 pt-2">
                                                                        <h6 class=""><?= $doc['DocumentName'] ?></h6>
                                                                        <p style="font-size: 12px"><?= $doc['DocumentDescription'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-light btn-sm me-1" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?= $request['RequestID'] ?>">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </button>
                                                <form action="PhpHandler/approve.php" method="post" class="m-0">
                                                    <input type="hidden" name="id" value="<?= $request['RequestID'] ?>">
                                                    <input type="hidden" name="sched" value="<?= $request['Schedule'] ?>">
                                                    <input type="hidden" name="up_status" value="<?= $request['RequestStatus'] === null ? 0 : (!$request['RequestStatus'] && '1') ?>">
                                                    <button type="submit" name="<?= $request['RequestStatus'] ? 'released' : 'prog' ?>" class="btn btn-outline-<?= $btn_class ?> btn-sm me-1" style="font-size: .8rem; width: 90px">
                                                        <i class="fa-regular fa-calendar-check"></i> <?= $btn_txt ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include '../db_conn/modal.php';
                                    $counter++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>
