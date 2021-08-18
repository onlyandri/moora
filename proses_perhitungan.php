
<?php
include 'koneksi.php';

// buat matrik
 
if(isset($_POST["jbt"])){

	$jb = $_POST["jbt"];

	if($jb !== "t"){
		$qr = mysqli_query($conn, "SELECT * FROM pelamar where jabatan = '$jb' group by jabatan order by jabatan asc");
	}else{
		$qr = mysqli_query($conn, "SELECT * FROM pelamar group by jabatan order by jabatan asc");
	}

	$output = '';
	$dua ='';
	$tiga ='';
	$juara = 'belum ada data';
	$nilaiHasil = '0';
	$no=0;
	while ($dt = mysqli_fetch_array($qr)) {
		$no++;
		$data=mysqli_query($conn,"SELECT p.kode_pelamar,p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
			max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
			max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
			max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
			max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
			max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
			max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'  
			FROM penilaian n, pelamar p  
			where n.kode_pelamar=p.kode_pelamar and p.jabatan = '".$dt['jabatan']."'
			GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar asc
			");
		$matrik = $data->fetch_all(MYSQLI_ASSOC);
//print_r($matrik);

// ambil kriteria
		$data=mysqli_query($conn,"SELECT * FROM kriteria");
		$kriteria = $data->fetch_all(MYSQLI_ASSOC);
		$tmp = [];
		foreach ($kriteria as $key => $value) {
			$tmp[$value['kode_kriteria']] = $value;
		}
		$kriteria = $tmp;
//print_r($kriteria);

// menentukan pembagi tiap kriteria
		$data=mysqli_query($conn,"SELECT n.kode_kriteria, 
			SUM(n.nilai * n.nilai) as 'nilai'
			FROM penilaian n, pelamar p  
			where n.kode_pelamar=p.kode_pelamar 
			GROUP BY n.kode_kriteria
			");
		$pembagi = $data->fetch_all(MYSQLI_ASSOC);
//print_r($pembagi);
		$tmp = $matrik;
		foreach ($pembagi as $key => $value) {
			foreach ($matrik as $key2 => $value2) {
				$tmp[$key2][$value['kode_kriteria']] = $value2[$value['kode_kriteria']] / $value['nilai'];
			}
		}
		$normalisasi = $tmp;
//print_r($normalisasi);

// normalisasi
		$tmp = $normalisasi;
		foreach ($kriteria as $key => $value) {
			foreach ($normalisasi as $key2 => $value2) {
				$tmp[$key2][$value['kode_kriteria']] = $value2[$value['kode_kriteria']] * $value['bobot'];
			}
		}

		
		$wij = $tmp;
		foreach ($wij as $key => $value) {
			$jml_benefit = 0;
			$jml_cost = 0;
			foreach ($kriteria as $key2 => $value2) {
				if($value2['jenis_kriteria'] == 'Benefit'){
					$jml_benefit += $value[$value2['kode_kriteria']];
				}

				if($value2['jenis_kriteria'] == 'Cost'){
					$jml_cost += $value[$value2['kode_kriteria']];
				}
			}
			$wij[$key]['MAX'] = $jml_benefit;
			$wij[$key]['MIN'] = $jml_cost;
			$wij[$key]['Y'] = $jml_benefit - $jml_cost;
			$wij[$key]['rank'] = 0;
		}


//print_r($wij);
// perankingan
		$index = 0;
		for($i = 1; $i <= count($wij); $i++){
			$max = 0;
			foreach($wij as $key => $value){
				if($max < $value['Y'] & $value['rank'] == '0'){
					$max = $value['Y'];
					$index = $key;
				}
			}
			$wij[$index]['rank'] = $i;
		}


		foreach($wij as $d){
			
			if($d['rank'] == 1){
				$juara = $d['nama_pelamar'];
				$nilaiHasil = $d['Y'];

				$tiga .='<p class = "font-weight-bold">Jadi Rekomendasi Perekrutan Karyawan Jabatan '.$dt['jabatan'].' Jatuh Kepada '.$d['nama_pelamar'].' Dengan Nilai '.substr($d['Y'],0,4).'</p>';
			}
			$dua .= '<tr>
			<td>'.$d['kode_pelamar'].'</td>
			<td>'.$d['nama_pelamar'].'</td>
			<td>'.$d['jabatan'].'</td>
			<td>'.$d['tanggal_penilaian'].'</td>
			<td>'.substr($d['Y'],0,4).'</td>
			<td>'.$d['rank'].'</td>
			</tr> ';
		} 




		$output .='

		<div class="card mb-3">
		<div class="card-header">
		<i class="fas fa-user-circle"></i>
		List Hasil Perhitungan Posisi Jabatan '.$dt['jabatan'] .'</div>
		<div class="card-body">

		<!--   <a href="cetak_hasil.php" class="btn btn-danger btn-sm"><i class="fas fa-print"></i>Export To PDF</a>

		<br/>&nbsp; -->
		<div class="table-responsive">
		<table class="table table-bordered" width="100%" cellspacing="0" id="domainsTable'.$no.'">
		<thead>
		<tr>
		<th>Kode Pelamar</th>
		<th>Nama Pelamar</th>
		<th>Jabatan</th>
		<th>Tanggal Penilaian</th>
		<th>Hasil</th> 
		<th>Rangking</th>
		</tr>
		</thead>


		<tbody>
		'.$dua.'
		</tbody>
		</table>

		</div>
			'.$tiga.'
		</div>

		</div>
		';
	}

	echo $output;
}
?>