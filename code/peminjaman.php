<h5 class="card-title fw-semibold mb-4">Data Peminjaman</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
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
                    <tr class="text-center">
                        <th class="border-bottom-0" width="100">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Judul</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Jumlah Pinjam</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Tanggal Peminjaman</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Tanggal Pengembalian</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status Peminjaman</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    $where = " WHERE peminjaman.UserID =" . $_SESSION['user']['UserID'];
                    $query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN user ON peminjaman.UserID = user.UserID LEFT JOIN buku ON peminjaman.BukuID = buku.BukuID $where");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['NamaLengkap'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Judul'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['JumlahPinjam'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPeminjaman'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPengembalian'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['StatusPeminjaman'];?></h6>
                            <span class="fw-normal <?php if ($data['Keterangan'] == 'Terlambat') echo 'text-danger'; elseif ($data['Keterangan'] == 'Tepat Waktu') echo 'text-primary'; ?>"><?php echo $data['Keterangan'];?></span>
                        </td>
                        <td class="border-bottom-0">
                            <?php
                            if ($data['StatusPeminjaman'] != 'Dikembalikan') {
                            ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?php echo $data['PeminjamanID']; ?>"><i class="ti ti-edit"></i></button>
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
                <h1 class="modal-title fs-5" id="ModalTambahLabel">Tambah data peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="user" value="<?php echo $_SESSION['user']['UserID']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
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
                        <label for="jmlPinjam" class="form-label">Jumlah Pinjam</label>
                        <input autocomplete="off" type="number" class="form-control" id="jmlPinjam" name="jmlPinjam">
                    </div>
                    <div class="mb-3">
                        <label for="tglPeminjaman" class="form-label">Tanggal Peminjaman</label>
                        <input autocomplete="off" type="date" class="form-control" id="tglPeminjaman" name="tglPeminjaman">
                    </div>
                    <script>
                        $('#tglPeminjaman').attr('min', new Date().toISOString().split('T')[0]);
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="peminjamansimpan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalUbah<?php echo $data['PeminjamanID']; ?>" tabindex="-1" aria-labelledby="ModalUbahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUbahLabel">Ubah data kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="user" value="<?php echo $_SESSION['user']['UserID']; ?>">
                <input type="hidden" name="peminjamanID" value="<?php echo $data['PeminjamanID']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <select class="form-select" aria-label="Default select example" name="judul" id="judul">
                            <?php
                            $bukuID = $data['BukuID'];
                            $b = mysqli_query($koneksi, "SELECT*FROM buku WHERE buku.BukuID = $bukuID");
                            while ($buku = mysqli_fetch_array($b)) {
                                ?>
                            <option value="<?php echo $buku['BukuID']; ?>" <?php if($data['BukuID'] == $buku['BukuID']) echo 'selected';?>><?php echo $buku['Judul']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jmlPinjam" class="form-label">Jumlah Pinjam</label>
                        <input type="number" class="form-control" id="jmlPinjam" name="jmlPinjam" value="<?php echo $data['JumlahPinjam'];?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tglPeminjaman" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="tglPeminjaman" name="tglPeminjaman" value="<?php echo $data['TanggalPeminjaman'];?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tglPengembalian" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tglPengembalian" name="tglPengembalian" value="<?php echo $data['TanggalPengembalian'];?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="statusPeminjaman" class="form-label">Status Peminjaman</label>
                        <select class="form-select" aria-label="Default select example" name="statusPeminjaman" id="statusPeminjaman">
                            <option value="Dipinjam" <?php if($data['StatusPeminjaman'] == 'Dipinjam') echo 'selected';?>>Dipinjam</option>
                            <option value="Dikembalikan" <?php if($data['StatusPeminjaman'] == 'Dikembalikan') echo 'selected';?>>Dikembalikan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="peminjamanubah">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>