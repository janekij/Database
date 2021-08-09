<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika dataSiswa diklik maka
if (isset($_POST['dataSiswa'])) {
    $output = '';

    // mengambil data siswa dari nis yang berasal dari dataSiswa
    $sql = "SELECT * FROM siswa WHERE nis = '" . $_POST['dataSiswa'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '<tr align="center">
                            <td colspan="2"><img src="img/' . $row['gambar'] . '" width="50%"></td>
                        </tr>
                        <tr>
                            <th width="40%">เลขประจำตัว</th>
                            <td width="60%">' . $row['nis'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">ชื่อ-นามสกุล</th>
                            <td width="60%">' . $row['nama'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">สัญชาติ</th>
                            <td width="60%">' . $row['jekel'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">การตรวจเบื้องต้น</th>
                            <td width="60%">' . $row['jurusan'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">วันที่ตรวจพบเชื้อ</th>
                            <td width="60%">' . $row['tgl_Lahir'] . '</td>
                        </tr>
                        
                        <tr>
                            <th width="40%">เข้ากักตัววันที่</th>
                            <td width="60%">' . $row['post'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">ผู้จัดการไซต์</th>
                            <td width="60%">' . $row['alamat'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
