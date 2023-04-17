<?php
include '../db_conn/view.php';
include '../db_conn/insert.php';

$insert = new insert();
$view = new view();
$certificate=$view->view_all_documents();

if (isset($_POST['new_cert'])){
    $insert->new_cert($_POST['title'], $_POST['desc']);
    header("Location: certifications.php");
    exit();
}

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
                        <li class="breadcrumb-item text-secondary" aria-current="page">Certifications</li>
                    </ol>
                </nav>
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Certifications
                        </h6>
                        <button type="button" class="btn btn-outline-primary" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#add_certificate">
                            <i class="fa fa-plus-circle me-1"></i>Add Certificates
                        </button>
                    </div>
                    <div class="modal fade" id="add_certificate" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered border-3">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title fs-5" id="exampleModalLabel">New Certificate</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="pb-0">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Certificate Title:</label>
                                            <input name="title" type="text" required class="form-control" id="exampleFormControlInput1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                                            <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" name="new_cert" type="submit">add certificate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- View Appointments -->
                    <div class="card-body h-100">
                        <div class="table-responsive" style="height: 58vh;">
                            <table id="certable" class="display">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>description</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($certificate as $options){?>
                                    <tr>
                                        <td><?php echo $options['name'] ?></td>
                                        <td><?php echo $options['description'] ?></td>
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