<?php include '../main_libraries.php'; ?>

<button type="button" class="btn btn-primary" id="show-toast">
    Show Toast
</button>

<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast border-0 bg-primary-subtle" id="myToast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header d-flex justify-content-between">
            <div class="fs-6 d-flex align-items-center">
                <div class="bg-danger-subtle text-danger p-2 rounded-3 me-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="text-uppercase">sorry there war an error</div>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <div class="progress" role="progressbar" aria-label="Example 3px high" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 3px">
                <div class="progress-bar bg-primary" id="myProgressBar"></div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function() {
        var myToast = new bootstrap.Toast(document.querySelector('#myToast'));
        var myProgressBar = document.querySelector('#myProgressBar');
        var progressBarWidth = 100;
        var intervalId;

        document.querySelector('#show-toast').addEventListener('click', function() {
            progressBarWidth = 100; // reset the progress bar width
            myProgressBar.style.width = progressBarWidth + '%';

            myToast.show();

            intervalId = setInterval(function() {
                if (progressBarWidth <= 0) {
                    clearInterval(intervalId);
                    myToast.hide();
                } else {
                    progressBarWidth -= 1;
                    myProgressBar.style.width = progressBarWidth + '%';
                }
            }, 20);
        });
    });
</script>
