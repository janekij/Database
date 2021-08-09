<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari table siswa berdasarkan nis secara Descending
$siswa = query("SELECT * FROM siswa ORDER BY nis DESC");

// Membuat nama file
$filename = "data siswa-" . date('Ymd') . ".xlsx";

// Kodingam untuk export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");

?>

<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <center><h3>ข้อมูลเวชระเบียน ผู้ป่วยสนามคลอง 9</h3></center>
            <th>ลำดับ</th>
            <th>เลขประจำตัว</th>
            <th>ชื่อ-นามสกุล</th>
            <th>สัญชาติ</th>
            <th>วัคซีนที่รับครังที่1</th>
            <th>การตรวจเบื้องต้น</th>
            <th>พบเชื้อเมื่อวันที่</th>
            <th>เข้ากักตัว</th>
            <th>ผู้จัดการ</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($siswa as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jekel']; ?></td>
            
                <td><?= $row['tmpt_Lahir']; ?>vaccine</td>
                <td><?= $row['jurusan']; ?></td>
                <td><?= $row['tgl_Lahir']; ?></td>
                <td><?= $row['post']; ?></td>
                <td><?= $row['alamat']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>