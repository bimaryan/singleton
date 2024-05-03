<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .music-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container p-3 mx-auto">
        <div class="w-full mb-2 mx-auto rounded overflow-hidden shadow-lg bg-white">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Informasi Mahasiswa</div>
                <p class="text-gray-700 text-base">
                <p>Nama: Bima Ryan Alfarizi</p>
                <p>Kelas: D4RPL2B</p>
                <p>Prodi: Rekayasa Perangkat Lunak</p>
                <p>Matkul: Desain Perangkat Lunak</p>
                </p>
            </div>
        </div>
        <?php
        require_once 'Database.php';
        require_once 'Mahasiswa.php';

        $mahasiswa = new Mahasiswa();

        if (isset($_POST['create'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $jurusan = $_POST['jurusan'];
            $mahasiswa->createMahasiswa($nim, $nama, $alamat, $jurusan);
        }

        if (isset($_POST['update'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $jurusan = $_POST['jurusan'];
            $mahasiswa->updateMahasiswa($nim, $nama, $alamat, $jurusan);
        }

        if (isset($_POST['read'])) {
            $nim = $_POST['nim'];
            $mahasiswa->readMahasiswa($nim);
        }

        if (isset($_POST['delete'])) {
            $nim = $_POST['nim'];
            $mahasiswa->deleteMahasiswa($nim);
        }
        ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="w-full mx-auto rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Deskripsi Tugas</div>
                    <p class="text-gray-700 text-base">
                        ✨Tugas ini dijadikan sebagai pengganti presensi hari sebelumnya yang kosong
                        <br>
                        Buatlah kode program pada Bahasa pemrograman PHP untuk melakukan konktivitas database dengan ketentuan sebagai berikut:
                        <br>
                        - Satu mahasiswa, satu database (tidak boleh sama)
                        <br>
                        - Satu database, minimal ada 1 table (tidak boleh sama)
                        <br>
                        - Satu table, minimal ada 4 fields
                        <br>
                        - Lakukanlah transaksi database (bebas CRUD apa saja) lebih dari satu kali, kemudian buktikan bahwa setiap transaksi tersebut hanya menggunakan satu objek (Menerapkan creational design pattern - Singleton)
                    </p>
                </div>
            </div>
            <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-xl">
                <h1 class="text-3xl mb-6">CRUD Mahasiswa</h1>
                <form method="post">
                    <div class="mb-4">
                        <label for="nim" class="block text-gray-700">NIM:</label>
                        <input type="text" id="nim" name="nim" class="w-full rounded border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700">Nama:</label>
                        <input type="text" id="nama" name="nama" class="w-full rounded border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700">Alamat:</label>
                        <input type="text" id="alamat" name="alamat" class="w-full rounded border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <label for="jurusan" class="block text-gray-700">Jurusan:</label>
                        <input type="text" id="jurusan" name="jurusan" class="w-full rounded border-gray-300" required>
                    </div>
                    <div class="mb-4">
                        <input type="submit" name="create" value="Tambah" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <input type="submit" name="update" value="Perbarui" class="cursor-pointer bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <input type="submit" name="read" value="Baca" class="cursor-pointer bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        <input type="submit" name="delete" value="Hapus" class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-xl overflow-x-auto">
            <h1 class="font-bold text-xl mb-2">Data Mahasiswa</h1>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">NIM</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db = Database::getInstance()->getConnection();
                    $result = $db->query("SELECT * FROM mahasiswa");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<td class='px-4 py-2'>" . $row["nim"] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row["nama"] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row["alamat"] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row["jurusan"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Data mahasiswa tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button class="music-button rounded-full bg-blue-600 py-3 px-4 shadow-lg" onclick="toggleMusic()"><i class="bi bi-music-note-beamed"></i></button>

        <audio id="bgMusic" loop>
            <source src="RIP PHONK.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <script>
        let isMusicPlaying = false;

        function toggleMusic() {
            const music = document.getElementById("bgMusic");
            if (isMusicPlaying) {
                music.pause();
            } else {
                music.play();
            }
            isMusicPlaying = !isMusicPlaying;
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>