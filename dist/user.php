<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

require 'function/function.php';

$user = query("SELECT * FROM user WHERE DELETED = 0");

include 'templates/header.php';
include 'templates/sidebar.php';

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <i class="fa-solid fa-users"></i> Daftar Semua User </h2>
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kontak</th>
                                <th>Username</th>
                                <th>Role/Peran/Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($user as $u) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $u["nama"]; ?></td>
                                    <td><?= $u["alamat"]; ?></td>
                                    <td><?= $u["kontak"]; ?></td>
                                    <td><?= $u["username"]; ?></td>
                                    <td><?= $u["role"]; ?></td>
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
