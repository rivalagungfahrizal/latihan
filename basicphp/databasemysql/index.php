<?php
require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

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
  <h1>Daftar Mahasiswa</h1>

  <a href="tambah.php">Tambah data mahasiswa</a>
  <br><br>

  <!-- form cari data -->
  <form action="" method="POST">
    <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian" autocomplete="off">
    <button type="submit" name="cari">Cari</button>
    <button type="submit" name="reset">Reset</button>

  </form>
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
    <?php $i = 1; ?>
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