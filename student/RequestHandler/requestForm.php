<?php
session_start();
include '../../db_conn/view.php';
$view = new view();
$documents=$view->view_all_documents();
$departments = $view->dept_view_id($_SESSION['dept_id']);
$credentials = mysqli_fetch_assoc($departments);

$courses = $view->course_view_id($_SESSION['dept_id']);
isset($_POST['submit']) && $_SESSION['date'] = $_POST['date'];
?>

<style>
    .card-container {
        max-height: 55vh;
        overflow-y: auto;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
if(isset($_SESSION['success'])){
    echo "<script>$(document).ready(function(){toastr.success('".$_SESSION["success"]."');});</script>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo "<script>$(document).ready(function(){toastr.error('".$_SESSION["error"]."');});</script>";
    unset($_SESSION['error']);
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<link rel="stylesheet" href="../../assets/fontawesome-free-6.2.1-web/css/all.min.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<div class="container d-flex justify-content-center">
    <div class="p-5 col-sm-12 col-md-12 col-lg-12">
        <div class="card formCard mx-auto">
            <div class="card-header">
                <div class="text-lg-start text-md-center">
                    <img src="../../img/registrar.png" style="width: 100%; max-width: 500px" alt="evsu logo">
                </div>
            </div>
            <form method="post" action="submitRequest.php" enctype="multipart/form-data" class="m-0">
                <div class="row p-4">
                    <input type="hidden" name="department" value="<?php echo $credentials['dept']; ?>">
                    <div class="col-md-12 col-lg-4">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-5 col-lg-12 mb-3">
                                <h5>Education Status</h5>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-danger education-btn active" data-education-type="graduate">Graduate</button>
                                    <button type="button" class="btn btn-outline-danger education-btn" data-education-type="undergraduate">Undergraduate</button>
                                </div>
                                <input type="hidden" name="studentType" id="studentType">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-12">
                                <div class="form-group mb-4">
                                    <h5>Request Type:</h5>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-danger submission-btn active" data-submission-type="personal">Personal</button>
                                        <button type="button" class="btn btn-outline-danger submission-btn" data-submission-type="authorized">Authorized</button>
                                    </div>
                                    <input type="hidden" name="submissionType" id="submissionType" value="personal">
                                </div>
                                <div class="authorized-section d-none">
                                    <h5>Authorized Person:</h5>
                                    <div class="form-group mb-3">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                            </div>
                            <div class="authorized-section col-sm-12 col-md-5 col-lg-12 d-none">
                                <div class="w-100 mb-3">
                                    <img id="idPicturePreview" src="../../img/ID_cardDefault.jpg" alt="ID Picture" class="img-fluid rounded-3">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="idPicture"></label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-danger form-control" id="idPicture">ID Picture Upload</button>
                                        <input type="file" style="display:none;" name="idPicture" id="idPictureInput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-8">
                        <label class="h5">Documents:</label>
                        <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4 mt-3 card-container">
                            <?php while ($row = mysqli_fetch_assoc($documents)) : ?>
                                <div class="col">
                                    <div onclick="toggleCheckbox(<?= $row['DocumentID'] ?>)" style="cursor: pointer" class="card h-100" id="card<?= $row['DocumentID'] ?>">
                                        <div class="position-relative">
                                            <?php if (!isset($row['PreviewImage']) || $row['PreviewImage'] === '') : ?>
                                                <img src="../../img/ID_cardDefault.jpg" class="card-img-top" id="cardImg" alt="<?= $row['DocumentDescription'] ?>">
                                            <?php else : ?>
                                                <img src="<?= $row['PreviewImage'] ?>" class="card-img-top" id="cardImg" alt="<?= $row['DocumentDescription'] ?>">
                                            <?php endif; ?>
                                            <div class="position-absolute p-3 top-0 d-flex justify-content-between w-100">
                                                <div class="form-check">
                                                    <label>
                                                        <input type="checkbox" name="requestedDocuments[]" value="<?= $row['DocumentID'] ?>" class="form-check-input" autocomplete="off" <?php if (isset($_POST['requestedDocuments']) && in_array($row['DocumentID'], $_POST['requestedDocuments'])) { echo 'checked'; } ?>>
                                                    </label>
                                                </div>
                                                <button class="btn p-1 text-dark" type="button" data-bs-toggle="modal" data-bs-target="#documentModal<?= $row['DocumentID'] ?>">
                                                    <i class="fa-solid fa-expand fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body h-100">
                                            <?php
                                            $description = $row['DocumentDescription'];
                                            $lines = explode("\n", $description); // Split the text into an array of lines
                                            $output = implode("\n", array_slice($lines, 0, 2)); // Join the first two lines with a newline character
                                            if (strlen($output) > 55) { // Limit the output to 50 characters
                                                $output = substr($output, 0, 55) . '...';
                                            }
                                            echo '<small class="text-muted">' . $output . '</small>'; // Output the result
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Document modal -->
                                <div class="modal fade" id="documentModal<?= $row['DocumentID'] ?>" tabindex="-1" aria-labelledby="documentModalLabel<?= $row['DocumentID'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="documentModalLabel<?= $row['DocumentID'] ?>"><?= $row['DocumentDescription'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!isset($row['PreviewImage']) || $row['PreviewImage'] === '') : ?>
                                                    <img src="../../img/ID_cardDefault.jpg" class="img-fluid" alt="<?= $row['DocumentDescription'] ?>">
                                                <?php else : ?>
                                                    <img src="<?= $row['PreviewImage'] ?>" class="img-fluid" alt="<?= $row['DocumentDescription'] ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-3">
                    <button type="submit" name="submit" class="btn btn-primary w-25">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleCheckbox(id) {
        var checkbox = $('#card'+id).find('.form-check-input');
        var target = event.target;
        if (!$(target).closest('.form-check-input').length) {
            checkbox.prop('checked', !checkbox.prop('checked'));
        }
    }
    $(document).ready(function() {
        $(function() {
            $('.education-btn').click(function() {
                var educationType = $(this).data('education-type');
                if (educationType === 'undergraduate') {
                    $('.graduate-section').removeClass('d-none').find('select').prop('disabled', false);
                    $('#studentType').val('undergraduate');
                } else {
                    $('.graduate-section').addClass('d-none').find('select').prop('disabled', true);
                    $('#studentType').val('graduate');
                }
                $('.education-btn').removeClass('active');
                $(this).addClass('active');
            });
            $('.submission-btn').click(function() {
                const submissionType = $(this).data('submission-type');
                $('#submissionType').val(submissionType);
                $('.submission-btn').removeClass('active');
                $(this).addClass('active');
                $('.authorized-section').toggleClass('d-none', submissionType !== 'authorized');
            });

            $('#idPictureInput').on('change', function() {
                const input = this;
                const url = $(this).val();
                const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#idPicturePreview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#idPicturePreview').attr('src', '../../img/ID_cardDefault.jpg');
                }
            });

            $('#idPicture').click(function() {
                $('#idPictureInput').click();
            });
        });
    });
</script>
