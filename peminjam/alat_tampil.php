<?php 
session_start();
include '../koneksi.php';
if($_SESSION['level'] != "peminjam") header("location:../login.php");
?>
<!DOCTYPE html>
<html>
<head><title>Daftar Alat Olahraga</title></head>
<body>
    <h2>Daftar Alat Tersedia</h2>
   <table border="1" cellpadding="10">
    <tr>
        <th>Gambar</th> <th>Nama Alat</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Harga/Hari</th> <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php 
    $data = mysqli_query($koneksi, "SELECT * FROM alat INNER JOIN kategori ON alat.id_kategori = kategori.id_kategori");
    while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><img src="../assets/img/<?php echo $d['gambar']; ?>" width="100"></td>
        
        <td><?php echo $d['nama_alat']; ?></td>
        <td><?php echo $d['nama_kategori']; ?></td>
        <td><?php echo $d['deskripsi']; ?></td>
        
        <td>Rp <?php echo number_format($d['harga_per_hari'], 0, ',', '.'); ?></td>
        
        <td><?php echo $d['stok']; ?></td>
        <td><a href="pinjam_form.php?id=<?php echo $d['id_alat']; ?>">PINJAM</a></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>