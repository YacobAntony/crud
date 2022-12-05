<!-- //IKI FUNGSI -->

<?php
// konfigurasi database
$host       =   "localhost";
$user       =   "root";
$password   =   "";
$database   =   "phpdasar";
// perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

function query ($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows [] = $row;
    }
    return $rows;

}

function tambah ($data){
    //ambil
    global $koneksi;

	$nama_lengkap = htmlspecialchars( $data["nama_lengkap"]);
	$tanggal_lahir = htmlspecialchars ($data["tanggal_lahir"]);
	$nis = htmlspecialchars ($data["nis"]);
    $nama_jurusan = htmlspecialchars ($data["nama_jurusan"]);
    $kelas = htmlspecialchars ($data["kelas"]);
    $img = upload();
      if (!$img) {return false;}

	$query = "INSERT INTO tbl_siswa (nama_lengkap, tanggal_lahir, nis, jurusan, kelas, img)
    VALUES
    ('$nama_lengkap', '$tanggal_lahir', '$nis', '$nama_jurusan', '$kelas', '$img')
    ";
mysqli_query($koneksi, $query);
return mysqli_affected_rows($koneksi);
}

function upload(){

    $namafile = $_FILES ['img']['name'];
    $ukuranfile =  $_FILES ['img']['size'];
    $error =  $_FILES ['img']['error'];
    $tmpname = $_FILES ['img']['tmp_name'];
//error g
if ($error === 4 ) {
    echo "<script>
    alert('gambar belum dipilih'); 
   </script>";
return false;}


//cek
$ekstensigambarvalid = ['jpg', 'png', 'jpeg'];
$ekstensigambar = explode ('.', $namafile);
$ekstensigambar = strtolower (end($ekstensigambar));
if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
echo "<script>
alert('kegedean !!!'); 
</script>";
return false;}


//kegedean
if ($ukuranfile > 1000000){
    echo "<script>
    alert('data berhasil dihapus'); 
   </script>";
    return false;
}


//lolos di cek
$namafilebaru = uniqid();
$namafilebaru .='.';
$namafilebaru .= $ekstensigambar;

move_uploaded_file($tmpname, 'mbargambar/' . $namafilebaru);
return $namafilebaru;


}

function hapus ($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE From tbl_siswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}


function ubah($data){
global $koneksi;

$id = $data ["id"];
$nama_lengkap = htmlspecialchars( $data["nama_lengkap"]);
$tanggal_lahir = htmlspecialchars ($data["tanggal_lahir"]);
$nis = htmlspecialchars ($data["nis"]);
$nama_jurusan = htmlspecialchars ($data["nama_jurusan"]);
$kelas = htmlspecialchars ($data["kelas"]);
$imglama = htmlspecialchars ($data["imglama"]);

//ingfomin
if ($_FILES['img']['error'] === 4){
    $img = $imglama;
}else{
    $img = upload();
}




$query = "UPDATE tbl_siswa 
SET nama_lengkap='$nama_lengkap', tanggal_lahir='$tanggal_lahir', nis='$nis', jurusan='$nama_jurusan', kelas='$kelas', img='$img'


WHERE id = $id";


mysqli_query($koneksi, $query);
return mysqli_affected_rows($koneksi);

}



function cari($keyword){
   $query = "SELECT * FROM tbl_siswa where 
   
   nama_lengkap LIKE '%$keyword%' or
   user_id LIKE '%$keyword%'
   ";

   return query ($query);
}

function registrasi($data){
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

//cek dupe
$result = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username='$username'");
if (mysqli_fetch_assoc($result)){
    
    echo "<script>
    alert('username yang dipilih sudah terdaftar!!')
    </script>";

    return false;
}


//cek
if( $password !== $password2 ){
    echo "<script>
    alert ('sandi konfirmasi tidak sesuai');
    </script>";

    return false;
}
  //enkripsi
   $password = password_hash($password, PASSWORD_DEFAULT);
  
  //tambahkan userbaru
    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);

}

?>
