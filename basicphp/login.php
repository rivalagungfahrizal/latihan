<?php
//cek tombol submit ditekan
if (isset($_POST["submit"])) {
  //cek username & password
  if ($_POST["username"] == "admin" && $_POST["password"] == "123") {
    //jika benar
    header("Location: admin.php");
    exit;
  } else {
    //jika salah
    $error = true;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
</head>

<body>

  <h1>Sign in</h1>

  <?php if (isset($error)) : ?>
    <p style="color: red; font-style:italic;">username / password salah!!!</p>
  <?php endif; ?>

  <ul>
    <form action="" method="post">
      <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username">
      </li>
      <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
      </li>
      <li>
        <button type="submit" name="submit">Login</button>
      </li>
    </form>
  </ul>

</body>

</html>