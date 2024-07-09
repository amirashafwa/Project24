<h5 class="card-title fw-semibold mb-4">Data Peminjam</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User</li>
    </ol>
</nav>


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
                            <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Username</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Email</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Alamat</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM user");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['NamaLengkap'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Username'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Email'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $data['Alamat'];?></h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $data['UserID']; ?>"><i class="ti ti-trash"></i></button>                        
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


<!-- Modal Hapus -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM user");
while ($data = mysqli_fetch_array($query)) {
?>
<div class="modal fade" id="ModalHapus<?php echo $data['UserID']; ?>" tabindex="-1" aria-labelledby="ModalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalHapusLabel">Konfirmasi Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="aksi-crud.php">
                <input type="hidden" name="userID" value="<?php echo $data['UserID']; ?>">
                <div class="modal-body">
                    <h5 class="card-title fw-semibold mb-4">Apakah anda yakin menghapus data ini?</h5>
                    <p class="mb-0 text-danger">Username : <?php echo $data['Username'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-danger" name="userhapus">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>