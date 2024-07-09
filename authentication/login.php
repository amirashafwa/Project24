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
        $query = mysqli_query($koneksi, "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')");
        if ($query) {
            echo '<script>alert("Register Berhasil, Silahkan Login!");</script>';
        } else {
            echo '<script>alert("Register Gagal!");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Perpustakaan Digital</title>
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input autocomplete="off" type="text" placeholder="Nama Lengkap" name="namalengkap" required/>
                    <input autocomplete="off" type="text" placeholder="Username" name="username" required/>
                    <input autocomplete="off" type="email" placeholder="Email" name="email" required/>
                    <input autocomplete="off" type="password" placeholder="Password" name="password" required/>
                    <textarea name="alamat" placeholder="Alamat"></textarea>
                    <button type="submit" name="register">Submit</button>
				</form>
			</div>

			<div class="login">
				<form method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input autocomplete="off" type="text" name="username" placeholder="Username" required="">
					<input autocomplete="off" type="password" name="password" placeholder="Password" required="">
					<button type="submit" name="login">Login</button>
				</form>
			</div>
	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>