<h5 class="card-title fw-semibold mb-4">Data Peminjaman</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Laporan Peminjaman</li>
    </ol>
</nav>
<a class="btn btn-success mb-3" href="cetak.php">
    <i class="ti ti-printer"></i>Cetak Laporan
</a>
<div class="card">
    <div class="card-body">   
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr class="text-center">
                        <th class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">User</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Buku</h6>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN user ON peminjaman.UserID = user.UserID LEFT JOIN buku ON peminjaman.BukuID = buku.BukuID");
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
                            <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPeminjaman'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPengembalian'];?></h6>                        
                        </td>
                        <td class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-1"><?php echo $data['StatusPeminjaman'];?></h6>
                            <span class="fw-normal <?php if ($data['Keterangan'] == 'Terlambat') echo 'text-danger'; elseif ($data['Keterangan'] == 'Tepat Waktu') echo 'text-primary'; ?>"><?php echo $data['Keterangan'];?></span>
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