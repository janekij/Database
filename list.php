<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login


// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari table siswa berdasarkan nis secara Descending
$siswa = query("SELECT * FROM siswa ORDER BY nis DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>บริษัท ฟินเทคนิค จำกัด</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">
            <div>
              <div>Fintechnic.co.th</div>
            </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                   
                   
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">login</a>
                    </li>
                </ul>
            </div>
      </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="container"
                <table width="968" border="0">
                  <tbody>
                    <tr>
                      <td width="240"><img src="img/logo-and-name.jpg" width="240" height="63" alt=""/></td>
                      <td width="718"><span class="text-center fw-bold text-uppercase"><center><h3>เวชระเบียน | สนามคลอง 9</h3></center></span></td>
                    </tr>
                  </tbody>
                </table>
                <hr>
          </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <a href="addData.php" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;เพิ่มข้อมูลผู้ติดเชื้อ</a>
                <a href="export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Export Excel</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md">
                <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>ชื่อ</th>
                            <th>เชื้อชาติ</th>
                            <th>วัคซีนครั้งที่ 1</th>
                            <th>การตรวจเบื้องต้น</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($siswa as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jekel']; ?></td>
                                <?php
                                $now = time();
                                $timeTahun = strtotime($row['tgl_Lahir']);
                                $setahun = 31536000;
                                $hitung = ($now - $timeTahun) / $setahun;
                                ?>
                                <td><?= $row['tmpt_Lahir']; ?> </td>
                                <td><?= $row['jurusan']; ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm text-white detail" data-id="<?= $row['nis']; ?>" style="font-weight: 600;"><i class="bi bi-info-circle-fill"></i>&nbsp;ข้อมูล</button> |

                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Modal Detail Data -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-uppercase" id="detail">ข้อมูลผู้ป่วย</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="detail-siswa">
                </div>
            </div>
        </div>
    </div>
    <!-- Close Modal Detail Data -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white">
          <center>
            <div class="col-md-6 my-2 text-center link"></div>
            <div class="col-md-6 my-2" id="about"><br>
            <a href="https://web.facebook.com/vikry.surya.5/" target="_blank"><i class="bi bi-facebook fs-3"></i></a> <a href="https://github.com/vikrysurya24" target="_blank"><i class="bi bi-github fs-3"></i></a> <a href="https://www.instagram.com/vikrysurya_/" target="_blank"><i class="bi bi-instagram fs-3"></i></a> <a href="https://twitter.com/vikrysurya_" target="_blank"><i class="bi bi-twitter fs-3"></i></a></div>
          </center>
        </div>
    </div>
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p>COPYRIGHT © 2021 FINTECHNIC DEVELOPMENT. ALL RIGHTS RESERVED <a href="http://www.fintechnic.co.th/">FINTECHNIC</a></p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table

            // Fungsi Detail
            $('.detail').click(function() {
                var dataSiswa = $(this).attr("data-id");
                $.ajax({
                    url: "detail.php",
                    method: "post",
                    data: {
                        dataSiswa,
                        dataSiswa
                    },
                    success: function(data) {
                        $('#detail-siswa').html(data);
                        $('#detail').modal("show");
                    }
                });
            });
            // Fungsi Detail
        });
    </script>
</body>

</html>