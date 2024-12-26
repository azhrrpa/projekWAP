<?php
    include('connection.php');

    class Auth {

        function __construct()
        {
            $this->database = new ConnectionDatabase();
        }

        function register($name, $email, $password, $role = 'user'){
            // Jika email yang didaftarkan adalah admin@gmail.com, maka set role ke admin
        if ($email === 'admin@gmail.com') {
            $role = 'admin'; 
        }
            $query = "INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`) VALUES (?,?,?,?)";
        
            $process = $this->database->connection->prepare($query);
        

            if($process) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $process->bind_param('ssss', $name, $email, $hashedPassword, $role); // Menambahkan parameter role
                $process->execute();
            } else {
                $error = $this->database->connection->errno . ' ' . $this->database->connection->error;
                echo $error;
            }
        
            $process->close();
            $this->database->closeConnection();            
        
            return true;
        }
               

        public function login($email, $password) {
                // Cek apakah email valid
            $query = "SELECT * FROM pengguna WHERE email = ?";
            $stmt = $this->db->connection->prepare($query);
        
            if ($stmt) {
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
        
                    // Verifikasi password
                    if (password_verify($password, $user['password'])) {
                        // Menyimpan data ke session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
        
                        // Mengarahkan berdasarkan role
                        if ($user['role'] === 'admin') {
                            header("Location: ManageProduct.php");
                        } elseif ($user['role'] === 'user') {
                            header("Location: index.php");
                        }
                        exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
                    } else {
                        return false; // Password salah
                    }
                    } else {
                        return false; // Email tidak ditemukan
                    }
        
                $stmt->close();
            } else {
                return false; // Terjadi kesalahan saat query
            }
        
            $this->db->closeConnection();
            return false; // Login gagal
            }
        }
?>
        