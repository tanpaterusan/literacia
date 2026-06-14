<?php
require 'function/function.php';
$baca = query("SELECT * FROM buku WHERE DELETED = 0");

include 'templates/header.php';
include 'templates/sidebar.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Buku</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                    <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                    .
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Genre</th>
                                <th>Penulis Buku</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($baca as $b) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $b["judul"]; ?></td>
                                    <td><?= $b["genre"]; ?></td>
                                    <td><?= $b["penulis"]; ?></td>
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
