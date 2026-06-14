<?php
// session_start();

// if (isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }

require 'function/function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Buat Akun</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nama" id="nama" type="text" placeholder="nama" />
                                            <label for="nama">Nama Lengkap</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="alamat" id="alamat" type="text" placeholder="alamat" />
                                            <label for="alamat">Alamat</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="kontak" id="kontak" type="text" placeholder="kontak" />
                                            <label for="kontak">Kontak</label>
                                        </div>
                                        <!-- <div class="form-floating mb-3">
                                            <label for="role">Role/Status</label>
                                            <select class="form-control" name="role" id="role">
                                                <option selected>Pilih Role/Status</option>
                                                <option value="admin">admin</option>
                                                <option value="user">user</option>
                                            </select>
                                        </div> -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="role">Pilih Role/Status</label>
                                            </div>
                                            <select class="form-control" name="role" id="role">
                                                <option selected>Pilih Role/Status</option>
                                                <option value="admin">admin</option>
                                                <option value="user">user</option>
                                            </select>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text" placeholder="username" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password" id="password" type="password" placeholder="Create a password" />
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password2" id="password2" type="password" placeholder="Confirm password" />
                                                    <label for="password2">Konfirmasi Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" name="register" class="btn btn-primary">Buat Akun</button>
                                                <!-- <a class="btn btn-primary btn-block" href="login.html">Buat Akun</a> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Sudah punya akun? Login sekarang!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <?php
        if (isset($_POST["register"])) {
            if (regist($_POST) > 0) {
                echo "<script>
                            alert('Selamat! Anda telah terdaftar!');
                            document.location.href = 'login.php';
                        </script>";
            } else {
                echo "<script>
                            alert('Mohon maaf user gagal daftar!');
                            document.location.href = 'register.php';
                        </script>";
                // mysqli_error($conn);
            }
        }
        ?>

        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>

</html>