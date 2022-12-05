<?php 

session_start();

if ( !isset($_SESSION["login"] )){
	header ("location: login.php");
	exit;
}    

require 'koneksi.php';

$id = $_GET ["id"];


$sw = query ("SELECT * FROM tbl_siswa WHERE id = $id")[0];

//acumalaka
if (isset ($_POST ["submit"])) {

	if ( ubah($_POST) > 0){
		echo"<script>
		alert('data berhasil diubah');
		document.location.href= 'index.php'; 
	   </script>";

	}else{
		"<script>
         alert('data berhasil dihapus'); 
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
	<h1>ubah data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value= "<?= $sw ["id"];?>">
		<input type="hidden" name="imglama" value= "<?= $sw ["img"];?>">
<ul>	

<li><img src="mbargambar/<?php echo $sw['img']?>" width="100" alt=""></li>

	<li>
		<label for="nama_lengkap">nama lengkap : </label>
		<input type="text" name="nama_lengkap" id="nama_lengkap" required value="<?= $sw ["nama_lengkap"];?>">
	</li>
	<li>
		<label for="tanggal_lahir">tanggal lahir : </label>
		<input type="date" name="tanggal_lahir" id="tanggal_lahir" required value="<?= $sw ["tanggal_lahir"];?>">
	</li>
	<li>
		<label for="nis">nis : </label>
		<input type="text" name="nis" id="nis" required value="<?= $sw ["nis"];?>">
	</li>
	<li>
        <label for="sukmadik">Jurusan:</label>
        <select name="nama_jurusan" id="nama_jurusan">
        <?php
        $result=mysqli_query($koneksi,"SELECT * FROM tbl_jurusan");
		while($row=mysqli_fetch_array($result)) {
        ?>
        <option value="<?= $row['id']; ?>" <?= $row['id'] == $sw['jurusan'] ? 'selected' : ''; ?>>
        <?= $row['nama_jurusan']; ?></option>
		<?php
		}
		?>
		</select>
    </li><br>
	<li>
                <label for="sukmadik">Kelas:</label>
                <select name="kelas" id="kelas">
                <?php
                $result=mysqli_query($koneksi,"SELECT * FROM tbl_kelas");
				while($row=mysqli_fetch_array($result)) {
                ?>
                <option value="<?= $row['id']; ?>" <?= $row['id'] == $sw['kelas'] ? 'selected' : ''; ?>>
                <?= $row['kelas']; ?></option>
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
		<button type="submit" name="submit">ubah data!</button>
	</li>
</ul>

	</form>

</body>
</html>

