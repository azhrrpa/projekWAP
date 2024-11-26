<?php
class ConnectionDatabase {
    private $db_host = "localhost";
    private $db_username = "root";
    private $db_pass = "";
    private $db_name = "pharmacy_app";
    public $connection;

    function __construct()
    {
        // Membuat koneksi
        $this->connection = new mysqli(
            $this->db_host,
            $this->db_username,
            $this->db_pass,
            $this->db_name
        );

        // Cek koneksi
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    function closeConnection() {
        $this->connection->close();
    }
}
?>
