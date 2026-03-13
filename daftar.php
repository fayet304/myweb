<?php 
	session_start();
	
	if (@$_SESSION['status'] == "login") {
			echo "<script>window.open('upload.php','_self')</script>"; 
				}
	else {
		include 'basisdata.php';
		$id = 2;
		$data2 	= mysqli_query($konekci,"select * from setting where id = '$id' ");
		$cek2 	= mysqli_num_rows($data2);
		$hasil2 	= mysqli_fetch_array($data2);
		if($cek2 > 0){
			$statusdaftar = $hasil2['sekolah'];
    		if( $statusdaftar == "tutup"){
    			//=========
    			echo "Pendaftaran Akun di tutup.";
    			header('Refresh: 5; URL=login.php');
    		}else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Absensi harian siswa">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="Absensi, Saloom">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Daftar</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">	
	
						<div class="text-center mt-4">
							<h1 class="h2">Pendaftaran</h1>
							<p class="lead">
								&nbsp;
								<?php 
									if(isset($_GET['pesan'])){
										if($_GET['pesan'] == "ada"){
											echo 'Username atau email sudah pernah di daftarkan. Silahkan daftar dengan username atau email yang berbeda';
										}else if($_GET['pesan'] == "password"){
											echo 'Password tidak sama. Password atas dan bawah harus sama';
										}
										else if($_GET['pesan'] == "gagal"){
											echo 'Buat akun baru gagal. Silahkan ulangi. Jangan menggunakan simbol petik 1 atau simbol lainnya';
										}
										else if($_GET['pesan'] == "logo"){
											echo 'Buat akun baru gagal. LINK logo tidak sesuai dengan video tutorial';
										}
										else if($_GET['pesan'] == "email"){
											echo 'Buat akun baru gagal. Email tidak valid';
										}
										else if($_GET['pesan'] == "berhasil"){
											echo 'Buat akun baru berhasil.<br/> Silahkan login';
										}
									}
								?>


							</p>
						</div>
						
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="daftar_cek.php" method="post" enctype="multipart/form-data" >
										
										<div class="mb-3">
											<label class="form-label">Nama lengkap</label>
											<input type="text" name="nama"  required class="form-control form-control-lg"/>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="email" name="email"  required class="form-control form-control-lg"/>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input type="password" name="password1"  required class="form-control form-control-lg">
										</div>
										
										<div class="mb-3">
											<label class="form-label">Ketik kembali password</label>
											<input type="password" name="password2"  required class="form-control form-control-lg">
										</div>
										
										<div class="text-center mb-3">
											<input type="submit" class="btn btn-primary btn-ms mt-4"  value="Daftar" />
										</div>
									</form>
									<p align="center">Sudah punya Akun? Silahkan login <b><a  href="login.php">di sini</a></b></p>
								</div>
							</div>
						</div>										
					</div>
				</div>
			</div>
		</div>
	</main>
	
</body>
</html>
<?php 
			}
		}else {
			echo "Databse tidak tersedia.";
			header('Refresh: 5; URL=login.php');
		}
     }
?>