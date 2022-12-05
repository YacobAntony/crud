<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- BOOTSTRAP 4-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- BOOTSTRAP 4-->
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <?php
    session_start();

    if ( !isset($_SESSION["login"] )){
        header ("location: login.php");
        exit;
    }    

    require 'koneksi.php';

    //pagination
    $jumlahdataperhalaman = 3;
    $jumlahdata = count(query("SELECT * FROM tbl_siswa"));
    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    $halamanaktif = (isset($_GET["halaman"])) ? $_GET ["halaman"] : 1;


    $awaldata = ( $jumlahdataperhalaman * $halamanaktif  ) - $jumlahdataperhalaman;

    //hal 2
    


    //hal 3



    //tampilkan data
    $siswa = query ("SELECT sis.id, sis.nama_lengkap, sis.tanggal_lahir, sis.nis, jurus.nama_jurusan, clas.kelas, sis.img
    FROM tbl_siswa AS sis
       LEFT JOIN
       tbl_jurusan AS jurus
       ON jurus.id = sis.jurusan 
       LEFT JOIN 
       tbl_kelas AS clas
       ON clas.id = sis.kelas
        LIMIT $awaldata, $jumlahdataperhalaman");

    if (isset ($_POST["cari"])) {
        $siswa = cari($_POST["keyword"]);

    }

    ?>

</head>
<body>
<table class="table table-hover table-bordered" id="mytable" style="margin-top: 10px">

<a href="logout.php">logout</a>
    <h1>Daftar Siswa</h1>
 <a href="tambah.php">tambah</a>
 <br></br>
 
 <form action="" method="post">
<input type="text" name="keyword" size="40" autofocus placeholder="masukkan data pencarian" autocomplete="off">
<button type="submit" name="cari">cari </button>
 </form>

 <br>
    
    <tr>
    <th>id</th>
    <th>aksi </th>
    <th>nama lengkap</th>
    <th>tanggal lahir</th>
    <th>nis</th>
    <th>jurusan</th>
    <th>kelas</th>
    <th>img</th>
    </tr>
 <?php $i = $awaldata +1; ?>
    <?php foreach ($siswa as $row) :?>
<tr>
 <td><?= $i; ?></td>
<td> 
         <a href="ubah.php?id=<?php echo $row['id'];?>">edit |</a> 
         <a href="hapus.php?id=<?php echo $row['id'];?>" onclick="return confirm ('yakin?');">hapus |</a>
         <a href="detail-data.php?id=<?php echo $row['id'];?>">detail</a>
</td>
    <td><?php echo $row['nama_lengkap']?></td>
    <td><?php echo $row['tanggal_lahir']?></td>
    <td><?php echo $row['nis']?></td>
    <td><?php echo $row['nama_jurusan']?></td>
    <td><?php echo $row['kelas']?></td>
    <td><img src="mbargambar/<?php echo $row['img']?>" width="50" alt=""></td>
</tr>
<?php $i++;?>
<?php endforeach; ?>
 
    </table>
<!-- navigasi -->
<?php if ( $halamanaktif > 1 ) :?>
<a href="?halaman<?= $halamanaktif -1 ?>">&lt;</a>
<?php endif;?>


<?php for($i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
   <?php if ( $i == $halamanaktif) :?>

       <a href="?halaman=<?= $i; ?>"style="font-weight: bold; color : red;" ><?= $i;?></a>
    <?php else :?>
        <a href="?halaman=<?= $i; ?>" ><?= $i;?></a>
    <?php endif;?>
    <?php endfor;?>

    <?php if ( $halamanaktif < $jumlahhalaman ) :?>
<a href="?halaman=<?= $halamanaktif + 1; ?>">&gt;</a>
<?php endif;?>


</body>
</html>