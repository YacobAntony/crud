<?php 

session_start();

if ( !isset($_SESSION["login"] )){
	header ("location: login.php");
	exit;
}    

require 'koneksi.php';
//acumalaka
if (isset ($_POST ["submit"])) {

	if ( tambah($_POST) > 0){
		echo "<script>
		alert('user baru berhasil ditambahkan!!');
		document.location.href='index.php';
		</script>";

	}else{
		echo"<script>
		alert('gagal blok!!')
		</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ambasing</title>
</head>
<body>
	<h1>tambah data</h1>

	<form action="" method="post"  enctype="multipart/form-data" onSubmit="validasi()">
<ul>
	<li>
		<label for="nama_lengkap">nama lengkap : </label>
		<input type="text" name="nama_lengkap" id="nama_lengkap" required>
	</li>
	<li>
		<label for="tanggal_lahir">tanggal lahir : </label>
		<input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
	</li>
	<li>
		<label for="nis">nis : </label>
		<input type="text" name="nis" id="nis">
	</li>
	<br>
	<li>
                <label for="sukmadik">pilih jurusan:</label>
                <select name="nama_jurusan" id="nama_jurusan">
                <option selected>pilih jurusan</option>
                <?php
                $result=mysqli_query($koneksi,"SELECT * FROM tbl_jurusan");
				while($row=mysqli_fetch_array($result)) {
					?>
                    <option value="<?= $row['id']; ?>"><?= $row['nama_jurusan']; ?></option>
					<?php
				}
			        ?>
				</select>
            </li><br>
			<li>
                <label for="sukmadik">kelas:</label>
                <select name="kelas" id="kelas">
                <option selected>Pilih kelas</option>
                <?php
                $result=mysqli_query($koneksi,"SELECT * FROM tbl_kelas");
				while($row=mysqli_fetch_array($result)) {
					?>
                    <option value="<?= $row['id']; ?>"><?= $row['kelas']; ?></option>
					<?php
				}
			        ?>
				</select>
            </li><br>
    <li>
		<label for="img">gambar : </label>
		<input type="file" name="img" id="img">
	</li>
	<li>
		<button type="submit" name="submit">tambah</button>
	</li>
</ul>

	</form>
	<script type="text/javascript">
	function validasi() {
		var nama_lengkap = document.getElementById("nama_lengkap").value;
		var tanggal_lahir = document.getElementById("tanggal_lahir").value;
		var nis = document.getElementById("nis").value;
		var img = document.getElementById("img").value;
		if (nama_lengkap != "" && tanggal_lahir!="" && nis !="" && img !="") {
			return true;
		}else{
			alert('Anda harus mengisi data dengan lengkap !');
			return true;
		}
	}
</script>
</body>

</html>