<?php
session_start();
require_once('koneksi.php');
require_once('pustaka.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokakarya Kotaku 2021</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>

    <div class="flex justify-center bg-blue-400">
        <div class="bg-white rounded shadow p-8 m-4 shadow-2x1 lg:w-2/3 subpixel-antialiased">

            <?php
            $querydetail = "SELECT * FROM `event` WHERE `status` = 1 ";
            $detail = $conn->query($querydetail);
            $rowd = $detail->fetch_assoc();
            ?>
            <div class="flex flex-col sm:flex-row justify-between devide-y-2 border-l-4 border-blue-600 rounded-md shadow-md py-2">
                <h2 class="text-2xl font-bold sm:pl-6 pl-2 pt-1"><?php echo $rowd['judul']; ?></h2>
                <p class="bg-blue-600 p-2 mx-2 sm:my-0 my-2 rounded-lg text-blue-100"><?= tgl_indo($rowd['tanggal']); ?></p>
            </div>

            <div class="grid grid-rows-1 lg:grid-flow-col sm:grid-flow-row my-6 gap-4">
                <div>
                    <?php echo $rowd['detail']; ?>
                </div>
                <div>
                    <?php echo $rowd['detail2']; ?>
                </div>
                <div>
                    <?php echo $rowd['detail3']; ?>
                </div>
            </div>

            <div class="flex justify-center my-4">
                <a type="button" class="flex text-center bg-blue-500 hover:bg-blue-600 hover:text-white rounded-md py-2 px-4 text-blue-100 mx-2 shadow-md" href="<?= $rowd['meeting_link']; ?>" target="_blank">Link Zoom Meeting</a>
                <a type="button" class="flex text-center bg-red-600 hover:bg-red-700 hover:text-white rounded-md py-2 px-4 text-red-100 mx-2 shadow-md" href="<?= $rowd['live_link']; ?>" target="_blank">Link Live Streaming</a>
                <a type="button" class="flex text-center bg-green-600 hover:bg-green-700 hover:text-white rounded-md py-2 px-4 text-red-100 mx-2 shadow-md" href="<?= $rowd['notulensi_link']; ?>" target="_blank">Notulensi Online</a>
            </div>

            <div class="flex justify-between bg-gray-100 py-2 px-0 rounded-lg shadow-md mt-8 border-l-4 border-blue-600">
                <h3 class="text-lg pt-1 pl-6" id="absenNarasumber">Absensi Narasumber</h3>
                <a type="button" class="flex bg-blue-500 hover:bg-blue-400 rounded-md py-2 px-4 text-blue-100 mx-2 shadow-md" href="<?= $baseUrl; ?>/absensiNarasumber.php?event=<?php echo $rowd['id_event']; ?>">Isi Absensi</a>
            </div>


            <?php if (isset($_SESSION['status']) and $_SESSION['status'] == 'absenNarasumber') : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 my-3 rounded-full relative text-center" role="alert">
                    <strong class="font-bold">Absensi Berhasil Disimpan. </strong>
                    <span class="block sm:inline">Terima kasih atas partisipasi anda dalam kegiatan ini.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-3 py-2" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
                <?php unset($_SESSION['status']); ?>
            <?php endif; ?>


            <div class="px-2 mt-2">
                <ul class="my-1 divide-y">
                    <?php
                    $queryns = "SELECT * FROM `absensinarasumber` WHERE `id_event`= $rowd[id_event]  ORDER BY `timestamp` DESC";
                    $narasumber = $conn->query($queryns);
                    if ($narasumber->num_rows > 0) {
                        // output data of each row
                        while ($row = $narasumber->fetch_assoc()) { ?>
                            <li class="flex pb-2">
                                <div class="py-2">
                                    <?php $color = ($row['jenisKelamin'] == 'Perempuan') ? 'bg-pink-600' : 'bg-yellow-400'; ?>
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center text-white <?= $color; ?>"><?php echo getProfilePicture($row['nama']); ?></div>
                                </div>
                                <div class="w-full sm:ml-8 ml-3 mt-1">
                                    <div class="flex justify-between py-1">
                                        <div class="text-blue-600"><?php echo $row['nama']; ?></div>
                                        <div class="text-gray-600 text-xs"><?php echo $row['timestamp']; ?></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-sm italic text-gray-500"><?php echo $row['jabatan']; ?> <?php echo $row['instansi']; ?></div>
                                        <a type="button" class="<?= $color; ?> hover:bg-blue-400 rounded-md py-1 px-2 text-white text-xs" target="_blank" href="sertifikat.php?s=n&u=<?= $row['id_absen']; ?>">E-Sertifikat</a>
                                    </div>

                                </div>
                            </li>
                        <?php    }
                    } else { ?>
                        <div class="bg-gray-100 border text-gray-700 px-3 py-2 my-4 rounded-full relative text-center" role="alert">Belum ada data ditemukan</div>
                    <?php
                    }
                    ?>
                </ul>
            </div>


            <div class="flex justify-between bg-gray-100 py-2 px-0 rounded-lg shadow-md mt-2 border-l-4 border-blue-600">
                <h3 class="text-lg pt-1 pl-6" id="absenPeserta">Absensi Peserta</h3>
                <a type="button" class="flex bg-blue-500 hover:bg-blue-400 rounded-md py-2 px-4 text-blue-100 mx-2 shadow-md" href="<?= $baseUrl; ?>/absensiPeserta.php?event=<?php echo $rowd['id_event']; ?>">Isi Absensi</a>
            </div>
            <?php if (isset($_SESSION['status']) and $_SESSION['status'] == 'absenPeserta') : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 my-3 rounded-full relative text-center" role="alert">
                    <strong class="font-bold">Absensi Berhasil Disimpan. </strong>
                    <span class="block sm:inline">Terima kasih atas partisipasi anda dalam kegiatan ini.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-3 py-2" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
                <?php unset($_SESSION['status']); ?>
            <?php endif; ?>


            <div class="px-2 mt-2">
                <ul class="my-1 divide-y">
                    <?php
                    $queryps = "SELECT * FROM `absensipeserta`  WHERE `id_event`= $rowd[id_event] ORDER BY `timestamp` DESC";
                    $peserta = $conn->query($queryps);
                    if ($peserta->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $peserta->fetch_assoc()) { ?>
                            <li class="flex pb-2">
                                <div class="py-2">
                                    <?php $color = ($row2['jenisKelamin'] == 'Perempuan') ? 'bg-pink-600' : 'bg-yellow-400'; ?>
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center text-white <?= $color; ?>"><?php echo getProfilePicture($row2['nama']); ?></div>
                                </div>
                                <div class="w-full sm:ml-8 ml-3 mt-1">
                                    <div class="flex justify-between py-1">
                                        <div class="text-blue-600"><?php echo $row2['nama']; ?></div>
                                        <div class="text-gray-600 text-xs"><?php echo $row2['timestamp']; ?></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-sm italic text-gray-500"><?php echo $row2['jabatan']; ?> <?php echo $row2['instansi']; ?></div>
                                        <a type="button" class="<?= $color; ?> hover:bg-blue-400 rounded-md py-1 px-2 text-white text-xs" target="_blank" href="sertifikat.php?s=p&u=<?= $row2['id_absen']; ?>">E-Sertifikat</a>
                                    </div>

                                </div>
                            </li>
                        <?php    }
                    } else { ?>
                        <div class="bg-gray-100 border text-gray-700 px-3 py-2 my-4 rounded-full relative text-center" role="alert">Belum ada data ditemukan</div>
                    <?php }
                    ?>
                </ul>
            </div>



            </br>


        </div>
    </div>
</body>

</html>