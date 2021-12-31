<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "ocra";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$qry_get_karyawan   = "select * from tb_karyawan";
$exec_qry_karyawan  = mysqli_query($koneksi, $qry_get_karyawan);
$idx_karyawan = 0;

//Nilai kriteria pada masing – masing alternatif ditambah dengan 1 agar mendapat hasil yang valid, sehingga matriks yang diperoleh:
while($karyawan = mysqli_fetch_array($exec_qry_karyawan)){
    $fetch_karyawan[$idx_karyawan]['c1'] = $karyawan['prod_c1'] + 1;
    $fetch_karyawan[$idx_karyawan]['c2'] = $karyawan['prod_c2'] + 1;
    $fetch_karyawan[$idx_karyawan]['c3'] = $karyawan['prod_c3'] + 1;
    $fetch_karyawan[$idx_karyawan]['c4'] = $karyawan['prod_c4'] + 1;

    $mtrx_karyawan_map[$idx_karyawan][] = $karyawan['id_karyawan'];
    $mtrx_karyawan_map[$idx_karyawan][] = $karyawan['nama_karyawan'];

    $idx_karyawan++;
}

//Menghitung Cost (C4)
$max_c4 = max_with_key($fetch_karyawan, 'c4');
$min_c4 = min_with_key($fetch_karyawan, 'c4');

$qry_get_bobot   = "select * from tb_kriteria";
$exec_qry_bobot  = mysqli_query($koneksi, $qry_get_bobot);
while($bobot = mysqli_fetch_array($exec_qry_bobot)){
    $bobot_kriteria[$bobot['kode_kriteria']][] = $bobot['bobot_kriteria'];
}


//menghitung peringkat preferensi linier dari setiap alternatif untuk kriteria yang akan diminimalkan (cost).
foreach($fetch_karyawan as $c4){
    $cost[] = (($max_c4 - $c4['c4']) / $min_c4) * $bobot_kriteria['C4'][0];
}

foreach($cost as $c){
    $result_cost[] = $c - min($cost);
}

//Benefit
$max_c1 = max_with_key($fetch_karyawan, 'c1');
$min_c1 = min_with_key($fetch_karyawan, 'c1');
$min_c2 = min_with_key($fetch_karyawan, 'c2');
$min_c3 = min_with_key($fetch_karyawan, 'c3');

//menghitung peringkat preferensi linier dari setiap alternatif untuk kriteria yang akan diminimalkan (cost).
foreach($fetch_karyawan as $c){
    $benefit[] = ((($c['c1'] - $min_c1) / $min_c1) * $bobot_kriteria['C1'][0]) + 
                    ((($c['c2'] - $min_c2) / $min_c2) * $bobot_kriteria['C2'][0]) +
                    ((($c['c3'] - $min_c3) / $min_c3) * $bobot_kriteria['C3'][0]);
}

foreach($benefit as $b){
    $result_benefit[] = $b - min($benefit);
}

//Perhitungan total nilai preferensi.
for($i = 0; $i < count($result_benefit); $i++){
    $total_pref[$i] = $result_cost[$i] + $result_benefit[$i];
}

foreach($total_pref as $pref){
    $result_total_pref[] = $pref - min($total_pref);
}

//Rangking
$ordered_values = $result_total_pref;
rsort($ordered_values);

$idx = 0;
foreach ($result_total_pref as $key => $value) {
    foreach ($ordered_values as $ordered_key => $ordered_value) {
        if ($value === $ordered_value) {
            $key = $ordered_key;
            break;
        }
    }
    echo $mtrx_karyawan_map[$idx][1] . ' - Rank: ' . ((int) $key + 1) . '<br/>';
    $idx++;
}

function max_with_key($array, $key) {
    if (!is_array($array) || count($array) == 0) return false;
    $max = $array[0][$key];
    foreach($array as $a) {
        if($a[$key] > $max) {
            $max = $a[$key];
        }
    }
    return $max;
}

function min_with_key($array, $key) {
    if (!is_array($array) || count($array) == 0) return false;
    $max = $array[0][$key];
    foreach($array as $a) {
        if($a[$key] < $max) {
            $max = $a[$key];
        }
    }
    return $max;
}

?>