<!DOCTYPE html>
<html>
<head>
	<title>LOGIN Form</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>

		<form action="cek_login.php" method="post">
			<table align="center">
				<tr id="header">
					<td colspan="2"><h2>Login disini</h2></td>
				</tr>
				<tr>
			<td>Username</td>
			<td><input type="text" name="username" placeholder="Username .." required=></td>
 				</tr>
 				<tr>
			<td>Password</td>
			<td><input type="password" name="password" placeholder="Password .." required></td>
 				</tr>
 				<tr>
 					<td></td>
			<td><input type="submit" name="submit" value="LOGIN">
			<input type="reset" name="reset" value="RESET"></td>
 				</tr>
		</table>
	</form>
</body>
</html>