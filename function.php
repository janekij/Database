<?php
// การเชื่อมต่อฐานข้อมูล
$koneksi = mysqli_connect("localhost", "root", "", "fintechnic");



// สร้างฟังก์ชั่นแบบสอบถามในรูปแบบของอาร์เรย์
function query($query)
{
    // Koneksi database
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// สร้างฟังก์ชั่นเพิ่ม
function tambah($data)
{
    global $koneksi;

    $nis = $data['nis'];
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $jurusan = $data['jurusan'];
    $post = htmlspecialchars($data['post']);
    $gambar = upload();
    $alamat = htmlspecialchars($data['alamat']);
    $temper = htmlspecialchars($data['temper']); //เริ่ม Field ใน Database ใหม่ 
    $temper22 = htmlspecialchars($data["temper22"]);
    $symp = htmlspecialchars($data['symp']);
    $sympde = htmlspecialchars($data["sympde"]);
    $para1 = htmlspecialchars($data['para1']);
    $para11 = htmlspecialchars($data["para11"]);
    $para2 = htmlspecialchars($data['para2']);
    $para22 = htmlspecialchars($data["para22"]);
    $orther = htmlspecialchars($data['orther']);
    $orther2 = htmlspecialchars($data["orther2"]);

    if (!$gambar) {
        return false;
    }

    $sql = "INSERT INTO siswa VALUES ('$nis','$nama','$tmpt_Lahir','$tgl_Lahir','$jekel','$jurusan','$post','$gambar','$alamat','$temper','$temper22','$symp','$sympde','$para1','$para11','$para2','$para22','$orther','$orther2')";

    mysqli_query($koneksi, $sql);
	
	

    return mysqli_affected_rows($koneksi);
}

// สร้างฟังก์ชันการลบ
function hapus($nis)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = $nis");
    return mysqli_affected_rows($koneksi);
}

// สร้างฟังก์ชันแก้ไข
function ubah($data)
{
    global $koneksi;

    $nis = $data['nis'];
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $jurusan = $data['jurusan'];
    $post = htmlspecialchars($data['post']);
    $alamat = htmlspecialchars($data['alamat']);
    $temper = htmlspecialchars($data['temper']); //เริ่ม Field ใน Database ใหม่ 
    $temper22 = htmlspecialchars($data["temper22"]);
    $symp = htmlspecialchars($data['symp']);
    $sympde = htmlspecialchars($data["sympde"]);
    $para1 = htmlspecialchars($data['para1']);
    $para11 = htmlspecialchars($data["para11"]);
    $para2 = htmlspecialchars($data['para2']);
    $para22 = htmlspecialchars($data["para22"]);
    $orther = htmlspecialchars($data['orther']);
    $orther2 = htmlspecialchars($data["orther2"]);

    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $sql = "UPDATE siswa SET nama = '$nama', tmpt_Lahir = '$tmpt_Lahir', tgl_Lahir = '$tgl_Lahir', jekel = '$jekel', jurusan = '$jurusan', post = '$post', gambar = '$gambar', alamat = '$alamat', temper = '$temper', temper22 = '$temper22', symp = '$symp', sympde = '$sympde', para1 = '$para1', para11 = '$para11', para2 = '$para2', para22 = '$para22', orther = '$orther', orther2 = '$orther2' WHERE nis = $nis";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// ฟังค์ชั่นการอัพโหลดภาพ
function upload()
{
    // Syarat
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika tidak mengupload gambar atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    if ($error === 4) {
        echo "<script>alert('เลือกรูปก่อน!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk upload gambar adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // Jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // Jika ukuran gambar lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    // nama gambar akan berubah angka acak/unik jika sudah berhasil tersimpan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan nama baru
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
