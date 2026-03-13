<?php  
    session_start();
    
	if (@$_SESSION['status'] != "login") {
		echo "<script>window.open('login.php','_self')</script>"; 
    }
	else if (@$_SESSION['status'] == "login"){
		$nama_pengguna = $_SESSION['nama_user'];
		//$lepel_pengguna = $_SESSION['lepelnya_user'] ;
		
		include 'basisdata.php';
		
		$delete_id=mysqli_real_escape_string($konekci,$_GET['l']);  
		$kelas=mysqli_real_escape_string($konekci,$_GET['k']);  	
				
                $delete_query="delete  from data_siswa WHERE id='$delete_id'";
                $run=mysqli_query($konekci,$delete_query);
                if($run){
?>
					<script>window.open('siswa.php?k=<?php echo $kelas; ?>','_self')</script>
					
<?php           } else {
					echo "<script>window.open('siswa.php','_self')</script>";
				}		
				mysqli_close($konekci);
	}
?>  
