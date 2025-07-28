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

  <body class="bg-primary">
      <div id="layoutAuthentication">
          <div id="layoutAuthentication_content">
              <main>
                  <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-lg-5">
                              <div class="card shadow-lg border-0 rounded-lg mt-5">
                                  <div class="card-header">
                                      <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                  </div>
                                  <div class="card-body">
                                      <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                      <form>
                                          <div class="form-floating mb-3">
                                              <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                              <label for="inputEmail">Email address</label>
                                          </div>
                                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                              <a class="small" href="<?php base_url() ?>login">Return to login</a>
                                              <button type="submit" name="pass_change" class="btn btn-primary">Reset Password</button>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="card-footer text-center py-3">
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