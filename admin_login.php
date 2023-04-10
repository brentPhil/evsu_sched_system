<?php include '_libraries.php'?>
<div class="container h-100">
    <div class="row h-100 d-flex align-items-center justify-content-center">
        <div class="card p-0 shadow-lg border-0 col-sm-12 col-md-10 col-lg-6 col-xl-5">
            <div class="card-header bg_primary d-flex text-light rounded-bottom border-0">
                <div class="m-4">
                    <img src="img/logo.png" alt="" style="min-width: 50px;max-width: 130px">
                </div>
                <div class="d-grid align-content-center">
                    <h3 style="font-weight: 800; font-family: 'Poppins', sans-serif">ADMIN LOGIN</h3>
                    <h6>OFFICE OF THE REGISTRAR EVSU-TC</h6>
                </div>
            </div>
            <div class="form px-5 pt-4">
                <form action="db_conn/admin_login.php" method="POST">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="text-danger"><i class="fa-solid fa-warning me-3"></i><?php echo $_GET['error']; ?></span>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                        <label for="floatingInput"><i class="fa-solid fa-user me-3"></i>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput" name="password" placeholder="password">
                        <label for="floatingInput"><i class="fa-solid fa-lock me-3"></i>Password</label>
                    </div>

                    <button class="btn btn-danger bg_primary w-100 py-3" name="login" type="submit">Login</button>
                    <div class="text-center pt-3">
                        <p>Click <a href="student_login.php">here!</a> for Student</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>