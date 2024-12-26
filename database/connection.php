<?php
class ConnectionDatabase {
    public $connection;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "farmasi";

        // Inisialisasi koneksi
        $this->connection = new mysqli($host, $user, $password, $database);

        // Periksa apakah koneksi berhasil
        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close(); // Menutup koneksi database
        }
    }
}

// Membuat instance koneksi database
$db = new ConnectionDatabase();
$conn = $db->connection;
?>
