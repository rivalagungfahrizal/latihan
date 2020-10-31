<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

//pagination
$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

//cek apakah ada halaman di url
if (isset($_GET["halaman"])) {
  $currentPage = $_GET["halaman"];
} else {
  $currentPage = 1;
}
$awalData = ($jumlahDataPerhalaman * $currentPage) - $jumlahDataPerhalaman;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerhalaman");

//tombol cari ditekan
if (isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}

//tombol reset ditekan
if (isset($_POST["reset"])) {
  $mahasiswa = $mahasiswa;
}
// tampilkan pesan jika sql error
// if (!$result) {
//   echo mysqli_error($conn);
// }

// ambil data dari objek $result
// mysqli_fetch_row() (mengembalikan array numerik)
// mysqli_fetch_assoc() (mengembalian array associative(nama field))
// mysqli_fetch_array() (gabungan dari 2 diatas(kelemahan makan memori yang besar))
// mysqli_fetch_object() 

// while ($mhs = mysqli_fetch_assoc($result)) {
//   var_dump($mhs);
// }

?>
<!DOCTYPE html>
<html>

<head>
  <title>Halaman Admin</title>
</head>

<body>

  <a href="logout.php">Logout</a>
  <h1>Daftar Mahasiswa</h1>

  <a href="tambah.php">Tambah data mahasiswa</a>
  <br><br>

  <!-- form cari data -->
  <form action="" method="POST">
    <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian" autocomplete="off">
    <button type="submit" name="cari">Cari</button>
    <button type="submit" name="reset">Reset</button>

  </form>
  <br><br>

  <!-- navigasi -->
  <?php if ($currentPage > 1) : ?>
    <a href="?halaman=<?= $currentPage - 1; ?>">&laquo;</a>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
    <?php if ($i == $currentPage) : ?>
      <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:red;"><?= $i; ?></a>
    <?php else : ?>
      <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>
  <?php endfor; ?>

  <?php if ($currentPage < $jumlahHalaman) : ?>
    <a href="?halaman=<?= $currentPage + 1; ?>">&raquo;</a>
  <?php endif; ?>

  <br>

  <!-- form data -->
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No.</th>
      <th>Aksi</th>
      <th>Gambar</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
    </tr>
    <?php $i = $awalData + 1; ?>
    <?php foreach ($mahasiswa as $row) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td>
          <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
          <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
        <td><img src="<?= $row["gambar"]; ?>" width="100"></td>
        <td><?= $row["nim"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
  </table>
</body>

</html>