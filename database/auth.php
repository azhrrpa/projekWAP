<?php
    include('connection.php');

    class Auth {

        private $database;

        function __construct()
        {
            $this->database = new ConnectionDatabase();
        }

        // Fungsi untuk registrasi pengguna
        function register($name, $email, $password){
            // Query untuk menyimpan data pengguna
            $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (?,?,?)";
            
            // Persiapkan query untuk dieksekusi
            $process = $this->database->connection->prepare($query);

            if ($process) {
                // Hash password dengan password_hash() yang lebih aman
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Bind parameter dan eksekusi query
                $process->bind_param('sss', $name, $email, $hashedPassword);
                
            } else {
                $error = $this->database->connection->errno . ' ' . $this->database->connection->error;
                echo $error;
            }

            // Tutup query dan koneksi
            $process->close();
            $this->database->closeConnection();            

            return true;
        }

        // Fungsi untuk login pengguna
        function login($email, $password){
            $result = null;
            $query = "SELECT * FROM `users` WHERE email = ?";
            
            // Persiapkan query untuk dieksekusi
            $process = $this->database->connection->prepare($query);
            
            if ($process) {
                $process->bind_param('s', $email);
                $process->execute();

                $result = $process->get_result();
                $result = $result->fetch_assoc();

                // Verifikasi password dengan password_verify()
                if ($result && !password_verify($password, $result['password'])) {
                    return false;
                }
                
            } else {
                $error = $this->database->connection->errno . ' ' . $this->database->connection->error;
                echo $error;
            }

            // Tutup query dan koneksi
            $process->close();
            $this->database->closeConnection();            

            return $result;
        }
    }
?>
