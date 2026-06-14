<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uts3");


function query($query)
{

    //ambil (fetch) data dari tabel:
    //mysqli_fetch_row() //mengembalikan array numerik (yang indeksnya angka)
    //mysqli_fetch_assoc() // mengembalikan array asosiatif (string/nama)
    //mysqli_fetch_array() //mengembalikan keduanya, kelemahannya data yang disajikan doble
    //mysqli_fetch_object() // mengembalikan object

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function regist($data)
{
    global $conn;
    //ambil data
    $nama = stripslashes($data["nama"]);
    $alamat = stripslashes($data["alamat"]);
    $kontak = stripslashes($data["kontak"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $role = stripslashes($data["role"]);

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
			 </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO user
	          VALUES 
	          ('$nama', '$alamat', '$kontak', '$username', '$password', '$role', 0)
	          ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function addBaca($data)
{
    global $conn;
    //ambil data
    $judul = $data["judul"];
    $genre =  $data["genre"];
    $penulis = $data["penulis"];
    $review =  $data["review"];
    $pembaca = $data["pembaca"];
    $tanggal = date('Y-m-d H:i:s', time());
    $deleted = 0;

    // ambil id berdasar judul:
    preg_match_all('/\b\w/', $judul, $matches);
    $id = implode("", $matches[0]);

    //query insert blj
    $query = "INSERT INTO baca_buku
			  VALUES
			  ('$id', '$judul', '$penulis', '$tanggal',  '$review',  $deleted, '$pembaca', '$genre')
			  ";

    //query insert buku
    $queryBuku = "INSERT INTO buku
			  VALUES
			  ('$id', '', '$id', '$judul', '$penulis', 'dibaca', '$genre', 0)
			  ";

    mysqli_query($conn, $query);
    mysqli_query($conn, $queryBuku);
    return mysqli_affected_rows($conn);
}

function ubahBaca($data)
{
    global $conn;
    //ambil data
    $id = $data["id"];
    $review = $data["review"];

    //query update data
    $query = "UPDATE baca_buku SET
	          review = '$review'
	          WHERE id = '$id'	                  
	          ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusBaca($data)
{
    global $conn;
    $id = $data["id"];
    //query hapus data:
    $query = "UPDATE baca_buku SET
	          deleted = 1
	          WHERE id = '$id'	                  
	          ";

    //query hapus buku:
    $queryBuku = "UPDATE buku SET
	          deleted = 1
	          WHERE id = '$id'	                  
	          ";
    mysqli_query($conn, $query);
    mysqli_query($conn, $queryBuku);
    return mysqli_affected_rows($conn);
}

function addNulis($data)
{
    global $conn;

    //ambil data
    $judul = $data["judul"];
    $genre = $data["genre"];
    $penulis = $data["penulis"];
    $premis = $data["premis"];
    $sinopsis = $data["sinopsis"];
    $target_selesai = $data["target_selesai"];
    $progress =  $data["progress"];
    $status =  $data["status"];
    $deleted = 0;

    // ambil id berdasar judul:
    preg_match_all('/\b\w/', $judul, $matches);
    $id = implode("", $matches[0]);

    //query insert nulis_buku
    $query = "INSERT INTO nulis_buku
			  VALUES
			  ('$id', '$judul', '$premis', '$sinopsis',  '$target_selesai', '$progress',  $deleted, '$penulis', '$status', '$genre')
			  ";

    //query insert buku
    $queryBuku = "INSERT INTO buku
			  VALUES
			  ('$id', '$id', '', '$judul', '$penulis', 'ditulis', '$genre', 0)
			  ";

    mysqli_query($conn, $query);
    mysqli_query($conn, $queryBuku);
    return mysqli_affected_rows($conn);
}

function ubahNulis($data)
{
    global $conn;

    //ambil data
    $id = $data["id"];
    $premis = mysqli_real_escape_string($conn, $data["premis"]);
    $sinopsis = mysqli_real_escape_string($conn, $data["sinopsis"]);

    //query update data
    $query = "UPDATE nulis_buku SET
                premis = '$premis',
                sinopsis = '$sinopsis'
	          WHERE id = '$id'	                  
	          ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusNulis($data)
{
    global $conn;
    $id = $data["id"];

    //query hapus data:
    $query = "UPDATE nulis_buku SET
	          deleted = 1
	          WHERE id = '$id'	                  
	          ";

    // query hapus buku:
    $queryBuku = "UPDATE buku SET
              deleted = 1
              WHERE id = '$id'	                  
              ";

    mysqli_query($conn, $query);
    mysqli_query($conn, $queryBuku);
    return mysqli_affected_rows($conn);
}
