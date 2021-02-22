<?php
class Library{
public function __construct(){
$this->db = new PDO('mysql:host=localhost;dbname=library','root','mysql');
}
public function addBook($kode, $judul, $pengarang, $penerbit){
$sql = "INSERT INTO books (kodeBuku, judulBuku, pengarang, penerbit) VALUES('$kode', '$judul', '$pengarang', '$penerbit')";
$query = $this->db->query($sql);
if(!$query){
return "Failed";
}
else{
return "Success";
}
}
public function editBook($kode){
$sql = "SELECT * FROM books WHERE kodeBuku='$kode'";
$query = $this->db->query($sql);
return $query;
}
public function updateBook($kode, $judul, $pengarang, $penerbit){
$sql = "UPDATE books SET judulBuku='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE kodeBuku='$kode'";
$query = $this->db->query($sql);
if(!$query){
return "Failed";
}
else{
return "Success";
}
}
 
public function showBooks(){
$sql = "SELECT * FROM books";
$query = $this->db->query($sql);
return $query;
}
public function deleteBook($kode){
$sql = "DELETE FROM books WHERE kodeBuku='$kode'";
$query = $this->db->query($sql);
}
}
?>