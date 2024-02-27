<?php
if (isset($_POST['profileubah'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (isset($_SESSION['user']['Level'])) {
        $petugasID = $_SESSION['user']['PetugasID'];
    } else {
        $userID = $_SESSION['user']['UserID'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
    }

    $user_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username'"));
    $petugas_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM petugas WHERE Username='$username'"));

    if ($petugas_check > 0 || $user_check > 0) {
        echo '<script>alert("Username sudah digunakan"); location.href="?page=profile"</script>';
    } else {
        if (isset($_SESSION['user']['Level'])) {
            $query = mysqli_query($koneksi, "UPDATE petugas SET Nama='$nama', Username='$username' WHERE PetugasID = $petugasID");
        } else {
            $query = mysqli_query($koneksi, "UPDATE user SET Username='$username', Email='$email', NamaLengkap='$nama', Alamat='$alamat' WHERE UserID = $userID");
        }

        if ($_POST['password'] != "") {
            if (isset($_SESSION['user']['Level'])) {
                $query = mysqli_query($koneksi, "UPDATE petugas SET Password='$password' WHERE PetugasID = $petugasID");
            } else {
                $query = mysqli_query($koneksi, "UPDATE user SET Password='$password' WHERE UserID = $userID");
            }
        }
        if ($query) {
            echo "<script>alert('Ubah data berhasil!'); location.href='?page=profile';</script>";
        } else {
            echo "<script>alert('Ubah data gagal!'); location.href='?page=profile';</script>";
        }
    }
}
?>

<h5 class="card-title fw-semibold mb-4">My Profile</h5>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
    </ol>
</nav>

<div class="content-wrapper">
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img
                        src="../assets/images/profile/user-1.jpg"
                        alt="user-avatar"
                        class="d-block rounded"
                        height="100"
                        width="100"
                        id="uploadedAvatar"
                    />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            accept="image/png, image/jpeg"
                        />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG or PNG.</p>
                    </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <?php
                        if (isset($_SESSION['user']['Level'])) {
                        ?>
                        <input class="form-control" type="text" id="nama" name="nama" value="<?php echo $_SESSION['user']['Nama']?>" autofocus/>
                        <?php
                        } else {
                        ?>
                        <input class="form-control" type="text" id="nama" name="nama" value="<?php echo $_SESSION['user']['NamaLengkap']?>" autofocus/>
                        <?php
                        }
                        ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $_SESSION['user']['Username']?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password"/>
                        </div>
                        <?php
                        if (!isset($_SESSION['user']['Level'])) {
                        ?>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="<?php echo $_SESSION['user']['Email']?>" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="5"><?php echo $_SESSION['user']['Alamat']?></textarea>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2" name="profileubah">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                    </form>
                </div>
            <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                    </div>
                    <?php
                    // Check if form is submitted
                    if (isset($_POST['deleteAccount'])) {
                        // Ensure the user is logged in and has a valid user ID (You may adjust this based on your authentication logic)
                        if (isset($_SESSION['user']['PetugasID'])) {
                            $petugasID = $_SESSION['user']['PetugasID'];

                            // Delete user account from the database
                            $query = mysqli_query($koneksi, "DELETE FROM petugas WHERE PetugasID=$petugasID");

                            if ($query) {
                                // Account deleted successfully
                                session_start();
                                session_destroy();
                                echo "<script>alert('Account deletion successful!'); location.href='../authentication/login.php';</script>";
                                exit();
                            } else {
                                // Account deletion failed
                                echo "<script>alert('Account deletion failed!'); location.href='index.php';</script>";
                                exit();
                            }
                        } else {
                            // Redirect to login page if the user is not logged in
                            $userID = $_SESSION['user']['UserID'];

                            // Delete user account from the database
                            $query = mysqli_query($koneksi, "DELETE FROM user WHERE UserID=$userID");

                            if ($query) {
                                // Account deleted successfully
                                session_start();
                                session_destroy();
                                echo "<script>alert('Account deletion successful!'); location.href='../authentication/login.php';</script>";
                                exit();
                            } else {
                                // Account deletion failed
                                echo "<script>alert('Account deletion failed!'); location.href='index.php';</script>";
                                exit();
                            }
                        }
                    }
                    ?>

                    <!-- Your HTML Form -->
                    <form id="formAccountDeletion" method="post">
                        <button type="submit" class="btn btn-danger" name="deleteAccount">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->