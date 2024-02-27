<div class="container-fluid pt-4 px-4">
  <h5 class="card-title fw-semibold mb-4">Data Petugas</h5>
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
  </nav>
  <div class="row g-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded d-flex align-items-center justify-content-between p-4">
        <div class="row align-items-start">
          <div class="col-9">
            <div class="ms-3">
                <p class="mb-2">Total Kategori</p>
                <h6 class="mb-0">
                  <?php
                  echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM kategoribuku"));
                  ?>
                </h6>
            </div>
          </div>
          <div class="col-3">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-category fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded d-flex align-items-center justify-content-between p-4">
        <div class="row align-items-start">
          <div class="col-8">
            <div class="ms-3">
                <p class="mb-2">Total Buku</p>
                <h6 class="mb-0">
                <?php
                  echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM buku"));
                  ?>
                </h6>
            </div>
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-books fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded d-flex align-items-center justify-content-between p-4">
        <div class="row align-items-start">
          <div class="col-8">
            <div class="ms-3">
                <p class="mb-2">Total Ulasan</p>
                <h6 class="mb-0">
                <?php
                  echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM ulasanbuku"));
                  ?>
                </h6>
            </div>
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-stars fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded d-flex align-items-center justify-content-between p-4">
        <div class="row align-items-start">
          <div class="col-8">
            <div class="ms-3">
                <p class="mb-2">Total User</p>
                <h6 class="mb-0">
                <?php
                  echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM user"));
                  ?>
                </h6>
            </div>
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <tbody>
                    <?php
                    if (isset($_SESSION['user']['Level'])) {
                      ?>
                      <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1" width="200">Nama</h6>                        
                        </td>
                        <td class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-1">:</h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $_SESSION['user']['Nama']; ?></h6>                        
                        </td>
                    </tr>                     
                    <tr>
                        <td class="border-bottom-0" width="200">
                            <h6 class="fw-semibold mb-1">Level User</h6>                        
                        </td>
                        <td class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-1">:</h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $_SESSION['user']['Level']; ?></h6>                        
                        </td>
                    </tr> 
                    <?php
                    } else {
                      ?>
                    <tr>
                        <td class="border-bottom-0" width="200">
                            <h6 class="fw-semibold mb-1">Nama Lengkap</h6>                        
                        </td>
                        <td class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-1">:</h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo $_SESSION['user']['NamaLengkap']; ?></h6>                        
                        </td>
                    </tr> 
                    <tr>
                        <td class="border-bottom-0" width="200">
                            <h6 class="fw-semibold mb-1">Level User</h6>                        
                        </td>
                        <td class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-1">:</h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Peminjam</h6>                        
                        </td>
                    </tr> 
                    <?php
                    }
                    ?>                    
                    <tr>
                        <td class="border-bottom-0" width="200">
                            <h6 class="fw-semibold mb-1">Tanggal Login</h6>                        
                        </td>
                        <td class="border-bottom-0" width="1">
                            <h6 class="fw-semibold mb-1">:</h6>                        
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?php echo date('d-m-Y');?></h6>                        
                        </td>
                    </tr>                     
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>