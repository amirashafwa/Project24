<?php
include '../authentication/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek_petugas = mysqli_query($koneksi, "SELECT*FROM petugas WHERE Username = '$username' AND Password = '$password'");
    if (mysqli_num_rows($cek_petugas) > 0) {
        $_SESSION['user'] = mysqli_fetch_array($cek_petugas);
        echo '<script>alert("Login Berhasil, Selamat Datang!"); location.href="../code/index.php"</script>';
    } else {
        $cek_peminjam = mysqli_query($koneksi, "SELECT*FROM user WHERE Username = '$username' AND Password = '$password'");

        if (mysqli_num_rows($cek_peminjam) > 0) {
        $_SESSION['user'] = mysqli_fetch_array($cek_peminjam);
        echo '<script>alert("Login Berhasil, Selamat Datang!"); location.href="../code/index.php"</script>';
        } else {
        echo '<script>alert("Maaf, Username/Password salah")</script>';
        }
    }
}
if (isset($_POST['register'])) {
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $alamat = $_POST['alamat'];

    $user_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username' OR Email='$email'"));
    $petugas_check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM petugas WHERE Username='$username'"));

    if ($petugas_check > 0 || $user_check > 0) {
        echo '<script>alert("Username/Email sudah digunakan");</script>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat) VALUES ('$username', '$password', '$email', '$namalengkap','$alamat')");
        if ($query) {
            echo '<script>alert("Register Berhasil, Selamat Datang!"); location.href="../code/index.php"</script>';
        } else {
            echo '<script>alert("Register Gagal!");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpustakaan Digital</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>
<body>
    <section class="wrapper">
        <div class="form signup">
            <header>Register</header>
            <form method="post">
                <input type="text" placeholder="Nama Lengkap" name="namalengkap" required/>
                <input type="text" placeholder="Username" name="username" required/>
                <input type="email" placeholder="Email" name="email" required/>
                <input type="password" placeholder="Password" name="password" required/>
                <textarea name="alamat" rows="3" placeholder="Alamat" required></textarea>
                <button type="submit" name="register">Submit</button>
            </form>
        </div>
        <div class="form login">
            <header>Login</header>
            <form method="post">
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <button type="submit" name="login">Submit</button>
            </form>
        </div>

        <script>
            const wrapper = document.querySelector(".wrapper"),
                signupHeader = document.querySelector(".signup header"),
                loginHeader = document.querySelector(".login header");

            loginHeader.addEventListener("click", () => {
                wrapper.classList.add("active");
            });
            signupHeader.addEventListener("click", () => {
                wrapper.classList.remove("active");
            });
        </script>
    </section>
</body>
</html>