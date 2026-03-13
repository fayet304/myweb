<?php 
	session_start();

    if (@$_SESSION['status'] != "login") {
    		echo "<script>window.open('login.php','_self')</script>"; 
                }
    else if (@$_SESSION['status'] == "login"){
    		$nama_pengguna = $_SESSION['nama_user'];
    		

	include 'basisdata.php';
	

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			// Nama Tabe 
            $sqlInsert = "INSERT into data_siswa (nis, nama, kelas)
                   values ('".$column[0]. "','".mysqli_real_escape_string($konekci,$column[1])."','".$column[2]."')";
            $result = mysqli_query($konekci, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "Berhasil";
                header("location:siswa.php");
                //echo "5";
            } else {
                $type = "error";
                $message = "Gagal";
                header("location:siswa.php");
                //echo "6";
            }
        }
    }
    mysqli_close($konekci);  
	    
	
}
?>