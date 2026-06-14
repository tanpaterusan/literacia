<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

require 'function/function.php';

$buku = query("SELECT * FROM buku WHERE DELETED = 0");

include 'templates/header.php';
include 'templates/sidebar.php';

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Home</h1>
            <ol class="breadcrumb mb-4">
                <!-- <li class="breadcrumb-item active">Home</li> -->
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-black mb-4">
                        <div class="card-body">Sedang Dibaca</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-black stretched-link" href="baca.php">View Details</a>
                            <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-black mb-4">
                        <div class="card-body">Sedang Ditulis</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-black stretched-link" href="nulis.php">View Details</a>
                            <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-dark text-white mb-4">
                        <div class="card-body">Daftar User</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="user.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5><b>Daftar Buku</b></h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Genre</th>
                                <th>Penulis Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($buku as $b) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $b["judul"]; ?></td>
                                    <td><?= $b["genre"]; ?></td>
                                    <td><?= $b["penulis"]; ?></td>
                                    <td><?= $b["status"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php
    include 'templates/footer.php';
