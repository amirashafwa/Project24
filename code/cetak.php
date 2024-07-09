<h2 align="center">Laporan Peminjaman</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
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
                <h6 class="fw-semibold mb-0">Tanggal Peminjaman</h6>
            </th>
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Tanggal Pengembalian</h6>
            </th>
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Status Peminjaman</h6>
            </th>
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Keterangan</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../authentication/koneksi.php';
        $i = 1;
        $query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN user ON peminjaman.UserID = user.UserID LEFT JOIN buku ON peminjaman.BukuID = buku.BukuID");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td class="border-bottom-0"><h6 class="fw-semibold mb-0" align="center"><?php echo $i++; ?></h6></td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['NamaLengkap'];?></h6>                        
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['Judul'];?></h6>                        
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPeminjaman'];?></h6>                        
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['TanggalPengembalian'];?></h6>                        
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['StatusPeminjaman'];?></h6>                        
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1"><?php echo $data['Keterangan'];?></h6>                        
            </td>
        </tr>
        <?php
        }
        ?>                     
    </tbody>
</table>

<script>
    window.print();
    setTimeout(function() {
        window.close();
    }, 100);
</script>