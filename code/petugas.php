<h5 class="card-title fw-semibold mb-4">Data Petugas</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Petugas</li>
    </ol>
</nav>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambah">
    <i class="ti ti-plus"></i>Tambah Data
</button>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4 text-center">
                    <tr>
                        <th class="border-bottom-0" width="100">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Username</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Level</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM petugas");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Nama'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Username'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <span class="badge <?php if ($data['Level'] == 'Administrator') echo 'bg-danger'; elseif ($data['Level'] == 'Petugas') echo 'bg-success'; ?> rounded-3 fw-semibold text-center"><?php echo $data['Level'];?></span>
                        </td>
                        <td class="border-bottom-0">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?php echo $data['PetugasID']; ?>"><i class="ti ti-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $data['PetugasID']; ?>"><i class="ti ti-trash"></i></button>                        
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
                <h1 class="modal-title fs-5" id="ModalTambahLabel">Tambah data petugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" aria-label="Default select example" name="level" id="level" required>
                            <option selected>Open this select menu</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="petugassimpan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM petugas");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalUbah<?php echo $data['PetugasID']; ?>" tabindex="-1" aria-labelledby="ModalUbahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUbahLabel">Ubah data petugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="petugasID" value="<?php echo $data['PetugasID'];?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?php echo $data['Nama'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" value="<?php echo $data['Username'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
                        <small>*Jika tidak ingin diubah, kosongkan saja</small>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" aria-label="Default select example" name="level" id="level" required>
                            <option <?php if($data['Level'] == "") echo'selected'; ?>>Open this select menu</option>
                            <option value="Administrator" <?php if($data['Level'] == "Administrator") echo'selected'; ?>>Administrator</option>
                            <option value="Petugas" <?php if($data['Level'] == "Petugas") echo'selected'; ?>>Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="petugasubah">Save</button>
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
$query = mysqli_query($koneksi, "SELECT * FROM petugas");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalHapus<?php echo $data['PetugasID']; ?>" tabindex="-1" aria-labelledby="ModalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalHapusLabel">Konfirmasi Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="petugasID" value="<?php echo $data['PetugasID']; ?>">
                <div class="modal-body">
                    <h5 class="card-title fw-semibold mb-4">Apakah anda yakin menghapus data ini?</h5>
                    <p class="mb-0 text-danger">Username : <?php echo $data['Username'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-danger" name="petugashapus">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>