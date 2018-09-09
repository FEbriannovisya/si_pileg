<?php
    class MyFunction {
		
        private $con;
     
        function __construct() {
            require_once 'class.database.php';
            $db = new Database();
            $this->con = $db->connect();
        }

        public function getDataRelawan($idkategori) {
            $queryStr = "SELECT r.*, d.nama_kel, d.kode_pos 
                        FROM data_relawan AS r 
                        INNER JOIN wilayah_desa AS d ON (r.id_kel = d.id_kel) 
                        WHERE r.id_kategori = ".$idkategori." ORDER BY r.id_relawan ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $nik, $nama, $kelamin, $username, $password, $telp, $alamat, $idkel, $idkat, $namakel, $kodepos);
            $relawan = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_relawan'] = $id;
                $temp['nik'] = $nik;
                $temp['nama_relawan'] = $nama;
                $temp['jenis_kelamin'] = $kelamin;
                $temp['username'] = $username;
                $temp['password'] = $password;
                $temp['no_telp'] = $telp;
                $temp['alamat'] = $alamat;
                $temp['id_kelurahan'] = $idkel;
                $temp['nama_kelurahan'] = $namakel;
                $temp['kode_pos'] = $kodepos;
                $temp['id_kategori'] = $idkat;
                
                array_push($relawan, $temp);
            }
            
            return $relawan; 
        }

        public function getDataSaksi($idkategori) {
            $queryStr = "SELECT s.*, d.nama_kel, d.kode_pos, t.no_tps, t.nama_tps 
                         FROM data_saksi AS s 
                         INNER JOIN wilayah_desa AS d ON (s.id_kel = d.id_kel) 
                         INNER JOIN data_tps AS t ON (s.id_tps = t.id_tps) 
                         WHERE s.id_kategori = ".$idkategori." ORDER BY s.id_saksi ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result(
                $id, $nik, $nama, $kelamin, $username, $password, $telp, $alamat, 
                $idkel, $idkat, $idtps, $namakel, $kodepos, $notps, $namatps
            );
            $saksi = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_saksi'] = $id;
                $temp['nik'] = $nik;
                $temp['nama_saksi'] = $nama;
                $temp['jenis_kelamin'] = $kelamin;
                $temp['username'] = $username;
                $temp['password'] = $password;
                $temp['no_telp'] = $telp;
                $temp['alamat'] = $alamat;
                $temp['id_kelurahan'] = $idkel;
                $temp['nama_kelurahan'] = $namakel;
                $temp['kode_pos'] = $kodepos;
                $temp['id_kategori'] = $idkat;
                $temp['id_tps'] = $idtps;
                $temp['no_tps'] = $notps;
                $temp['nama_tps'] = $namatps;
                
                array_push($saksi, $temp);
            }
            
            return $saksi; 
        }

        public function getDataTps() {
            $queryStr = "SELECT * FROM data_tps ORDER BY no_tps ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $nomor, $nama, $alamat, $idkel);
            $tps = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_tps'] = $id;
                $temp['no_tps'] = $nomor;
                $temp['nama_tps'] = $nama;
                $temp['alamat'] = $alamat;
                $temp['id_kel'] = $idkel;
                
                array_push($tps, $temp);
            }
            
            return $tps; 
        }

        public function getDataProvinsi() {
            $queryStr = "SELECT * FROM wilayah_provinsi ORDER BY nama_prov ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $nama);
            $provinsi = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_prov'] = $id;
                $temp['nama_prov'] = $nama;
                
                array_push($provinsi, $temp);
            }
            
            return $provinsi; 
        }

        public function getDataKabupaten($idprov) {
            $queryStr = "SELECT * FROM wilayah_kabupaten WHERE id_prov = ".$idprov." ORDER BY nama_kab ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $idprov, $nama);
            $kabkota = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_kab'] = $id;
                $temp['nama_kab'] = $nama;
                $temp['id_prov'] = $idprov;
                
                array_push($kabkota, $temp);
            }
            
            return $kabkota; 
        }

        public function getDataKecamatan($idkab) {
            $queryStr = "SELECT * FROM wilayah_kecamatan WHERE id_kab = ".$idkab." ORDER BY nama_kec ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $idkab, $nama);
            $kecamatan = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_kec'] = $id;
                $temp['nama_kec'] = $nama;
                $temp['id_kab'] = $idkab;
                
                array_push($kecamatan, $temp);
            }
            
            return $kecamatan; 
        }

        public function getDataKelurahan($idkec) {
            $queryStr = "SELECT * FROM wilayah_desa WHERE id_kec = ".$idkec." ORDER BY nama_kel ASC";

            $stmt = $this->con->prepare($queryStr);
            $stmt->execute();
            $stmt->bind_result($id, $idkec, $nama, $kodepos);
            $desa = array();
        
            while ($stmt->fetch()) {
                $temp = array();

                $temp['id_kel'] = $id;
                $temp['nama_kel'] = $nama;
                $temp['kode_pos'] = $kodepos;
                $temp['id_kec'] = $idkec;
                
                array_push($desa, $temp);
            }
            
            return $desa; 
        }

        /*public function tambahData($nama, $telp) {
            $stmt = $this->con->prepare("INSERT INTO mahasiswa (nama, telp) VALUES (?, ?)");
            $stmt->bind_param("ss", $nama, $telp);
        
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }*/
		
    }
	
?>