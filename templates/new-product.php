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

$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$userNumber'";
$output2 = db_select_one($sql2);

$check = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `create_date` DESC");
$num_rows = mysqli_num_rows($check);
$output = mysqli_fetch_all($check, MYSQLI_NUM);

$category = "SELECT * FROM `category`";
$cate = db_select($category);
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

        <div id="result" class="position-absolute" style="right: 50%; top: 150px; transform: translateX(50%);">
        </div>
        <!-- 🧾 Content Area -->
        <div id="layoutSidenav_content" class="p-4 position-absolute w-100 justify-content-start mt-5" style="right: 0; text-align: -webkit-center; width: 85% !important">
            <form method="post" id="add_product">
                <h3 style="color:#0d6efd;text-align:center;">add product</h3>

                <div class="modal-content" style="text-align: left;">
                    <label for="add_title_product" class="form-label ms-2">title</label>
                    <input type="text" placeholder="title" id="add_title_product" required>
                    <label for="add_desc_product" class="form-label ms-2">desc</label>
                    <input type="text" placeholder="description" id="add_desc_product" required>
                    <label for="add_price_product" class="form-label ms-2">price</label>
                    <input type="number" step="0.01" min="0" placeholder="price" id="add_price_product" required>
                    <label for="category" class="form-label ms-2">category</label>
                    <select name="category" id="category" class="form-select" required>
                        <?php
                        foreach ($cate as $item) { ?>
                            <option value="<?php echo $item[1] ?>"><?php echo $item[1] ?></option>
                        <?php }
                        ?>
                    </select>
                    <button type="submit" name="submit-task">add</button>
                </div>
                <!-- </div> -->
            </form>

        </div>
    </div>
    <?php
    require_once 'footer.php';
    ?>