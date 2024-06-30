<?php
include __DIR__ . "/../../config/config.php"; // Sesuaikan path dengan struktur folder Anda

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Query to fetch employee data based on NIP
    $sql = "SELECT * FROM t_pegawai WHERE nip = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employeeData = [
            'nama_pegawai' => $row['nama_pegawai'],
            'nama_jabatan' => $row['nama_jabatan'],
            'gaji_pokok' => $row['gaji_pokok'],
            'tunjangan_jabatan' => $row['tunjangan_jabatan'],
            // Add more fields as needed
        ];
        echo json_encode($employeeData);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
