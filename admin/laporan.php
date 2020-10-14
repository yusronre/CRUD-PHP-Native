<?php 
		include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="../style/index.css">
	<style>
		body{
    	background-repeat: no-repeat;
    	background-size: cover;
    	background:url(../style/fabric.jpg);
     	font-family: arial;
 		}
            .utama{
                margin:0 auto;
                border:thin solid #000;
                width:750px;
            }
            .print{
                margin:0 auto;
                width:700px;
            }
            a{
                text-decoration: none;
            }
        </style>
</head>
<body>
<div class="print">
            <a href="#" onclick="document.getElementById('print').style.display='none';window.print();"><img src="../style/print-icon.png" id="print" width="25" height="25" border="0" /></a>
        </div>
<div align="right">
		<a href="../login.php" style="color:black; margin-right:15px;"><u><b>Logout?</b></u></a>
	</div>
	<a href="index.php" style="color: black; margin-left: 15px;"><b>KEMBALI?</b></a>
	<center> 
		<h2>Laporan</h2>
		<br/><br/><br/>
		<form method="get">
			<label>PILIH TANGGAL</label>
			<input type="date" name="tanggal">
			<label>PILIH TANGGAL</label>
			<input type="date" name="tanggal2">
			<input type="submit" value="FILTER">
		</form>
		<br/> <br/>
		<table border="1">
			<tr>
				<th>No</th>
				<th>No Transaksi</th>
				<th>Kode Menu</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
				<th>Tgl.Transaksi</th>
				<th>Kode User</th>
				<th>No Meja</th>
			</tr>
			<?php 
			$no = 1;
 
			if(isset($_GET['tanggal'])){
				$tgl = $_GET['tanggal'];
				$tgl2 = $_GET['tanggal2'];
				$sql = mysqli_query($koneksi,"SELECT * from tb_transaksi where tgl_transaksi between '$tgl' and '$tgl2'");
			}else{
				$sql = mysqli_query($koneksi,"SELECT * from tb_transaksi");
			}
			
			while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['kd_transaksi']; ?></td>
				<td><?php echo $data['kd_menu']; ?></td>
				<td><?php echo $data['jumlah']; ?></td>
				<td><?php echo $data['subtotal']; ?></td>
				<td><?php echo $data['tgl_transaksi']; ?></td>
				<td><?php echo $data['kd_user']; ?></td>
				<td><?php echo $data['no_meja']; ?></td>
			</tr>
			<?php 
			}
			?>
		</table>
 
	</center>
</body>
</html>