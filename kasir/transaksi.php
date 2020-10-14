<?php
	include "../config/koneksi.php";
	$tanggal = date("Y/m/d h:i:s");
	
	if(isset($_POST['bayar'])){
		@$t = $_POST['total'];
		@$b = $_POST['jumlahbayar'];
		@$k = $b-$t;
		$sql = mysqli_query($koneksi, "TRUNCATE TABLE tb_pesan");
	}	

	if(isset($_POST['pesan'])){
		@$menu = $_POST['menu'];
		$r= mysqli_query($koneksi, "SELECT * FROM tb_menu WHERE menu='$menu'");
		$tampil = mysqli_fetch_array($r);
		@$sub=$_POST['subtotal'];
		$sql = mysqli_query($koneksi, "INSERT INTO tb_transaksi VALUES('$_POST[no_transaksi]','$_POST[kd_menu]','$_POST[jumlah]','$sub','$tanggal','1','$_POST[no_meja]')");
		if($sql){
			echo "<script>alert('Berhasil memesan');document.location.href='transaksi.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		}
	}

	if(isset($_POST['pesan'])){
		$sql = mysqli_query($koneksi, "INSERT INTO tb_pesan VALUES('$_POST[no_transaksi]','$_POST[kd_menu]','$_POST[jumlah]','$sub','$tanggal','1','$_POST[no_meja]')");
		if($sql){
			echo "<script>alert('Berhasil memesan');document.location.href='transaksi.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		}
	}

	if(isset($_GET['hapus'])){
		$sql = mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE kd_transaksi = '$_GET[kd]'");
		if($sql){
			echo "<script>alert('Delete data Sukses');document.location.href = 'transaksi.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
  			exit();
		}
	}
	if(isset($_GET['hapus'])){
		$sql = mysqli_query($koneksi, "DELETE FROM tb_pesan WHERE kd_transaksi = '$_GET[kd]'");
		if($sql){
			echo "<script>alert('Delete data Sukses');document.location.href = 'transaksi.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
  			exit();
		}
	}
	$makanan=mysqli_query($koneksi, "SELECT * FROM tb_menu");
	$jsArray = "var harga_menu = new Array();\n"; 


?>
	<script type="text/javascript">
		function hit(){
			var b1 = parseFloat(document.getElementById('harga').value);
			var b2 = parseFloat(document.getElementById('jumlah').value);
			var b3 = b1 * b2;
			document.getElementById("subtotal").value = b3;
			document.getElementById("totall").value = b3;
		}
	</script>
	<script type="text/javascript">
		function tarif(){
			var rp = document.getElementById("barang").value;
			document.getElementById("harga").value = rp;
		}
	</script>



<!DOCTYPE html>
<html>
<head>
	<title>Form Transaksi</title>
	<link rel="stylesheet" href="../style/index.css">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body style="margin:0;font-family:arial;">
	<div class="nav">
    <ul>
<li><a href="index.php">Home</a></li>
<li><a href="transaksi.php">Transaksi</a></li>
</ul>
</div>
<div align="right">
		<a href="../login.php" style="color:black; margin-right:15px;"><u><b>Logout?</b></u></a>
	</div>
	<a href="index.php" style="color: black; margin-left: 15px;"><b>KEMBALI?</b></a>
	<form method="post">
		<div style="font-size:16px;">
			<table>
				<tr>
					<td>Kode Transaksi</td>
					<td>:</td>
					<td><input type="text" name="no_transaksi"></td>
				</tr>
				<tr>
					<td>Menu</td>
					<td>:</td>
					<td><select name="kd_menu" onchange="changeValue(this.value)" >
		            <option disabled selected>- Pilih -</option>
		            <?php if(mysqli_num_rows($makanan)) {?>
		                <?php while($row_menu= mysqli_fetch_array($makanan)) {?>
		                    <option value="<?php echo $row_menu["kd_menu"]?>"> <?php echo $row_menu["menu"]?> </option>
		                <?php $jsArray .= "harga_menu['" . $row_menu['kd_menu'] . "'] = {harga:'" . addslashes($row_menu['harga']) . "'};\n"; } ?>
		            <?php } ?>
		        </select></td>
				</tr>
				<tr>
					<td>Harga</td>
					<td>:</td>
					<td><input type="text" name="harga" readonly id="harga" onchange="return hit();" ></td>
				</tr>

				<tr>
					<td>Jumlah</td>
					<td>:</td>
					<td><input type="text" name="jumlah" id="jumlah" onchange ="return hit();" ></td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>:</td>
					<td><input type="text" name="subtotal" readonly id="subtotal"></td>
									</tr>
				<tr>
					<td>No Meja</td>
					<td>:</td>
					<td><select name="no_meja"">
						<option Disabled selected>-Pilih-</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
					</select></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="pesan" value="Pesan"></td>
				</tr>
			</table>
		</div>
		<div>
			<input placeholder="Search" type="search" name="tcari"  value="<?= @$_POST['tcari']; ?>">
            <input type="submit" name="cari" value="Cari">
            <br>
            <br>
			<table border="1"  cellpadding="11" cellspacing="0" >
			<tr>
				<th>Kode Transaksi</th>
				<th>Menu</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
				<th>Tanggal Transaksi</th>
				<th>Kode User</th>
				<th>Nomor Meja</th>
				<th><center>Action</center></th>
			</tr>
			<?php
				$sql = mysqli_query($koneksi,"SELECT * FROM tb_pesan");
				if(isset($_POST['cari'])){
                    $sql = mysqli_query($koneksi,"SELECT * FROM tb_pesan WHERE kd_transaksi LIKE '%$_POST[tcari]%'");
                }else{
                	$sql = mysqli_query($koneksi,"SELECT * FROM tb_pesan");
                }
				while($data = mysqli_fetch_array($sql)) {
			?>
			<tr>
				<td><?php echo $data[0]; ?></td>
				<td><?php echo $data[1]; ?></td>
				<td><?php echo $data[2]; ?></td>
				<td><?php echo $data[3]; ?></td>
				<td><?php echo $data[4]; ?></td>
				<td><?php echo $data[5]; ?></td>
				<td><?php echo $data[6]; ?></td>
				<td><a onclick="return confirm('Yakin ingin menghapus data?')" href="transaksi.php?hapus&kd=<?php echo $data[0]; ?>"><u>Delete</a></td>
			</tr>
			<?php } ?>
			</table>
			<br>
			<br>
			<table>
				<tr>
					<td>Total</td>
					<td>&nbsp;&nbsp;&nbsp;:</td>
					<?php $l = mysqli_query($koneksi, "SELECT SUM(tb_pesan.subtotal) FROM tb_pesan"); 
					$tampil = mysqli_fetch_array($l)
					?>
					<td><input type="text" name="total" readonly value="<?php echo $tampil[0]; ?>"></td>
				</tr>
				<tr>
					<td>Bayar</td>
					<td>&nbsp;&nbsp;&nbsp;:</td>
					<td><input type="text" name="jumlahbayar"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="bayar" value="BAYAR"></td>
				</tr>
			</table>
			<br>
			<table>	
				<tr>
					<td>Kembali</td>
					<td>:</td>
					<td><input type="text" name="kembali" disabled value="<?php echo @$k  ?>"></td>
				</tr>
			</table>
		</div>
		</div>
	</form>
	<script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(kd_menu) {
      document.getElementById("harga").value = harga_menu[kd_menu].harga;
    };
    </script>
</body>
</html>