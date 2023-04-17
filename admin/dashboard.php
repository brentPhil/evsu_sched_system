<?php
include '../db_conn/view.php';
$db = $view = new view();
$requests = $view->view_all_requests();
$events_v = $view->event_view();

include '../toast.php';
include 'activity_check.php';
?>
    <link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
    <style>
        .calendar .days .day_num{
            height: 3em !important;
        }
        .calendar .days .day_num.ignore {
            display: inline-flex;
            font-size: 13px;
            height: 3em !important;
        }
        .calendar .days .day_name{
            height: 3em !important;
        }
        .sd{
            display: none
        }
        .events{
            font-size: .8em;
            text-transform: capitalize;
            background: #eaeaea;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .events:hover{
            background: #eaeaea !important;
        }
        .doc_card:hover{
            cursor: pointer;
            box-shadow: #3a80c7;
        }
    </style>
    <div class="d-flex body">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>

            <div class="container px-5 pt-3">
                <div class="row pt-3">
                    <div class="col-lg-8">
                        <div class="card shadow-lg">
                            <div class="card-header bg_primary text-white">
                                <h5 class="card-title mb-0">Requests</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <table id="rq" class="display h-100">
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
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="card border-0 p-1 shadow-lg mb-3">
                            <?php include 'ad_calendar.php' ?>
                        </div>
                        <div class="card border-0 shadow-lg">
                            <div class="text-light card-header bg_primary border-0">Events</div>
                            <div class="card-body px-1 py-2">
                                <div class="overflow-auto" style="max-height: 158px; min-height: 100px;">
                                    <?php
                                    foreach($events_v as $event_v){
                                        ?>
                                        <div class="py-1 events row mx-2 px-2">
                                            <div class="col-1 p-0 d-flex align-items-center">
                                                <div class="event <?php echo 'event_'.trim($event_v['event_category']) ?> rounded-3" style="width: 10px;"></div>
                                            </div>
                                            <div class="col-3 p-0 overflow-hidden"><?php echo $event_v['event_type'];?></div>
                                            <div class="col-7 p-0 overflow-hidden"><?php  echo date('F d, Y', strtotime($event_v['event_date'])) ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>