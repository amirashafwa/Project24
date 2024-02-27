<h5 class="card-title fw-semibold mb-4">Data Buku</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Buku</li>
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
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0" width="200">
                            <h6 class="fw-semibold mb-0">No</h6>
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
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM buku");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Judul'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Penulis'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Penerbit'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['TahunTerbit'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?php echo $data['BukuID']; ?>"><i class="ti ti-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $data['BukuID']; ?>"><i class="ti ti-trash"></i></button>                        
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
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul Buku" name="judul">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" placeholder="Masukkan Nama Penulis" name="penulis">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" placeholder="Masukkan Nama Penerbit" name="penerbit">
                    </div>
                    <div class="mb-3">
                        <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                        <input type="text" class="form-control" id="tahunterbit" placeholder="Masukkan Tahun Terbit" name="tahunterbit">
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
$query = mysqli_query($koneksi, "SELECT * FROM buku");
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
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul Buku" name="judul" value="<?php echo $data['Judul']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" placeholder="Masukkan Nama Penulis" name="penulis" value="<?php echo $data['Penulis']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" placeholder="Masukkan Nama Penerbit" name="penerbit" value="<?php echo $data['Penerbit']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                        <input type="text" class="form-control" id="tahunterbit" placeholder="Masukkan Tahun Terbit" name="tahunterbit" value="<?php echo $data['TahunTerbit']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="bukuubah">Save</button>
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