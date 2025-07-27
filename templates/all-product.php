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

    $check = mysqli_query($conn, "SELECT * FROM `products` WHERE `user_id` = '$userNumber'");
    $num_rows = mysqli_num_rows($check);
    $output = mysqli_fetch_all($check, MYSQLI_NUM);
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
                     <li><a class="dropdown-item" href="">Settings</a></li>
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
                         <a class="nav-link" href="<?php base_url() ?>panel">
                             <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                             Dashboard
                         </a>
                         <div class="sb-sidenav-menu-heading">users</div>
                         <a class="nav-link collapsed" href="<?php base_url() ?>users">
                             <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                             users
                             <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                         </a>
                         <a class="nav-link collapsed" href="<?php base_url() ?>products">
                             <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                             products
                             <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                         </a>
                         <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                             <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                             orders
                             <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                         </a>
                     </div>
                 </div>

             </nav>
         </div>
         <div id="result" class="position-absolute" style="right: 50%; top: 150px; transform: translateX(50%);">
         </div>
         <!-- 🧾 Content Area -->
         <div id="layoutSidenav_content" class="p-4 position-absolute w-100 justify-content-start" style="right: 0; ">
             <!-- 🔍 Filter Bar -->
            <div class="row mb-4 d-flex justify-content-end">
                 <div class="col-md-4 mb-2 mb-md-0 position-relative" id="pro_search">
                     <input id="pro_serach" type="text" class="form-control" placeholder="Find a product...">
                     <ul id="res_search"></ul>
                 </div>
                 <div class="col-md-6 d-flex justify-content-md-end flex-wrap gap-2">
                     <select class="form-select w-auto">
                         <option>Category</option>
                     </select>
                     <select class="form-select w-auto">
                         <option>Language</option>
                     </select>
                     <select class="form-select w-auto">
                         <option>Sort</option>
                     </select>
                     <button class="btn btn-success" onclick="openModal()">New</button>
                 </div>
            </div>

             <div class="container-fluid px-4 me-0" style="width: 85%;" id="productList">
                 <?php
                    for ($i = 0; $i < $num_rows; $i++) {
                        for ($j = 0; $j < 6; $j++) {
                            $out[$i][$j] = $output[$i][$j];
                        } ?>
                     <div class="repo-item col-md-12 d-flex justify-content-between">
                         <div>
                             <a href="#" class="repo-title"><?php echo $out[$i][1]; ?></a><br>
                             <span class="dot dot-php"></span> <?php echo $out[$i][2]; ?>
                         </div>
                         <div class="d-flex">
                             <div class="info">
                                 <h5 class="m-0 mb-1 text-danger"><?php echo $out[$i][3]; ?> $</h5>
                                 <h6 class="m-0"> <?php echo $out[$i][4]; ?></h6>
                             </div>
                             <div class="delete ms-2 mt-2">
                                 <a href="<?php echo $config['base_url']; ?>/handle.php?pro_id=<?php echo $out[$i][0];?>&type=delete" class="btn btn-danger" id="delete">Delete</a>
                             </div>
                             <i class="fas fa-ellipsis-v px-3 py-2 pe-1 pt-2 mt-2"></i>
                         </div>
                     </div>
                 <?php }
                    ?>
             </div>
         </div>
     </div>
     </div>







     <form method="post" id="add_product">
         <div class="modal" id="proModal">
             <div class="modal-content">
                 <h3 style="color:#0d6efd;text-align:center;">add product</h3>
                 <input type="text" placeholder="title" id="add_title_product" required>
                 <input type="text" placeholder="description" id="add_desc_product" required>
                 <input type="number" step="0.01" min="0" placeholder="price" id="add_price_product" required>
                 <button type="submit" name="submit-task">add</button>
             </div>
         </div>
     </form>

     <?php
        require_once 'footer.php';
        ?>