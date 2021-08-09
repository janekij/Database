<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nis dengan fungsi get
$nis = $_GET['nis'];


// Mengambil data dari table siswa dari nis yang tidak sama dengan 0
$siswa = query("SELECT * FROM siswa WHERE nis = $nis")[0];
 


// Jika fungsi ubah lebih dari 0/data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('อัฟเดทข้อมูลสำเร็จ!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika fungsi ubah dibawah dari 0/data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('ไม่สามารถแก้ไขข้อมูลได้!');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><br>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Fintechnic.co.th | สนามคลอง 9</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fintechnic.co.th | สนามคลอง 9</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;แก้ไขข้อมูล</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                  <span class="mb-3">หมายเลขประจำตัวผู้ป่วย(A=ช.,B=ญ.)
                  <input name="nis2" type="text" class="form-control w-50" id="nis2" autocomplete="off" value="<?= $siswa['nis']; ?>" readonly="readonly">
                  </span>
                    <div class="mb-3">
                      <label for="nis" class="form-label">เลขที่อ้างอิงจากไซต์</label>
                   <input name="nis" type="text" class="form-control w-50" id="nis" autocomplete="off" value="<?= $siswa['nis']; ?>" readonly="readonly">
                  </div>
                    <div class="mb-3">
                      <label for="nama" class="alert-info">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control w-50" id="nama" value="<?= $siswa['nama']; ?>" name="nama" autocomplete="off" required>
                    </div>
                    <div><div class="mb-3">
                      <label class="alert-info">สัญชาติ</label>
                      <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="thai" value="thai" <?php if ($siswa['jekel'] == 'thai') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="thai">ไทย</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Myanmar" value="Myanmar" <?php if ($siswa['jekel'] == 'Myanmar') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="Myanmar">เมียนม่า</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Cambodia" value="Cambodia" <?php if ($siswa['jekel'] == 'Cambodia') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="Cambodia">กัมพูชา</label>
                        </div></div>
                    <div class="mb-3">
                      <label for="tmpt_Lahir2" class="alert-info">รับวัคซีน(เข็มที่1)</label>
                      <input type="text" class="form-control w-50" id="tmpt_Lahir" value="<?= $siswa['tmpt_Lahir']; ?>" name="tmpt_Lahir" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                      <label for="jurusan" class="alert-info">การตรวจเบื้องต้น</label>
                      <select class="form-select w-50" id="jurusan" name="jurusan">
                        <option value="ATK(Antigen Test Kit)" <?php if ($siswa['jurusan'] == 'ATK(Antigen Test Kit)') { ?> selected='' <?php } ?>>ATK(Antigen Test Kit)</option>
                            <option value="RT-PCR(Real Time Polymerase Chain Reaction)" <?php if ($siswa['jurusan'] == 'RT-PCR(Real Time Polymerase Chain Reaction)') { ?> selected='' <?php } ?>>RT-PCR(Real Time Polymerase Chain Reaction)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="tgl_Lahir2" class="alert-danger">วันที่ตรวจพบเชื้อ</label>
                      <input type="date" class="form-control w-50" id="tgl_Lahir" value="<?= $siswa['tgl_Lahir']; ?>" name="tgl_Lahir" autocomplete="off" required>
                    </div>                  
                    </div>                   
                    <div class="mb-3">
                      <label for="email2" class="alert-danger">เข้ากักตัววันที่</label>
                      <input type="date" class="form-control w-50" id="post" value="<?= $siswa['post']; ?>" name="post" autocomplete="off" required>	

                    </div>
                    <div class="mb-3">
                      <label for="gambar2" class="alert-info">อัฟโหลดรูป</label>
                      <br>
                        <img src="img/<?= $siswa['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
                    <div class="mb-3">
                      <h5 class="fw-bold text-uppercase"><i class="bi bi-person-plus-fill"></i>&nbsp;ติดตามอาการ<br>
                      </h5>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-3" style="background-color:lavender;"><span class="alert-warning">อุณหภูมิ
                            <label for="datetime">:</label>
                            </span>
                            <input type="date" class="form-control w-50" id="temper" value="<?= $siswa['temper']; ?>"name="temper" max="01-01-2006" required>
                            ตัวเลข :
                            <input name="temper22"text" id="temper22" value="<?= $siswa['temper22']; ?>"maxlength="25" style="width:90px;border:none;"/>
																							  
                            องศา</div>
                          <div class="col-sm-3" style="background-color:lavender;"><span class="alert-warning">อาการ
                            <label for="datetime2">:</label>
                            </span>
                            <input type="date" class="form-control w-50" id="symp" value="<?= $siswa['symp']; ?>"name="symp" max="01-01-2006" required>
                            รายละเอียด :
                            <input name="sympde"text" id="sympde" value="<?= $siswa['sympde']; ?>"maxlength="25" style="width:90px;border:none;"/>
                          </div>
                          <div class="col-sm-3" style="background-color:lavender;"><span class="alert-warning">รับยาฟ้าทะลายโจร
                            <label for="datetime4">:</label>
                            </span>
                            <label for="datetime4"></label>
                            <input type="date" class="form-control w-50" id="para1" value="<?= $siswa['para1']; ?>"name="para1" max="01-01-2006" required>
                            จำนวน:
                            <input name="para11"text" id="para11" value="<?= $siswa['para11']; ?>"maxlength="25" style="width:90px;border:none;"/>
                            เม็ด</div>
                          <div class="col-sm-3" style="background-color:lavender;"><span class="alert-warning">รับยาพารา
                            <label for="datetime3">:</label>
                            </span>
                            <input type="date" class="form-control w-50" id="para2"value="<?= $siswa['para1']; ?>" name="para2" max="01-01-2006" required>
                            จำนวน :
                            <input name="para22"text" id="para22" value= "<?= $siswa['para22']; ?>"maxlength="25" style="width:90px;border:none;"/>
                            เม็ด</div>
                          <div class="col-sm-3" style="background-color:lavender;"><span class="alert-warning">ยาอื่นๆ(ถ้ามี)
                            <label for="datetime5">:</label>
                            </span>
                            <input type="date" class="form-control w-50" id="orther" value="<?= $siswa['para1']; ?>" name="orther" max="01-01-2006" required>
                            จำนวน :
                            <input name="orther2"text" id="orther2" value= "<?= $siswa['para22']; ?>"maxlength="25" style="width:90px;border:none;"/>
                            เม็ด</div>
                            
                        </div>
                      </div>
                      <h5 class="fw-bold text-uppercase">&nbsp; </h5>
                      <p><span class="alert-info">ผู้จัดการไซต์ (Manager)</span>
                        <input type="text" name="alamat" id="alamat" value="<?= $siswa['alamat']; ?>">
                        <br>
                      </p>
                  </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
                    <button type="submit" class="btn btn-warning" name="ubah">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->



    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white">
            <center><div class="col-md-6 my-2">
                <div class="col-md-6 my-2 text-center link"><a href="https://web.facebook.com/vikry.surya.5/" target="_blank"><i class="bi bi-facebook fs-3"></i></a> <a href="https://github.com/vikrysurya24" target="_blank"><i class="bi bi-github fs-3"></i></a> <a href="https://www.instagram.com/vikrysurya_/" target="_blank"><i class="bi bi-instagram fs-3"></i></a> <a href="https://twitter.com/vikrysurya_" target="_blank"><i class="bi bi-twitter fs-3"></i></a></div>
            </div>
            </center>
        </div>
    </div>
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p>COPYRIGHT © 2021 FINTECHNIC DEVELOPMENT. ALL RIGHTS RESERVED <a href="http://www.fintechnic.co.th/">FINTECHNIC</a></p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>