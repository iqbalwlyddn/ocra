<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "ocra";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id_karyawan      = "";
$nik_karyawan     = "";
$nama_karyawan    = "";
$mitra            = "";
$prod_c1          = "";
$prod_c2          = "";
$prod_c3          = "";
$prod_c4          = "";
$sukses           = "";
$error            = "";  

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from tb_karyawan where id_karyawan = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan hapus data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from tb_karyawan where id_karyawan = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nik_karyawan       = $r1['nik_karyawan'];
    $nama_karyawan      = $r1['nama_karyawan'];
    $mitra              = $r1['mitra'];

    while($r1   = mysqli_fetch_array($q1)){
        $nik_karyawan       = $r1['nik_karyawan'];
        $nama_karyawan      = $r1['nama_karyawan'];
        $mitra              = $r1['mitra'];
        }

    if ($nama_karyawan == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nik_karyawan       = $_POST['nik_karyawan'];
    $nama_karyawan      = $_POST['nama_karyawan'];
    $mitra              = $_POST['mitra'];

    if ($nik_karyawan && $nama_karyawan && $mitra) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update tb_karyawan set nik_karyawan = '$nik_karyawan',nama_karyawan = '$nama_karyawan',mitra = '$mitra' where id_karyawan = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            //echo $sql1;
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into tb_karyawan(nik_karyawan,nama_karyawan,mitra) values ('$nik_karyawan','$nama_karyawan','$mitra')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                echo $sql1."<br>";
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
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
                <center><h2>Daftar Teknisi</h2></center>
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
                <h2>Input / Ubah Data Teknisi</h2>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="index.php<?php if(isset($_GET['op'])){echo "?op=".$_GET['op']."&id=".$_GET['id'];}?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="nik_karyawan" class="col-sm-2 col-form-label">NIK Karyawan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik_karyawan" name="nik_karyawan" value="<?php echo $nik_karyawan ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?php echo $nama_karyawan ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mitra" class="col-sm-2 col-form-label">Mitra</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mitra" name="mitra" value="<?php echo $mitra ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="<?php if(isset($_GET['op'])){echo "Ubah Data";}else{echo "Simpan Data";}?>" class="btn btn-dark" /> 
                    </div>
                    </form>
                </div>
            </div>

            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">MITRA</th>
                            <th scope="col"><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                        $sql2   = "select * from tb_karyawan order by id_karyawan desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id                 = $r2['id_karyawan'];
                            $nik_karyawan       = $r2['nik_karyawan'];
                            $nama_karyawan      = $r2['nama_karyawan'];
                            $mitra              = $r2['mitra'];
                    ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nik_karyawan ?></td>
                                <td scope="row"><?php echo $nama_karyawan ?></td>
                                <td scope="row"><?php echo $mitra ?></td>
                                <td scope="row">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">    
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-info text-white">Update</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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