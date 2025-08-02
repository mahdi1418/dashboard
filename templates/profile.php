<?php
require_once 'loader.php';
require_once 'header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("location:$base_url/login");
}
$userNumber = $_SESSION['user'];

$sql = "SELECT * FROM `users` WHERE `user_id` = '$userNumber'";
$output2 = db_select_one($sql);

?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php base_url() ?>panel">Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div id="photo"><img src="<?php echo base_url() . '/uploads/' . $output2['5']; ?>"></div>
                    <i class="fas fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php base_url() ?>profile">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php base_url() ?>logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php base_url() ?>users">all users</a>
                                <a class="nav-link" href="<?php base_url() ?>user">new user</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="<?php base_url() ?>products">
                                    all products
                                </a>
                                <a class="nav-link collapsed" href="<?php base_url() ?>product">
                                    add new product
                                </a>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseCategory" aria-expanded="false" aria-controls="pagesCollapseCategory">
                                    Category
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php base_url() ?>category#category_list">all Categories </a>
                                        <a class="nav-link" href="<?php base_url() ?>category#cate">add new Category</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            orders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php base_url() ?>orders">all order</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    <div class="d-flex" style="margin-left: 400px; margin-top: 100px; gap:90px">

        <div class="modal-content">
            <form id="editUserForm" action="handle.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title me-1" id="editUserModalLabel"> profile </h3>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">name</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="<?php echo $output2['1']; ?>" value="<?php echo $output2['1']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="form-label">last name</label>
                        <input type="text" class="form-control" id="userName" name="userlName" placeholder="<?php echo $output2['2']; ?>" value="<?php echo $output2['2']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="<?php echo $output2['3']; ?>" value="<?php echo $output2['3']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">image</label>
                        <input type="file" class="form-control" id="userfile" name="files" value="<?php echo $output2['5']; ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="edit_user">save</button>
                </div>
            </form>
        </div>
        <div class="text-center">
            <img src="<?php echo base_url() . '/uploads/' . $output2[5] ?>" width="125px" height="125px" style="border-radius: 50%;">
            <div class="d-flex text-center mt-4">
                <h3 class="me-2"><?= $output2[1] ?></h3>
                <h3><?= $output2[2] ?></h3>
            </div>
            <h5 class="text-center mb-3 text-secondary"><?= $output2[3] ?></h5>
        </div>
    </div>
    </div>

    <?php
    require_once 'footer.php';
    ?>