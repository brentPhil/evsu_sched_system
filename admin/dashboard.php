<?php
include '../db_conn/view.php';
$db = $view = new view();
$requests = $view->view_all_requests();
$events_v = $view->event_view();

include '../toast.php';
require_once 'middleware.php';
include '../main_libraries.php';
?>
    <link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
    <style>
        .calendar .days .day_num{
            height: 3em !important;
        }
        .calendar .days .day_num.ignore {f
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
        /* Pending */
        .pending {
            color: #FFA500; /* orange */
            background-color: #FFF3E0; /* light orange */
        }

        /* Processing */
        .processing {
            color: #4169E1; /* royal blue */
            background-color: #E3F2FD; /* light blue */
        }

        /* Release */
        .release {
            color: #008000; /* green */
            background-color: #E8F5E9; /* light green */
        }
    </style>
    <div class="d-flex body">
        <div class="sideNav position-fixed flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="sidebar open"></div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>
            <div class="container-fluid">
                <div class="row p-lg-5 p-3">
                    <div class="col-12 col-xl-8">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Requests</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between p-3 border-bottom border-secondary">
                                    <div></div>
                                    <div>
                                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-text bg-white border-end-0 text-secondary"><i class="fa-solid fa-magnifying-glass"></i></div>
                                            <input type="text" class="form-control border-start-0 ps-0" id="inlineFormInputGroupUsername" placeholder="Search request">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="min-height: 70vh">
                                    <table id="myTable" class="table border-secondary-subtle h-100" style="width:100%">
                                        <thead class="bg-body-secondary text-secondary">
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Schedule</th>
                                            <th>Status</th>
                                            <th>Requested documents</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-secondary">
                                        <?php
                                        $counter = 1;
                                        $status_map = [Null => 'pending...',0 => 'in progress',1 => 'for release'];
                                        $btn_map = [Null => 'Approve',0 => 'Done',1 => 'Released'];
                                        foreach ($requests as $request) {
                                            $documents=$view->document_mappings($request['RequestID']);
                                            $status = $status_map[$request['RequestStatus']] ?? 'pending...';
                                            $btn_txt = $btn_map[$request['RequestStatus']] ?? 'Approve';
                                            $btn_class = $request['RequestStatus'] === null ? 'warning' : (!$request['RequestStatus'] ? 'success' : 'primary');
                                            ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $counter; ?></td>
                                                <td class="text-truncate align-middle" style="font-weight: bolder; max-width: 150px;"><?= $request['StudentFullName'] ?></td>
                                                <td class="text-truncate align-middle" style="max-width: 100px;"><?= (new DateTime($request['Schedule']))->format('F d, Y | h:i a') ?></td>
                                                <td class="align-middle">
                                                    <div style="padding: .5em 0 .5em 0; min-width: 110px"
                                                         class="fw-bold text-center text-capitalize px-3
                                                         <?= $request['RequestStatus'] === null ? 'pending' : ($request['RequestStatus'] ? 'processing' : 'release') ?>
                                                         rounded-5">
                                                        <?= $status ?>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-file"></i> View Documents
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end overflow-y-auto p-3" style="width: 400px; max-height: 300px">
                                                            <div class="row row-cols-2 gx-3">
                                                                <?php foreach($documents as $doc): ?>
                                                                    <div class="col mb-3">
                                                                        <div class="bg-white doc_card border rounded shadow-sm" style="max-width: 180px">
                                                                            <div class="docCardIMG">
                                                                                <img src="../img/ID_cardDefault.jpg" class="card-img-top" alt="<?= $doc['DocumentName'] ?>">
                                                                            </div>
                                                                            <div class="px-2 pt-2">
                                                                                <div style="font-size: 12px; font-weight: bold" class="mb-1"><?= $doc['DocumentName'] ?></div>
                                                                                <p style="font-size: 8px"><?= $doc['DocumentDescription'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end align-middle" style="width: 20px">
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
                    <div class="col-12 col-xl-4 mt-3 mt-xl-0">
                        <div class="card border-0 shadow-lg overflow-hidden mb-3">
                            <?php include 'ad_calendar.php' ?>
                        </div>
                        <div class="card border-0 shadow-lg">
                            <div class="card-header h6">Events</div>
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