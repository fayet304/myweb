<?php 
    session_start();
    include 'basisdata.php';
    

    
    $nama 	= mysqli_real_escape_string($konekci, $_POST['nama']);

    $email 		= mysqli_real_escape_string($konekci, $_POST['email']);
    	$email = str_replace(' ', '', $email);
    	$email = str_replace('/', '', $email);
    	$email = str_replace(':', '', $email);
    	$email = str_replace('?', '', $email);
    
    function checkemail($str) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
    
    if(!checkemail($email)){
      //echo "Email tidak valid.........";
      header("location:daftar.php?pesan=email");
   }
   else{

        $password1 	= mysqli_real_escape_string($konekci, $_POST['password1']);
        $password2 	= mysqli_real_escape_string($konekci, $_POST['password2']);
            
            
            $data = mysqli_query($konekci,"select * from absensi_user where email='$email' ");
            
            $cek = mysqli_num_rows($data);
            
            	if ($email  == ""){
            		header("location:daftar.php");
            	}else {
            		if($cek > 0){
            			header("location:daftar.php?pesan=ada");
            		}else{
            			if ($password1 != $password2) {
            				header("location:daftar.php?pesan=password");
            			} else {
            				$in = mysqli_query($konekci,"INSERT INTO absensi_user VALUES(NULL, '$nama', '$email', '$password1', 'Aktif')");
            				if($in){
            					header("location:daftar.php?pesan=berhasil");
            				}else{
            					header("location:daftar.php?pesan=gagal");
            				}
            			}
            		}
            	}
        
   }
?>