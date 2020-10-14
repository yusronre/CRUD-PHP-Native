<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>RESTO</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>

    <body>
        <?php
        if (isset($_POST['admin'])) {
            echo "<script>document.location.href='login.php'</script>";
        }
        if (isset($_POST['kasir'])) {
            echo "<script>document.location.href='kasir/transaksi.php'</script>";
        }
        ?>
        <form method="post">
            <table align="center">
                <tr>
                    <td colspan="2" align="center"><h3>Login Sebagai :</h3></td>
                </tr>
                <tr>
                    <td><input type="submit" name="admin" value="Administrator"></td>
                    <td><input type="submit" name="kasir" value="Kasir"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
