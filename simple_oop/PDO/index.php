<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Book</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h2>Tambah Buku Baru</h2>
<form action="index.php" method="POST" class="form-group row">
Kode Buku: <input type="text" name="kode" class="form-control"><br>
Judul Buku: <input type="text" name="judul" class="form-control"><br>
Pengarang Buku: <input type="text" name="pengarang" class="form-control"><br>
Penerbit Buku: <input type="text" name="penerbit" class="form-control"><br>
<input type="submit" name="addBook" value="Add Book" class="btn btn-success"><input type="reset" value="Reset" class="btn btn-warning">
</form>
</div>
</body>
</html>
<?php
require('Library.php');
if(isset($_POST['addBook'])){
$kode = $_POST['kode'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
 
$Lib = new Library();
$add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
if($add == "Success"){
header('Location: List.php');
}
}
 
?>