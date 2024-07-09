<h5 class="card-title fw-semibold mb-4">Koleksi Pribadi</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Collection</li>
    </ol>
</nav>
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
                $userID = $_SESSION['user']['UserID'];
                $query = mysqli_query($koneksi, "SELECT koleksipribadi.*, buku.*, kategoribuku.NamaKategori 
                    FROM koleksipribadi 
                    LEFT JOIN buku ON koleksipribadi.BukuID = buku.BukuID
                    LEFT JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID 
                    LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID
                    WHERE koleksipribadi.UserID = $userID");
                
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
                                // Fetch user's bookmarks
                                $userID = $_SESSION['user']['UserID'];
                                $userBookmarks = [];
                                $queryBookmarks = mysqli_query($koneksi, "SELECT BukuID FROM koleksipribadi WHERE UserID = $userID");
                                while ($row = mysqli_fetch_assoc($queryBookmarks)) {
                                    $userBookmarks[] = $row['BukuID'];
                                }
                            ?>
                            <i class="bookmark-icon fa-regular fa-bookmark <?php echo (in_array($data['BukuID'], $userBookmarks) ? 'fa-solid' : ''); ?>" data-buku-id="<?php echo $data['BukuID']; ?>" data-user-id="<?php echo $userID; ?>"></i>
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


<script>
$(document).ready(function() {
    // Handle click event on bookmark icon
    $('.bookmark-icon').click(function() {
        var bukuID = $(this).data('buku-id');
        var userID = $(this).data('user-id');
        var isBookmarked = $(this).hasClass('fa-solid');

        removeFromFavorites(bukuID, userID);
    });

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
                location.href='index.php?page=koleksi';
                // Change bookmark icon color to white
                $('.bookmark-icon[data-buku-id="' + bukuID + '"]').addClass('fa-regular').removeClass('fa-solid');
            }
        });
    }
});
</script>