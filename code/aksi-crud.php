<?php
include "../authentication/koneksi.php";


/** START CRUD PETUGAS */
// Petugas Tambah
if (isset($_POST['petugassimpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $user_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username'"));
    $petugas_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM petugas WHERE Username='$username'"));

    if ($petugas_check > 0 || $user_check > 0) {
        echo '<script>alert("Username sudah digunakan"); location.href="index.php?page=petugas"</script>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO petugas(Nama, Username, Password, Level) VALUES ('$nama', '$username', '$password', '$level')");

        if ($query) {
            echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=petugas';</script>";
        } else {
            echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=petugas';</script>";
        }
    }
}

// Petugas Ubah
if (isset($_POST['petugasubah'])) {
    $petugasID = $_POST['petugasID'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $user_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username'"));
    $petugas_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM petugas WHERE Username='$username'"));

    if ($petugas_check > 0 || $user_check > 0) {
        echo '<script>alert("Username sudah digunakan"); location.href="index.php?page=petugas"</script>';
    } else {
        $query = mysqli_query($koneksi, "UPDATE petugas SET Nama='$nama', Username='$username', Level='$level' WHERE PetugasID = $petugasID");

        if ($_POST['password'] != "") {
            $query = mysqli_query($koneksi, "UPDATE petugas SET Password='$password' WHERE PetugasID = $petugasID");
        }
        if ($query) {
            echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=petugas';</script>";
        } else {
            echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=petugas';</script>";
        }
    }
}

// Petugas Hapus
if (isset($_POST['petugashapus'])) {
    $petugasID = $_POST['petugasID'];

    $query = mysqli_query($koneksi, "DELETE FROM petugas WHERE PetugasID=$petugasID");
    if ($query) {
        echo "<script>alert('Hapus data berhasil!'); location.href='index.php?page=petugas';</script>";
    } else {
        echo "<script>alert('Hapus data gagal!'); location.href='index.php?page=petugas';</script>";
    }
}
/** END CRUD PETUGAS */





/** START CRUD USER */
// User Hapus
if (isset($_POST['userhapus'])) {
    $userID = $_POST['userID'];

    $query = mysqli_query($koneksi, "DELETE FROM user WHERE UserID=$userID");
    if ($query) {
        echo "<script>alert('Hapus data berhasil!'); location.href='index.php?page=user';</script>";
    } else {
        echo "<script>alert('Hapus data gagal!'); location.href='index.php?page=user';</script>";
    }
}
/** END CRUD ULASAN */






/** START CRUD KATEGORI */
// Kategori Simpan
if (isset($_POST['kategorisimpan'])) {
    $namakategori = $_POST['namakategori'];

    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku(NamaKategori) VALUES ('$namakategori')");
    if ($query) {
        echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=kategori';</script>";
    } else {
        echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=kategori';</script>";
    }
}

// Kategori Ubah
if (isset($_POST['kategoriubah'])) {
    $namakategori = $_POST['namakategori'];
    $kategoriID = $_POST['kategoriID'];

    $query = mysqli_query($koneksi, "UPDATE kategoribuku SET NamaKategori='$namakategori' WHERE KategoriID=$kategoriID");
    if ($query) {
        echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=kategori';</script>";
    } else {
        echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=kategori';</script>";
    }
}

// Kategori Hapus
if (isset($_POST['kategorihapus'])) {
    $kategoriID = $_POST['kategoriID'];

    $query = mysqli_query($koneksi, "DELETE FROM kategoribuku WHERE KategoriID=$kategoriID");
    if ($query) {
        echo "<script>alert('Hapus data berhasil!'); location.href='index.php?page=kategori';</script>";
    } else {
        echo "<script>alert('Hapus data gagal!'); location.href='index.php?page=kategori';</script>";
    }
}
/** END CRUD KATEGORI */





/** START CRUD BUKU */
// Buku Tambah
if (isset($_POST['bukusimpan'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunterbit = $_POST['tahunterbit'];
    $stok = $_POST['stok'];

    $query_buku = mysqli_query($koneksi, "INSERT INTO buku(Judul, Penulis, Penerbit, TahunTerbit, StokBuku) VALUES ('$judul', '$penulis', '$penerbit', '$tahunterbit', '$stok')");

    if ($query_buku) {
        $buku_id = mysqli_insert_id($koneksi);

        if ($_POST['kategori'] != "") {
            $kategori = $_POST['kategori'];
            $query_relasi = mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi(KategoriID, BukuID) VALUES ('$kategori', '$buku_id')");

            if ($query_relasi) {
                echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=buku';</script>";
            } else {
                echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=buku';</script>";
            }
        } else {
            echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=buku';</script>";
        }
    } else {
        echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=buku';</script>";
    }
}

// Buku Ubah
if (isset($_POST['bukuubah'])) {
    $bukuID = $_POST['bukuID'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunterbit = $_POST['tahunterbit'];
    $stok = $_POST['stok'];

    $query_buku = mysqli_query($koneksi, "UPDATE buku SET Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahunterbit', StokBuku='$stok' WHERE BukuID=$bukuID");

    if ($query_buku) {
        if ($_POST['kategori'] != "") {
            $kategori = $_POST['kategori'];
            $query_relasi = mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET KategoriID = '$kategori' WHERE BukuID = $bukuID ");

            if ($query_relasi) {
                echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=buku';</script>";
            } else {
                echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=buku';</script>";
            }
        } else {
            echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=buku';</script>";
        }
    } else {
        echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=buku';</script>";
    }
}

// Buku Hapus
if (isset($_POST['bukuhapus'])) {
    $bukuID = $_POST['bukuID'];

    $query = mysqli_query($koneksi, "DELETE FROM buku WHERE BukuID=$bukuID");
    if ($query) {
        echo "<script>alert('Hapus data berhasil!'); location.href='index.php?page=buku';</script>";
    } else {
        echo "<script>alert('Hapus data gagal!'); location.href='index.php?page=buku';</script>";
    }
}
/** END CRUD BUKU */





/** START CRUD ULASAN */
// Ulasan Tambah
if (isset($_POST['ulasansimpan'])) {
    $user = $_POST['user'];
    $judul = $_POST['judul'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    $query = mysqli_query($koneksi, "INSERT INTO ulasanbuku(UserID, BukuID, Ulasan, Rating) VALUES ('$user', '$judul', '$ulasan', '$rating')");
    if ($query) {
        echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=ulasan';</script>";
    } else {
        echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=ulasan';</script>";
    }
}

// Ulasan Ubah
if (isset($_POST['ulasanubah'])) {
    $ulasanID = $_POST['ulasanID'];
    $user = $_POST['user'];
    $judul = $_POST['judul'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    $query = mysqli_query($koneksi, "UPDATE ulasanbuku SET BukuID='$judul', Ulasan='$ulasan', Rating='$rating' WHERE UlasanID=$ulasanID");
    if ($query) {
        echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=ulasan';</script>";
    } else {
        echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=ulasan';</script>";
    }
}

// Ulasan Hapus
if (isset($_POST['ulasanhapus'])) {
    $ulasanID = $_POST['ulasanID'];

    $query = mysqli_query($koneksi, "DELETE FROM ulasanbuku WHERE UlasanID=$ulasanID");
    if ($query) {
        echo "<script>alert('Hapus data berhasil!'); location.href='index.php?page=ulasan';</script>";
    } else {
        echo "<script>alert('Hapus data gagal!'); location.href='index.php?page=ulasan';</script>";
    }
}
/** END CRUD ULASAN */





/** START CRUD PEMINJAMAN */
// Peminjaman Tambah
if (isset($_POST['peminjamansimpan'])) {
    $user = $_POST['user'];
    $judul = $_POST['judul'];
    $jmlPinjam = $_POST['jmlPinjam'];
    $tglPeminjaman = $_POST['tglPeminjaman'];
    $tglPengembalian = date('Y-m-d', strtotime($_POST['tglPeminjaman'] . ' +14 days'));
    $statusPeminjaman = "Dipinjam";

    $stok_query = mysqli_query($koneksi, "SELECT StokBuku FROM buku WHERE BukuID = '$judul'");
    if(mysqli_num_rows($stok_query) > 0) {
        $data = mysqli_fetch_assoc($stok_query);
        $stok = $data['StokBuku'];

        if ($jmlPinjam > $stok) {
            echo "<script>alert('Stok Habis!'); location.href='index.php?page=peminjaman';</script>";
        } else {

            $query_peminjaman = mysqli_query($koneksi, "INSERT INTO peminjaman(UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman, JumlahPinjam) VALUES ('$user', '$judul', '$tglPeminjaman', '$tglPengembalian','$statusPeminjaman', '$jmlPinjam')");

            if ($query_peminjaman) {
                echo "<script>alert('Tambah data berhasil!'); location.href='index.php?page=peminjaman';</script>";
            } else {
                echo "<script>alert('Tambah data gagal!'); location.href='index.php?page=peminjaman';</script>";
            }
        }
    } else {
        echo "<script>alert('Buku tidak ditemukan!'); location.href='index.php?page=peminjaman';</script>";
    }
}


// Peminjaman Ubah
if (isset($_POST['peminjamanubah'])) {
    $peminjamanID = $_POST['peminjamanID'];
    $judul = $_POST['judul'];
    $tglPeminjaman = $_POST['tglPeminjaman'];
    $tglPengembalian = $_POST['tglPengembalian'];
    $statusPeminjaman = $_POST['statusPeminjaman'];
    $jmlPinjam = $_POST['jmlPinjam'];

    $query = mysqli_query($koneksi, "UPDATE peminjaman SET BukuID='$judul', TanggalPeminjaman='$tglPeminjaman', TanggalPengembalian='$tglPengembalian', StatusPeminjaman='$statusPeminjaman', JumlahPinjam='$jmlPinjam' WHERE PeminjamanID=$peminjamanID");

    if ($_POST["statusPeminjaman"] == "Dikembalikan") {
        $query_update_stock = mysqli_query($koneksi, "UPDATE buku SET StokBuku=StokBuku+'$jmlPinjam' WHERE BukuID=$judul");

        if (date('Y-m-d') > $tglPengembalian) {
            $keterangan = 'Terlambat';
        } else {
            $keterangan = 'Tepat Waktu';
        }

        $query_update_status = mysqli_query($koneksi, "UPDATE peminjaman SET Keterangan='$keterangan' WHERE PeminjamanID=$peminjamanID");
    }

    if ($query && $query_update_stock && $query_update_status) {
        echo "<script>alert('Ubah data berhasil!'); location.href='index.php?page=peminjaman';</script>";
    } else {
        echo "<script>alert('Ubah data gagal!'); location.href='index.php?page=peminjaman';</script>";
    }
}
/** END CRUD PEMINJAMAN */





/** START CRUD KOLEKSI PRIBADI */
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add') {
    $bukuID = $_POST['bukuID'];
    $userID = $_POST['userID'];

    $query = "INSERT INTO koleksipribadi (UserID, BukuID) VALUES ($userID, $bukuID)";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo 'Buku berhasil ditambahkan ke koleksi!';
    } else {
        echo 'Buku gagal ditambahkan ke koleksi!';
    }
} elseif ($action === 'remove') {
    $bukuID = $_POST['bukuID'];
    $userID = $_POST['userID'];

    $query = "DELETE FROM koleksipribadi WHERE UserID = $userID AND BukuID = $bukuID";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo 'Buku berhasil dihapus dari koleksi!';
    } else {
        echo 'Buku gagal dihapus dari koleksi!';
    }
}
/** END CRUD KOLEKSI PRIBADI */
?>