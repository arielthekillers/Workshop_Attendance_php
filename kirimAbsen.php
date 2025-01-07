<?php
session_start();
require_once('koneksi.php');
if (isset($_POST) & !empty($_POST)) {

    if (isset($_POST['csrf_token'])) {

        if ($_SESSION['csrf_token'] === $_POST['csrf_token']) {


            $nama_lengkap = $_POST['nama_lengkap'];
            $jeniskelamin = $_POST['jeniskelamin'];
            $instansi = $_POST['instansi'];
            $jabatan = $_POST['jabatan'];
            $nomorhandphone = $_POST['nomorhandphone'];
            $id_event = $_POST['id_event'];
            $jenis = $_POST['jenis'];

            if ($jenis == 'absenPeserta') {
                $sql = "INSERT INTO `absensipeserta` (`nama`, `jenisKelamin`, `instansi`, `jabatan`, `nomorHp`, `id_event`) VALUES ('$nama_lengkap', '$jeniskelamin', '$instansi', '$jabatan', '$nomorhandphone', '$id_event')";
            } else {
                $nomorrekening = $_POST['nomorrekening'];
                $sql = "INSERT INTO `absensinarasumber` (`nama`, `jenisKelamin`, `instansi`, `jabatan`, `nomorHp`, `nomorRekening`, `id_event`) VALUES ('$nama_lengkap', '$jeniskelamin', '$instansi', '$jabatan', '$nomorrekening', '$nomorhandphone', '$id_event')";
            }

            if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] = $jenis;
                $_SESSION['msg  '] = 'Absensi anda telah tersimpan. Terima Kasih atas partisipasi anda dalam kegiatan ini';
                header("Location: " . $baseUrl . "/index.php?event=" . $id_event . "#" . $jenis);
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            $csrferrors[] = "CSRF Token Validation Failed";
        }
    } else {
        $csrferrors[] = "CSRF Token Verification Failed";
    }

    if (!isset($csrferrors)) {
    } else {
        $errors = $csrferrors;
    }
}
