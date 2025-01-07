<?php
session_start();
//create CSRF Token
$token = md5(uniqid(rand(), TRUE));
//assign token to session
$_SESSION['csrf_token'] = $token;
?>
<?php require_once('koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Narasumber</title>
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
    <div class="flex h-screen">
        <div class="w-full max-w-md justify-center m-auto shadow-md rounded-lg bg-gradient-to-r from-yellow-400 via-pink-600 to-blue-600">
            <form class=" shadow-md rounded-lg px-8 pt-6 pb-8 mb-2 mt-2 bg-gradient-to-tr from-gray-300 via-gray-100 to-white" action="kirimAbsen.php" method="POST">
                <div class="flex justify-between">
                    <h1 class="text-lg font-bold mb-4 mt-2">Absensi Narasumber</h1>
                    <div class="flex text-2xl rounded-full items-center justify-center ">
                        <a href="<?= $baseUrl; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23a1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2z" />
                            </svg>
                        </a>
                    </div>

                </div>
                <div class="mb-3">
                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                    <input type="hidden" name="id_event" value="<?php echo $_GET['event']; ?>">
                    <input type="hidden" name="jenis" value="absenNarasumber">
                    <label class="block text-gray-700 text-sm mb-2" for="nama_lengkap">
                        Nama Lengkap
                    </label>
                    <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_lengkap" type="text" name="nama_lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="jeniskelamin">
                        Jenis Kelamin
                    </label>
                    <select name="jeniskelamin" id="jeniskelamin" class="w-full py-2 rounded-lg px-2 bg-white shadow appearance-none border text-gray-700" required>
                        <option value="" class="text-gray-400 hover:text-gray-400">- Pilih -</option>
                        <option value="Laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="instansi">
                        Instansi / Dinas / Organisasi
                    </label>
                    <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="instansi" type="text" name="instansi" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="jabatan">
                        Jabatan / Posisi
                    </label>
                    <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jabatan" type="text" name="jabatan" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm mb-2" for="nomorhandphone">
                        Nomor Handphone <span class="text-gray-400">(Nomor Aktif dan bukan Pascabayar )</span>
                    </label>
                    <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomorhandphone" type="text" name="nomorhandphone" required>
                </div>
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm mb-2" for="nomorrekening">
                        Nomor Rekening / Nama Bank
                    </label>
                    <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomorrekening" type="text" name="nomorrekening" placeholder="Contoh: 121-532-821-723 / Bank BCA" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline w-full" type="submit">
                        Kirim Presensi
                    </button>
                </div>
            </form>
        </div>
    </div>





</body>

</html>