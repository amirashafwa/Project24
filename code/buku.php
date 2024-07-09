<h5 class="card-title fw-semibold mb-4">Data Buku</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Buku</li>
    </ol>
</nav>
<?php
if (isset($_SESSION['user']['Level'])) {
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambah">
    <i class="ti ti-plus"></i>Tambah Data
</button>
<?php
}
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr class="text-center">
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Kategori</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Judul</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Penulis</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Penerbit</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Tahun Terbit</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Stok Buku</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $query = mysqli_query($koneksi, "SELECT buku.*, kategoribuku.NamaKategori 
                    FROM buku 
                    LEFT JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID 
                    LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID");

                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['NamaKategori'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Judul'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Penulis'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Penerbit'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['TahunTerbit'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['StokBuku'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <?php
                            if (isset($_SESSION['user']['UserID'])) {
                                // Fetch user's bookmarks
                                $userID = $_SESSION['user']['UserID'];
                                $userBookmarks = [];
                                $queryBookmarks = mysqli_query($koneksi, "SELECT BukuID FROM koleksipribadi WHERE UserID = $userID");
                                while ($row = mysqli_fetch_assoc($queryBookmarks)) {
                                    $userBookmarks[] = $row['BukuID'];
                                }
                                ?>
                                <i class="bookmark-icon fa-regular fa-bookmark <?php echo (in_array($data['BukuID'], $userBookmarks) ? 'fa-solid' : ''); ?>" data-buku-id="<?php echo $data['BukuID']; ?>" data-user-id="<?php echo $userID; ?>"></i>
                            <?php
                            }
                            if (isset($_SESSION['user']['Level'])) {
                            ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?php echo $data['BukuID']; ?>"><i class="ti ti-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $data['BukuID']; ?>"><i class="ti ti-trash"></i></button>
                            <?php
                            }
                            ?>                  
                        </td>
                    </tr>
                    <?php
                    }
                    ?>                     
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="ModalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalTambahLabel">Tambah data buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" name="kategori" id="judul">
                            <?php
                            $k = mysqli_query($koneksi, "SELECT*FROM kategoribuku");
                            while ($kat = mysqli_fetch_array($k)) {
                                ?>
                            <option value="<?php echo $kat['KategoriID']; ?>"><?php echo $kat['NamaKategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input autocomplete="off" type="text" class="form-control" id="judul" placeholder="Masukkan Judul Buku" name="judul">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input autocomplete="off" type="text" class="form-control" id="penulis" placeholder="Masukkan Nama Penulis" name="penulis">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input autocomplete="off" type="text" class="form-control" id="penerbit" placeholder="Masukkan Nama Penerbit" name="penerbit">
                    </div>
                    <div class="mb-3">
                        <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                        <input autocomplete="off" type="number" class="form-control" id="tahunterbit" placeholder="Masukkan Tahun Terbit" name="tahunterbit">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input autocomplete="off" type="number" class="form-control" id="stok" placeholder="Masukkan Stok Buku" name="stok">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="bukusimpan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Modal Ubah -->
<?php
$query = mysqli_query($koneksi, "SELECT*FROM buku");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalUbah<?php echo $data['BukuID']; ?>" tabindex="-1" aria-labelledby="ModalUbahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUbahLabel">Ubah data buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="bukuID" value="<?php echo $data['BukuID']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" name="kategori" id="kategori">
                        <?php
                        $categories_query = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID LEFT JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID WHERE buku.BukuID = {$data['BukuID']}");
                        while ($category = mysqli_fetch_array($categories_query)) {
                            $selected = ($category['KategoriID'] == $data['KategoriID']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $category['KategoriID']; ?>" <?php echo $selected; ?>><?php echo $category['NamaKategori']; ?></option>
                        <?php
                        }

                        // Fetch and display all other categories not related to the current book
                        $all_categories_query = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE KategoriID NOT IN (SELECT KategoriID FROM kategoribuku_relasi WHERE BukuID = {$data['BukuID']})");
                        while ($other_category = mysqli_fetch_array($all_categories_query)) {
                            ?>
                            <option value="<?php echo $other_category['KategoriID']; ?>"><?php echo $other_category['NamaKategori']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input autocomplete="off" type="text" class="form-control" id="judul" placeholder="Masukkan Judul Buku" name="judul" value="<?php echo $data['Judul']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input autocomplete="off" type="text" class="form-control" id="penulis" placeholder="Masukkan Nama Penulis" name="penulis" value="<?php echo $data['Penulis']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input autocomplete="off" type="text" class="form-control" id="penerbit" placeholder="Masukkan Nama Penerbit" name="penerbit" value="<?php echo $data['Penerbit']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                        <input autocomplete="off" type="number" class="form-control" id="tahunterbit" placeholder="Masukkan Tahun Terbit" name="tahunterbit" value="<?php echo $data['TahunTerbit']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Buku</label>
                        <input autocomplete="off" type="number" class="form-control" id="stok" placeholder="Masukkan Stok Buku" name="stok" value="<?php echo $data['StokBuku']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="bukuubah">Update Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>


<!-- Modal Hapus -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM buku");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalHapus<?php echo $data['BukuID']; ?>" tabindex="-1" aria-labelledby="ModalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalHapusLabel">Konfirmasi hapus data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="bukuID" value="<?php echo $data['BukuID']; ?>">
                <div class="modal-body">
                    <h5 class="card-title fw-semibold mb-4">Apakah anda yakin menghapus data ini?</h5>
                    <p class="mb-0 text-danger"><?php echo $data['Judul'];?> - <?php echo $data['Penulis'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-danger" name="bukuhapus">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>



<!-- JavaScript to handle the bookmarking -->
<script>
$(document).ready(function() {
    // Handle click event on bookmark icon
    $('.bookmark-icon').click(function() {
        var bukuID = $(this).data('buku-id');
        var userID = $(this).data('user-id');
        var isBookmarked = $(this).hasClass('fa-solid');

        if (isBookmarked) {
            removeFromFavorites(bukuID, userID);
        } else {
            addToFavorites(bukuID, userID);
        }
    });

    function addToFavorites(bukuID, userID) {
        $.ajax({
            url: 'aksi-crud.php',
            type: 'POST',
            data: {
                bukuID: bukuID,
                userID: userID,
                action: 'add'
            },
            success: function(response) {
                alert('Bookmark added successfully!');
                // Change bookmark icon color to red
                $('.bookmark-icon[data-buku-id="' + bukuID + '"]').addClass('fa-solid');
            }
        });
    }

    function removeFromFavorites(bukuID, userID) {
        $.ajax({
            url: 'aksi-crud.php',
            type: 'POST',
            data: {
                bukuID: bukuID,
                userID: userID,
                action: 'remove'
            },
            success: function(response) {
                alert('Bookmark removed successfully!');
                // Change bookmark icon color to white
                $('.bookmark-icon[data-buku-id="' + bukuID + '"]').addClass('fa-regular').removeClass('fa-solid');
            }
        });
    }
});
</script>