<?php 

session_start();

if ( !isset($_SESSION["login"] )){
	header ("location: login.php");
	exit;
}    

require 'koneksi.php';

$id = $_GET ["id"];


$sw = query ("SELECT ts.*,tk.kelas,tj.nama_jurusan 
FROM tbl_siswa ts 
left join tbl_kelas tk on ts.kelas = tk.id 
left join tbl_jurusan tj on ts.jurusan = tj.id
WHERE ts.id = $id")[0];
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
	<h1>DEtail Data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value= "<?= $sw ["id"];?>">
		<input type="hidden" name="imglama" value= "<?= $sw ["img"];?>">
<ul>	

    <li><img src="mbargambar/<?php echo $sw['img']?>" width="100" alt=""></li>

	<li>
		<label for="nama_lengkap">nama lengkap : </label>
		<input type="text" name="nama_lengkap" id="nama_lengkap" readonly required value="<?= $sw ["nama_lengkap"];?>">
	</li>
	<li>
		<label for="tanggal_lahir">tanggal lahir : </label>
		<input type="text" name="tanggal_lahir" id="tanggal_lahir" readonly required value="<?= $sw ["tanggal_lahir"];?>">
	</li>
	<li>
		<label for="nis">nis : </label>
		<input type="text" name="nis" id="nis" readonly required value="<?= $sw ["nis"];?>">
	</li>
	<!-- <li>
        <label for="sukmadik">Jurusan:</label>
        <select name="nama_jurusan" id="nama_jurusan">
        <?php
        $result=mysqli_query($koneksi,"SELECT * FROM tbl_jurusan");
		while($row=mysqli_fetch_array($result)) {
        ?>
        <option readonly value="<?= $row['id']; ?>" <?= $row['id'] == $sw['jurusan'] ? 'selected' : ''; ?>>
        <?= $row['nama_jurusan']; ?></option>
		<?php
		}
		?>
		</select>
    </li><br> -->
	<!-- <li>
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
			    ?> -->
				</select>
	<li>
		<label for="kelas">kelas : </label>
		<input type="text" name="kelas" id="kelas" readonly required value="<?= $sw ["kelas"];?>">
	</li>

	<li>
		<label for="jurusan">jurusan : </label>
		<input type="text" name="jurusan" id="jurusan" readonly required value="<?= $sw ["nama_jurusan"];?>">
	</li>
</ul>

	</form>

</body>
</html>