<?php


//generate avatar
function getProfilePicture($name)
{
    $name_slice = explode(' ', $name);
    $name_slice = array_filter($name_slice);
    $initials = '';
    $initials .= (isset($name_slice[0][0])) ? strtoupper($name_slice[0][0]) : '';
    $initials .= (isset($name_slice[count($name_slice) - 1][0])) ? strtoupper($name_slice[count($name_slice) - 1][0]) : '';
    return $initials;
}
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
