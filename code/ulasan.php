<h5 class="card-title fw-semibold mb-4">Data Ulasan</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ulasan</li>
    </ol>
</nav>
<?php
if (!isset($_SESSION['user']['Level'])) {
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
                    <tr>
                        <th class="border-bottom-0" width="100">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">User</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Buku</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Ulasan</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Rating</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM ulasanbuku LEFT JOIN buku ON ulasanbuku.BukuID = buku.BukuID LEFT JOIN user ON ulasanbuku.UserID = user.UserID");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['NamaLengkap'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Judul'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Ulasan'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Rating'];?>/5</h6>                        
                        </td>
                        <td class="border-bottom-0">
                        <?php
                        if (!isset($_SESSION['user']['Level'])) {
                        ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?php echo $data['UlasanID']; ?>"><i class="ti ti-edit"></i></button>
                        <?php
                        }
                        ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $data['UlasanID']; ?>"><i class="ti ti-trash"></i></button>                        
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
                <h1 class="modal-title fs-5" id="ModalTambahLabel">Tambah data ulasan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="user" value="<?php echo $_SESSION['user']['UserID']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Buku</label>
                        <select class="form-select" aria-label="Default select example" name="judul" id="judul" required>
                            <option selected>Open this select menu</option>
                            <?php
                            $b = mysqli_query($koneksi, "SELECT*FROM buku");
                            while ($buku = mysqli_fetch_array($b)) {
                                ?>
                            <option value="<?php echo $buku['BukuID']; ?>"><?php echo $buku['Judul']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ulasan" class="form-label">Ulasan</label>
                        <textarea name="ulasan" id="ulasan" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" aria-label="Default select example" name="rating" id="rating" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ulasansimpan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM ulasanbuku");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalUbah<?php echo $data['UlasanID']; ?>" tabindex="-1" aria-labelledby="ModalUbahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUbahLabel">Ubah data ulasan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="user" value="<?php echo $_SESSION['user']['UserID']; ?>">
                <input type="hidden" name="ulasanID" value="<?php echo $data['UlasanID']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Buku</label>
                        <select class="form-select" aria-label="Default select example" name="judul" id="judul" required>
                            <option <?php if($data['BukuID'] == "") echo 'selected'; ?>>Open this select menu</option>
                            <?php
                            $b = mysqli_query($koneksi, "SELECT*FROM buku");
                            while ($buku = mysqli_fetch_array($b)) {
                                ?>
                            <option value="<?php echo $buku['BukuID']; ?>" <?php if($data['BukuID'] == $buku['BukuID']) echo 'selected'; ?>><?php echo $buku['Judul']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ulasan" class="form-label">Ulasan</label>
                        <textarea name="ulasan" id="ulasan" rows="3" class="form-control"><?php echo $data['Ulasan']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" aria-label="Default select example" name="rating" id="rating" required>
                            <option <?php if($data['Rating'] == "") echo 'selected'?>>Open this select menu</option>
                            <?php
                            for ($i=1; $i <= 5 ; $i++) { 
                            ?>
                                <option <?php if($data['Rating'] == $i) echo 'selected'?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ulasanubah">Save</button>
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
$query = mysqli_query($koneksi, "SELECT * FROM ulasanbuku LEFT JOIN buku ON ulasanbuku.BukuID = buku.BukuID");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalHapus<?php echo $data['UlasanID']; ?>" tabindex="-1" aria-labelledby="ModalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalHapusLabel">Konfirmasi Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="ulasanID" value="<?php echo $data['UlasanID']; ?>">
                <div class="modal-body">
                    <h5 class="card-title fw-semibold mb-4">Apakah anda yakin menghapus data ini?</h5>
                    <p class="mb-0 text-danger"><?php echo $data['Judul'];?> - <?php echo $data['Ulasan'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-danger" name="ulasanhapus">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>