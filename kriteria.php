<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "ocra";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id_kriteria      = "";
$kode_kriteria    = "";
$nama_kriteria    = "";
$bobot_kriteria   = "";
$sukses           = "";
$error            = "";  

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from tb_kriteria where id_kriteria = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $kode_kriteria    = $r1['kode_kriteria'];
    $nama_karyawan    = $r1['nama_kriteria'];
    $bobot_karyawan   = $r1['bobot_kriteria'];
}

    if ($kode_kriteria && $nama_kriteria && $bobot_kriteria) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update tb_kriteria set kode_kriteria = '$kode_kriteria',nama_kriteria = '$nama_kriteria',bobot_kriteria = '$bobot_kriteria' where id_kriteria = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            //echo $sql1;
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 900px
        }
        .button_right {
            float: right;
            margin-right: 15px; 
        }
        .button_left {
            float: left;
            margin-left: 15px; 
        }
        .card {
            margin-top: 10px;
        }
        body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        }
        .topnav {
        overflow: hidden;
        background-color: #333;
        }
        .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }
        .topnav a:hover {
        background-color: #ddd;
        color: black;
        }
        .topnav a.active {
        background-color: #04AA6D;
        color: white;
        }
    </style>

</head>
<body>
<div class="card mx-auto">
            <div class="topnav">
                <a href="index.php">Data Teknisi</a>
                <a href="performansi.php">Data Performansi</a>
                <a href="kriteria.php">Data Kriteria</a>
                <a href="">Perhitungan OCRA</a>
                <a href="" class="btn button_right">Logout</a>
            </div>
            <div style="padding-left:16px; margin-top:10px">
                <center><h2>Variabel Kriteria</h2></center>
            </div>
            <div class="card-body">
                
            <!--<div class="row g-3 align-items-center justify-content-md-end button_left">
                <div class="col-auto">
                <label for="search" class="col-form-label "></label>
                </div>
                <div class="col-auto ">
                    <form action="" method="post">
                    <input class="form-control " id="myInput" type="text" placeholder="Pencarian.." autofocus autocomplete="off">
                    </form>
                </div>
            </div>-->

            <div style="padding-left:16px; margin-top:10px">
                <h2>Update Kriteria</h2>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=kriteria.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=kriteria.php");
                }
                ?>
                <form action="kriteria.php<?php if(isset($_GET['op'])){echo "?op=".$_GET['op']."&id=".$_GET['id'];}?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="kode_kriteria" class="col-sm-2 col-form-label">Kode Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="kode_kriteria" name="kode_kriteria" value="<?php echo $kode_kriteria ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?php echo $nama_kriteria ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bobot_kriteria" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bobot_kriteria" name="bobot_kriteria" value="<?php echo $bobot_kriteria ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="edit" value="<?php if(isset($_GET['op'])){echo "Ubah Data";}else{echo "Simpan Data";}?>" class="btn btn-dark" /> 
                    </div>
                    </form>
                </div>
            </div>

            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Kriteria</th>
                            <th scope="col">Nama Kriteria</th>
                            <th scope="col">Bobot Kriteria</th>
                            <th scope="col"><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                        $sql2   = "select * from tb_kriteria order by id_kriteria desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id                 = $r2['id_kriteria'];
                            $kode_kriteria      = $r2['kode_kriteria'];
                            $nama_kriteria      = $r2['nama_kriteria'];
                            $bobot_kriteria     = $r2['bobot_kriteria'];
                    ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kode_kriteria ?></td>
                                <td scope="row"><?php echo $nama_kriteria ?></td>
                                <td scope="row"><?php echo $bobot_kriteria ?></td>
                                <td scope="row">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">    
                                    <a href="kriteria.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-info text-white">Edit</button></a>        
                                </div>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                    </tbody>
                    
                </table>
                <div class="mx-auto card-footer bg-transparent border-light"><center>&copy; Telkom Akses 2021</center></div>
            </div>
        
        </div>
       
    </div>
</body>
</html>