<?php
	require_once "../include/class.function.php";

	$response = array();

	if (isset($_GET['method'])) {
	    switch ($_GET['method']) {
			case 'get_data_kabupaten':
				$dbo = new MyFunction();
				$kabkota = $dbo->getDataKabupaten($_GET['id_prov']);
				
				if (count($kabkota) <= 0) {
					$response['status'] = false;
					$response['message'] = 'Data tidak ditemukan.';
				} else {
					$response['status'] = true;
					$response['kabkota'] = $kabkota;
				}
			break;

			case 'get_data_kecamatan':
				$dbo = new MyFunction();
				$kecamatan = $dbo->getDataKecamatan($_GET['id_kab']);
				
				if (count($kecamatan) <= 0) {
					$response['status'] = false;
					$response['message'] = 'Data tidak ditemukan.';
				} else {
					$response['status'] = true;
					$response['kecamatan'] = $kecamatan;
				}
			break;

			case 'get_data_kelurahan':
				$dbo = new MyFunction();
				$desa = $dbo->getDataKelurahan($_GET['id_kec']);
				
				if (count($desa) <= 0) {
					$response['status'] = false;
					$response['message'] = 'Data tidak ditemukan.';
				} else {
					$response['status'] = true;
					$response['desa'] = $desa;
				}
			break;

			default:
				$response['status'] = false;
				$response['message'] = 'Invalid method!';
		}
	} else {
	    $response['status'] = false; 
	    $response['message'] = 'Invalid request!!';
	}

	//displaying the data in json 
	echo json_encode($response);

?>