<?php
// konfigurasi database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_base = 'apppenggajian';

// koneksi database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_base);

if ($mysqli->connect_error) {
    die('Koneksi gagal: ' . $mysqli->connect_error);
}

// Set header untuk mengembalikan JSON
header('Content-Type: application/json');

// Mendapatkan metode HTTP yang digunakan
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Logika untuk GET request
        $query = "SELECT p.nip, p.nama_pegawai, p.tgl_lhr, p.tlp, p.alamat, j.nama_jabatan, j.gapok, j.tunjangan 
                  FROM t_pegawai p 
                  JOIN t_jabatan j ON p.id_jabatan = j.id_jabatan";
        $result = $mysqli->query($query);
        
        if (!$result) {
            echo json_encode(['error' => $mysqli->error]);
            break;
        }
        
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
        break;

    case 'POST':
        // Logika untuk POST request
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['nip']) || !isset($input['nama_pegawai']) || !isset($input['tgl_lhr']) || !isset($input['tlp']) || !isset($input['alamat']) || !isset($input['id_jabatan'])) {
            echo json_encode(['error' => 'Data yang dikirim tidak lengkap atau format salah']);
            break;
        }

        $nip = $input['nip'];
        $nama_pegawai = $input['nama_pegawai'];
        $tgl_lhr = $input['tgl_lhr'];
        $tlp = $input['tlp'];
        $alamat = $input['alamat'];
        $id_jabatan = $input['id_jabatan'];
        $query = "INSERT INTO t_pegawai (nip, nama_pegawai, tgl_lhr, tlp, alamat, id_jabatan) 
                  VALUES ('$nip', '$nama_pegawai', '$tgl_lhr', '$tlp', '$alamat', '$id_jabatan')";
        $result = $mysqli->query($query);

        if (!$result) {
            echo json_encode(['error' => $mysqli->error]);
            break;
        }

        echo json_encode(['message' => 'Data berhasil disimpan']);
        break;

    case 'PUT':
        // Logika untuk PUT request
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['nip']) || !isset($input['nama_pegawai']) || !isset($input['tgl_lhr']) || !isset($input['tlp']) || !isset($input['alamat']) || !isset($input['id_jabatan'])) {
            echo json_encode(['error' => 'Data yang dikirim tidak lengkap atau format salah']);
            break;
        }

        $nip = $input['nip'];
        $nama_pegawai = $input['nama_pegawai'];
        $tgl_lhr = $input['tgl_lhr'];
        $tlp = $input['tlp'];
        $alamat = $input['alamat'];
        $id_jabatan = $input['id_jabatan'];
        $query = "UPDATE t_pegawai SET nama_pegawai='$nama_pegawai', tgl_lhr='$tgl_lhr', tlp='$tlp', alamat='$alamat', id_jabatan='$id_jabatan' 
                  WHERE nip='$nip'";
        $result = $mysqli->query($query);

        if (!$result) {
            echo json_encode(['error' => $mysqli->error]);
            break;
        }

        echo json_encode(['message' => 'Data berhasil diupdate']);
        break;

    case 'DELETE':
        // Logika untuk DELETE request
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['nip'])) {
            echo json_encode(['error' => 'Data yang dikirim tidak lengkap atau format salah']);
            break;
        }

        $nip = $input['nip'];
        $query = "DELETE FROM t_pegawai WHERE nip='$nip'";
        $result = $mysqli->query($query);

        if (!$result) {
            echo json_encode(['error' => $mysqli->error]);
            break;
        }

        echo json_encode(['message' => 'Data berhasil dihapus']);
        break;

    default:
        echo json_encode(['message' => 'Metode tidak didukung']);
        break;
}
?>
