<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
if (isset($_POST["submit"])) {

  //cek berhasil atau tidak
  if (tambah($_POST) > 0) {
    echo "
          <script>
            alert('data berhasil ditambah!');
            document.location.href = 'index.php';
          </script>
         ";
  } else {
    echo "
          <script>
            alert('data gagal ditambah!');
            document.location.href = 'index.php';
          </script>
         ";
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Tambah data mahasiswa</title>
</head>

<body>
  <h1>Tambah data mahasiswa</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <ul>
      <li>
        <label for="nim">NIM : </label>
        <input type="text" name="nim" id="nim" required>
      </li>
      <li>
        <label for="nama">Nama : </label>
        <input type="text" name="nama" id="nama" required>
      </li>
      <li>
        <label for="email">Email : </label>
        <input type="text" name="email" id="email" required>
      </li>
      <li>
        <label for="jurusan">Jurusan : </label>
        <input type="text" name="jurusan" id="jurusan" required>
      </li>
      <li>
        <label for="gambar">Gambar : </label>
        <input type="file" name="gambar" id="gambar">
      </li>

      <button type="submit" name="submit">Tambah data</button>

    </ul>
  </form>
</body>

</html>