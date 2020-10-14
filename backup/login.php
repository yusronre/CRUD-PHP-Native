<?php
	include "config/koneksi.php";
    if(isset($_POST['login'])){
	$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username = '$_POST[username]' and password = '$_POST[password]'");
	$cek = mysqli_num_rows($sql);
	if($cek > 0){
		echo "<script>alert('Anda Menekan Tombol Login')</script>";
		echo "<script>alert('Selamat datang $_POST[username]');document.location.href='index.php'</script>";
	}else{
		echo "<script>alert('Anda Menekan Tombol Login')</script>";
		echo "<script>alert('Login gatot');document.location.href='login.php'</script>";
	}
}
?>
<!DOCTYPE<html>
<html>
<head>
 <title>form login</title>
 <link href="style/style.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
 <form method="post" name="form1">
  <table>
<tr id="header">
    <td colspan="2"><h2>Login Disini</h2>
</td>
   </tr>
<tr>
    <td>Username</td>
    <td><input type="text" name="username" id="username" placeholder="username" required></td>
   </tr>
<tr>
    <td>Password</td>
    <td><input type="password" name="password" id="password" placeholder="password" required></td>
   </tr>
<tr>
    <td></td>
    <td><input type="submit" name="login" value="Login">
     <input type="reset" name="reset" value="Reset"></td>
   </tr>
</table>
</form>
</body>
</html>
