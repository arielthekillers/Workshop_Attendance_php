<?php
require_once('koneksi.php');
if ($_GET['s'] == 'n') {
    $querydetail = "SELECT * FROM `absensinarasumber` WHERE `id_absen` = $_GET[u]";
    $gambar = "./images/template_sertifikat_narasumber.jpg";
} else {
    $querydetail = "SELECT * FROM `absensipeserta` WHERE `id_absen` = $_GET[u]";
    $gambar = "./images/template_sertifikat_peserta.jpg";
}
$detail = $conn->query($querydetail);
$rowd = $detail->fetch_assoc();
$nama = $rowd['nama'];


$image = imagecreatefromjpeg($gambar);
$white = imageColorAllocate($image, 255, 255, 255);
$black = imageColorAllocate($image, 0, 0, 0);
$grey = imageColorAllocate($image, 46, 53, 64);
//$font = "Serif";
$font = dirname(__FILE__) . '/Quattrocento-Bold.ttf';
$size = 50;
//definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
$image_width = imagesx($image);
//membuat textbox agar text centered
$text_box = imagettfbbox($size, 0, $font, $nama);
$text_width = $text_box[2] - $text_box[0]; // lower right corner - lower left corner
$text_height = $text_box[3] - $text_box[1];
$x = ($image_width / 2) - ($text_width / 2);
//generate sertifikat beserta namanya
imagettftext($image, $size, 0, $x, 680, $grey, $font, $nama);
//tampilkan di browser
header("Content-type:  image/jpeg");
imagejpeg($image);
imagedestroy($image);
