<style>
    .active{
        color: #1a1a1a !important;
        border-right: 3px solid #ff3636;
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 0%, rgba(255,226,226,0.7987570028011204) 100%);
    }
</style>
<div class="px-3" style="border-radius: 0 0 1em 1em; background: #d54b4b">
    <div style="max-width: 70px; padding: 1.5em 0">
        <div class="d-flex justify-content-center">
            <a href="#" class="hmbrgr four"></a>
        </div>
    </div>

    <div class="w-100 py-3 me-3">
        <div id="btn" class="card-img rounded-circle m-auto" style="max-width: 4.5rem; max-height: 4.5rem; border: 2px solid white">
            <img src="../img/logo.png" class="" style="width: 100%; object-fit: cover" alt="logo">
        </div>
        <div class="tlink fs-4 mt-2 fw-bolder text-light text-center overflow-hidden">REGISTRAR</div>
        <div class="tlink text-light text-center" style="font-size: .8rem; font-family: 'Poppins', sans-serif">Admin Access</div>
    </div>
</div>

<div class="mt-4">
    <ul id="menu" class="m-0 p-0" style="list-style: none">
        <li>
            <a href="dashboard.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="tlink overflow-hidden">Dashboard</span>
            </a>
        </li>
        <li>
            <div class="d-flex links text-decoration-none" >
                <div class="btn-group dropend w-100">
                    <div class="w-100 py-3 d-flex data-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="iContainer mx-3">
                            <i class="fa-regular fa-square-plus"></i>
                        </div>
                        <span class="tlink overflow-hidden w-100">Add</span>
                    </div>
                    <ul class="dropdown-menu shadow-lg p-0 border-0 bg-light">
                        <li><a class="dropdown-item bg-light text-secondary" href="Admins.php">Employees</a></li>
                        <li><a class="dropdown-item bg-light text-secondary" href="certifications.php">Certificates</a></li>
                        <li><a class="dropdown-item bg-light text-secondary" href="dept_course.php">Department/Courses</a></li>
                        <li><a class="dropdown-item bg-light text-secondary" href="student.php">Student</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <a href="ad_main.php" class="d-flex py-3 links text-decoration-none" >
                <div class="iContainer mx-3">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <span class="tlink overflow-hidden">New Requests</span>
            </a>
        </li>
        <li>
            <a href="appointments.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <span class="tlink overflow-hidden">Requests</span>
            </a>
        </li>
        <li>
            <a href="event_manager.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <span class="tlink overflow-hidden">Calendar</span>
            </a>
        </li>

        <li>
            <a href="app_archive.php" class="d-flex py-3 links text-decoration-none">
                <div class="iContainer mx-3">
                    <i class="fa-solid fa-archive"></i>
                </div>
                <span class="tlink overflow-hidden">Reports</span>
            </a>
        </li>
    </ul>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../assets/js/jquery.hmbrgr.js"></script>
<script src="../assets/js/sidebar.js"></script>

<script type="text/javascript">
    $(document).ready(function ($){
        var path = window.location.pathname.split("/").pop();
        if (path === ''){
            path = 'ad_main.php';
        }
        var target = $('ul li a[href="'+path+'"]');
        target.addClass('active');
    });
</script>
