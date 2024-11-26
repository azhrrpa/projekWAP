<!doctype html>
<html lang="en">
<head>
    <?php include('header.php') ?>
</head>

<body>
    <?php include('navbar.php') ?>

    <main role="main " class="container">
        <div class="container mt-5">
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-4">Halaman Register</h5>
                    <form action="controller/auth.php?action=register" method="POST" id="registerForm">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Input your name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Input your email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Input your password" name="password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('footer.php') ?>

    <?php include('scripts.php') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah tombol login dan signup disembunyikan sebelumnya
            if (localStorage.getItem("formSubmitted") === "true") {
                const loginButton = document.getElementById("loginBtn");
                const signUpButton = document.getElementById("signUpBtn");
                
                if (loginButton && signUpButton) {
                    loginButton.style.display = "none";
                    signUpButton.style.display = "none";
                }
            }

            // Cek jika form register disubmit
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function () {
                localStorage.setItem("formSubmitted", "true");  // Menyimpan status form telah disubmit
            });
        });
    </script>
</body>
</html>
