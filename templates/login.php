<?php
require_once 'loader.php';
require_once 'header.php';
$conn = db_conn();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    header("location:$base_url/panel");
    exit;
}
?>

<title>Login</title>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body pb-0">
                                    <form method="POST" id="login">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" type="email" placeholder="name@example.com" required>
                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="pass" type="password" placeholder="Password" required>
                                            <label for="pass">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-0 justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="button">Login</button>
                                        </div>
                                        <div id="result" class="my-1 d-flex align-items-center justify-content-center">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <a class="small" href="<?php base_url() ?>pass">Forgot Password?</a>
                                    <div class="small"><a href="<?php base_url() ?>register">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
    require_once 'footer.php';
    ?>