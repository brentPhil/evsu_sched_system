<?php
include '../../db_conn/view.php';
$view = new view();
$documents=$view->view_all_documents();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<div class="container d-flex justify-content-center">
    <div class="p-5 col-sm-12 col-md-8 col-lg-8">
    <div class="card mx-auto">
        <div class="card-header">
            <div class="text-center">
                <img src="../../img/registrar.png" style="width: 100%; max-width: 500px" alt="evsu logo">
            </div>
        </div>
        <div class="card-body bg-secondary-subtle">
            <form class="d-grid gap-3">
                <div class="form-group">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="submissionType" value="personal" checked> Personal
                    </label>
                    <label class="form-check-label ml-3">
                        <input type="radio" class="form-check-input" name="submissionType" value="authorized"> Authorized
                    </label>
                </div>
                <div class="authorized-section" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group mb-3">
                        <label for="idPicture">ID Picture Upload</label>
                        <input type="file" class="form-control-file" id="idPicture" name="idPicture">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="studentType" value="undergraduate" checked>Graduate
                    </label>
                    <label class="form-check-label ml-3">
                        <input type="radio" class="form-check-input" name="studentType" value="graduate"> Undergraduate
                    </label>
                </div>
                <div class="graduate-section" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="course">Course of Study</label>
                        <select class="form-control" id="course" name="course" disabled>
                            <option value="">-- Select Course --</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Business Administration">Business Administration</option>
                        </select>
                    </div>
                </div>
                <div class="p-3 bg-white rounded-3">
                    <div class="form-group d-grid gap-3">
                        <label class="h5">Documents:</label>
                        <?php
                        while ($row = mysqli_fetch_assoc($documents)) {
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" name="requestedDocuments[]" value="'.$row['DocumentName'].'">';
                            echo '<label class="form-check-label">'.$row['DocumentDescription'].'</label>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[name="studentType"]').on('change', function() {
            if ($(this).val() === 'graduate') {
                $('#course').prop('disabled', false);
                $('.graduate-section').show();
            } else {
                $('#course').prop('disabled', true);
                $('.graduate-section').hide();
            }
        });
        $(function() {
            $('input[name="submissionType"]').change(function() {
                $('.authorized-section').toggle($(this).val() === 'authorized');
            });
            $('input[name="studentType"]').change(function() {
                $('#course').prop('disabled', $(this).val() !== 'graduate');
                $('.graduate-section').toggle($(this).val() === 'graduate');
            });
        });
    });
</script>
