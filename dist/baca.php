<?php
require 'function/function.php';
$baca = query("SELECT * FROM baca_buku WHERE DELETED = 0");

include 'templates/header.php';
include 'templates/sidebar.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Baca dan Review Buku</h1>
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
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#bacaBuku">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Review
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Genre</th>
                                <th>Penulis Buku</th>
                                <th>Review</th>
                                <th>Reviewer/Pembaca</th>
                                <th>Tanggal Review</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($baca as $b) : ?>
                                <tr class="odd gradeX">
                                    <td><?= $b["judul"]; ?></td>
                                    <td><?= $b["genre"]; ?></td>
                                    <td><?= $b["penulis"]; ?></td>
                                    <td><?= $b["review"]; ?></td>
                                    <td><?= $b["pembaca"]; ?></td>
                                    <td><?= $b["tanggal"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#hapusModal"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-id="<?= $b['id']; ?>"
                                            role="button">
                                            <i class="fa fa-trash"></i>Hapus
                                        </a>
                                        <i class="fa-solid fa-arrows-up-down"></i>
                                        <a href="#ubahModal"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-id="<?= $b['id']; ?>"
                                            data-bs-review="<?= $b['review']; ?>"
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
        if (addBaca($_POST) > 0) {
            echo "
                                <script>
                                    alert('review berhasil ditambahkan!');
                                    document.location.href = 'baca.php';
                                </script>
                             ";
        } else {
            echo "
                                <script>
                                    alert('review gagal ditambahkan!');
                                    document.location.href = 'baca.php';
                                </script>
                             ";
        }
    }

    // submit ubah:
    if (isset($_POST["ubah"])) {
        //cek apakah data berhasil diubah
        if (ubahBaca($_POST) > 0) {
            echo "
                                <script>
                                    alert('review berhasil diubah!');
                                    document.location.href = 'baca.php';
                                </script>
                             ";
        } else {
            echo "
                                <script>
                                    alert('review gagal diubah!');
                                    document.location.href = 'baca.php';
                                </script>
                             ";
        }
    }

    // hapus
    if (isset($_POST["hapus"])) {
        if (hapusBaca($_POST) > 0) {
            //cek apakah data berhasil diubah
            echo "
                <script>
                    alert('data berhasil dihapus!');
                    document.location.href = 'baca.php';
                </script>
    
             ";
        } else {
            echo "
                <script>
                    alert('data gagal dihapus!');
                    document.location.href = 'baca.php';
                </script>
             ";
        }
    }
    ?>

    <!-- Modal Tambah Review -->
    <div class="modal fade" id="bacaBuku" tabindex="-1" role="dialog" aria-labelledby="bacaBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bacaBukuLabel">Tambah Review</h5>
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
                            <label>Review : </label>
                            <input class="form-control" type="textarea" name="review" id="review">
                        </div>
                        <div class="form-group ">
                            <label>Reviewer/Pembaca : </label>
                            <input class="form-control" type="text" name="pembaca" id="pembaca">
                        </div>

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
                            <label for="edit-review" class="form-label">Review</label>
                            <textarea name="review" id="edit-review" class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
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
            const review = button.getAttribute('data-bs-review');

            const inputId = ubahModal.querySelector('#edit-id');
            const inputReview = ubahModal.querySelector('#edit-review');

            inputId.value = id;
            inputReview.value = review;
        });


        const hapusModal = document.getElementById('hapusModal');
        hapusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-bs-id');
            const inputId = hapusModal.querySelector('#hapus-id');

            inputId.value = id;
        });
    </script>