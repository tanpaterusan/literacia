<?php
require 'function/function.php';
$query = "SELECT id, judul, premis, sinopsis, target_selesai, 
            CONCAT(progress,'%') AS progress, 
            deleted, penulis, 
            CASE 
                WHEN status = 1 THEN 'Selesai'
                WHEN status = 2 THEN 'In Progress'
                WHEN status = 3 THEN 'Pending'
            END AS status,
            genre
            FROM nulis_buku WHERE DELETED = 0";

$nulis = query($query);

include 'templates/header.php';
include 'templates/sidebar.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Project Menulis Buku</h1>
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
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#nulisBuku">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Project
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Genre</th>
                                <th>Penulis</th>
                                <th>Premis</th>
                                <th>Sinopsis</th>
                                <th>Target Selesai</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($nulis as $n) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $n["judul"]; ?></td>
                                    <td><?= $n["genre"]; ?></td>
                                    <td><?= $n["penulis"]; ?></td>
                                    <td><?= $n["premis"]; ?></td>
                                    <td><?= $n["sinopsis"]; ?></td>
                                    <td><?= $n["target_selesai"]; ?></td>
                                    <td><?= $n["progress"]; ?></td>
                                    <td><?= $n["status"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#hapusModal"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-id="<?= $n['id']; ?>"
                                            role="button">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                        <i class="fa-solid fa-arrows-up-down"></i>
                                        <a href="#ubahModal"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-id="<?= $n['id']; ?>"
                                            data-bs-premis="<?= $n['premis']; ?>"
                                            data-bs-sinopsis="<?= $n['sinopsis']; ?>"
                                            role="button">
                                            Edit
                                        </a>

                                    </td>
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

    // submit tambah:
    if (isset($_POST["add"])) {
        //cek apakah data berhasil ditambahkan
        if (addNulis($_POST) > 0) {
            echo "
                                <script>
                                    alert('project berhasil ditambahkan!');
                                    document.location.href = 'nulis.php';
                                </script>
                             ";
        } else {
            echo "
                                <script>
                                    alert('project gagal ditambahkan!');
                                    document.location.href = 'nulis.php';
                                </script>
                             ";
        }
    }

    // submit ubah:
    if (isset($_POST["ubah"])) {
        //cek apakah data berhasil diubah
        if (ubahNulis($_POST) > 0) {
            echo "
                    <script>
                        alert('project berhasil diubah!');
                        document.location.href = 'nulis.php';
                    </script>
                    ";
        } else {
            echo "
                    <script>
                        alert('project gagal diubah!');
                        document.location.href = 'nulis.php';
                    </script>
                    ";
        }
    }

    //  hapus
    if (isset($_POST["hapus"])) {
        if (hapusNulis($_POST) > 0) {
            //cek apakah data berhasil dihapus
            echo "
                <script>
                    alert('data berhasil dihapus!');
                    document.location.href = 'nulis.php';
                </script>
    
             ";
        } else {
            echo "
                <script>
                    alert('data gagal dihapus!');
                    document.location.href = 'nulis.php';
                </script>
             ";
        }
    }
    ?>

    <!-- Modal Tambah Project -->
    <div class="modal fade" id="nulisBuku" tabindex="-1" role="dialog" aria-labelledby="nulisBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nulisBukuLabel">Tambah Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Judul Buku : </label>
                            <input class="form-control" type="text" name="judul" id="judul">
                        </div>
                        <div class="form-group">
                            <label>Genre : </label>
                            <input class="form-control" type="text" name="genre" id="genre">
                        </div>
                        <div class="form-group ">
                            <label>Penulis : </label>
                            <input class="form-control" type="text" name="penulis" id="penulis">
                        </div>
                        <div class="form-group ">
                            <label>Premis : </label>
                            <textarea class="form-control" name="premis" id="premis"></textarea>
                        </div>
                        <div class="form-group ">
                            <label>Sinopsis : </label>
                            <textarea class="form-control" name="sinopsis" id="sinopsis"></textarea>
                        </div>
                        <div class="form-group ">
                            <label>Target Selesai : </label>
                            <input class="form-control" type="text" name="target_selesai" id="target_selesai">
                        </div>
                        <div class="form-group">
                            <label>Progress</label>
                            <input type="range" class="form-range" name="progress" id="progress" min="0" max="100">
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                                        <label class="form-check-label" for="status1">
                                            Selesai
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2" value="2">
                                        <label class="form-check-label" for="status2">
                                            In progress
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="status" id="status3" value="3">
                                        <label class="form-check-label" for="status3">
                                            Pending
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="ubahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label for="edit-premis" class="form-label">Premis</label>
                            <textarea name="premis" id="edit-premis" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-sinopsis" class="form-label">Sinopsis</label>
                            <textarea name="sinopsis" id="edit-sinopsis" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus data ini?</p>
                        <input type="hidden" name="id" id="hapus-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const ubahModal = document.getElementById('ubahModal');
        ubahModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            const id = button.getAttribute('data-bs-id');
            const premis = button.getAttribute('data-bs-premis');
            const sinopsis = button.getAttribute('data-bs-sinopsis');

            const inputId = ubahModal.querySelector('#edit-id');
            const inputPremis = ubahModal.querySelector('#edit-premis');
            const inputSinopsis = ubahModal.querySelector('#edit-sinopsis');

            inputId.value = id;
            inputPremis.value = premis;
            inputSinopsis.value = sinopsis;
        });


        const hapusModal = document.getElementById('hapusModal');
        hapusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-bs-id');
            const inputId = hapusModal.querySelector('#hapus-id');

            inputId.value = id;
        });
    </script>