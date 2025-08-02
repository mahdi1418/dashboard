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
    $category = "SELECT * FROM `category`";
    $cate = db_select($category);

    $sql = "SELECT * FROM `users` WHERE `user_id` = '$userNumber'";
    $output2 = db_select_one($sql);
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'recent') {
            $sort = "`create_date` DESC";
        } else if ($sort == 'price_asc') {
            $sort = "`price` ASC";
        } else if ($sort == 'price_desc') {
            $sort = "`price` DESC";
        } else {
            $sort = "`create_date` DESC";
        }
        $update = mysqli_query($conn, "UPDATE `users` SET `sort`= '$sort' WHERE `user_id` = '$userNumber'");
    } else {
        $sort = $output2['7'];
    }

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if ($category == "all") {
            $check = mysqli_query($conn, "SELECT * FROM `products` ORDER BY $sort");
        } else {
            $check = mysqli_query($conn, "SELECT * FROM `products` WHERE  `category` = '$category' ORDER BY $sort");
        }
        $num_rows = mysqli_num_rows($check);
        $output = mysqli_fetch_all($check, MYSQLI_NUM);
    } else {
        $check = mysqli_query($conn, "SELECT * FROM `products` ORDER BY $sort");
        $num_rows = mysqli_num_rows($check);
        $output = mysqli_fetch_all($check, MYSQLI_NUM);
        $category = "";
    }
    ?>

 <body class="sb-nav-fixed">
     <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
         <a class="navbar-brand ps-3" href="<?php base_url() ?>panel">Dashboard</a>
         <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
         <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
             <div class="input-group">
                 <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                 <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
             </div>
         </form>
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
         <div id="layoutSidenav_content" class="p-4 position-absolute w-100 justify-content-start" style="right: 0; ">
             <!-- 🔍 Filter Bar -->
             <div class="row mb-2 d-flex justify-content-end">
                 <div class="col-md-4 mb-2 mb-md-0 position-relative" id="pro_search">
                     <input id="pro_serach" type="text" class="form-control" placeholder="Find a product...">
                     <ul id="res_search"></ul>
                 </div>
                 <div class="col-md-6 d-flex justify-content-md-end flex-wrap gap-2 align-items-center">
                     <div>Category :</div>
                     <div class="custom-select">
                         <div class="select-btn"> <?php
                                                    echo $category;
                                                    if (mb_strlen($category, 'UTF-8') < 1) {
                                                        echo "all";
                                                    } ?></div>
                         <div class="select-options">
                             <a class="dropdown-item" href="<?php echo $config['base_url']; ?>/products?category=all">all</a>

                             <?php foreach ($cate as $item) { ?>
                                 <a class="dropdown-item" href="<?php echo $config['base_url']; ?>/products?category=<?php echo $item[1]; ?>"><?php echo $item[1]; ?></a>
                             <?php } ?>
                         </div>
                     </div>
                     <div>sort by:</div>
                     <div class="custom-select">
                         <div class="select-btn"> <?php
                                                    if ($sort == "`create_date` DESC") {
                                                        $sort = "Recent";
                                                    } else if ($sort == "`price` ASC") {
                                                        $sort = "cheapest";
                                                    } else if ($sort == "`price` DESC") {
                                                        $sort = "Expensive";
                                                    } else {
                                                        $sort = "Recent";
                                                    }
                                                    echo $sort; ?></div>
                         <div class="select-options">
                             <a class="dropdown-item" href="<?php echo $config['base_url']; ?>/products?sort=recent">Recent</a>
                             <a class="dropdown-item" href="<?php echo $config['base_url']; ?>/products?sort=price_desc">Expensive</a>
                             <a class="dropdown-item" href="<?php echo $config['base_url']; ?>/products?sort=price_asc">cheapest</a>
                         </div>
                     </div>
                     <a type="button" href="<?php base_url() ?>product" class="btn btn-success">New</a>

                 </div>
             </div>

             <div class="container-fluid px-4 me-0" style="width: 85%;" id="productList">
                 <?php
                    for ($i = 0; $i < $num_rows; $i++) {
                        for ($j = 0; $j < 7; $j++) {
                            $out[$i][$j] = $output[$i][$j];
                        } ?>
                     <div class="repo-item col-md-12 d-flex justify-content-between">
                         <div class="d-flex">
                             <div class="swiper Slider" style="width: 80px;">
                                 <div class="swiper-wrapper">
                                     <?php
                                        $pro = $out[$i][0];
                                        $sql = "SELECT * FROM `images` WHERE `product_id` = '$pro'";
                                        $out_img = db_select($sql);
                                        foreach ($out_img as $item) { ?>
                                         <div class="swiper-slide"><img src="<?php echo base_url() . '/uploads/' . $item['1']; ?>" width="60px" height="60px" style="border-radius: 50%;"></div>
                                     <?php
                                        }
                                        ?>
                                 </div>
                             </div>
                             <div>
                                 <a href="#" class="repo-title"><?php echo $out[$i][1]; ?></a><br>
                                 <span class="dot dot-php"></span> <?php echo $out[$i][2]; ?>
                             </div>
                         </div>
                         <div class="d-flex align-items-center">
                             <div class="info">
                                 <h5 class="m-0 mb-1 text-danger"><?php echo $out[$i][3]; ?>$</h5>
                                 <h6 class="m-0"> <?php echo $out[$i][4]; ?></h6>
                             </div>
                             <p class="d-flex align-items-center m-0 ms-3 <?php if (strlen($out[$i][6]) < 10) echo "me-4"; ?> text-secondary"><?php echo $out[$i][6]; ?> </p>

                             <div class="delete ms-2">
                                 <input type="hidden" id="proid" value="<?php echo $out[$i][0]; ?>">
                                 <a type="submit" class="btn btn-danger" href="<?php base_url() ?>handle.php?type=pro_delete&ipd=<?php echo $out[$i][0]; ?>">Delete</a>
                                 <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#imageModal" data-product-id="<?php echo $out[$i][0]; ?>">Add images</button>
                             </div>
                             <form action="handle.php" method="POST" class="align-items-center justify-content-end <?php echo 'order' . $out[$i][0]; ?>" style="display: none;">
                                 <input type="number" class="form-control w-50 qtyInput" name="qty" min="1" placeholder="0">
                                 <input type="hidden" name="order" id="<?php echo 'order' . $out[$i][0]; ?>" value="">
                                 <input type="hidden" name="pid" value="<?php echo $out[$i][0]; ?>">
                                 <button type="submit" class="btn btn-primary" name="order_submit">add to cart</button>
                             </form>

                             <button class="btn p-0 ms-2 d-flex gap-10 align-items-center" id="order<?php echo $out[$i][0]; ?>">
                                 <i class="fas fa-plus plus d-flex align-items-center" style="width: 50px; height: 50px; padding-left: 17.5px;"></i>
                             </button>
                             <i class="fas fa-ellipsis-v px-3 py-2 pe-1 pt-2"></i>
                         </div>
                     </div>
                 <?php }
                    ?>
             </div>
         </div>
     </div>
     </div>





     <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="imageModalLabel">Upload Image</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <form method="post" action="handle.php" enctype="multipart/form-data">
                         <div class="mb-3">
                             <label for="imageInput" class="form-label">Select Image</label>
                             <input type="file" class="form-control" id="imageInput" name="pro_image" required>
                             <input type="hidden" id="productIdInput" name="product_id" value="">
                         </div>
                         <button type="submit" name="img_pro_upload" class="btn btn-primary">Upload</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <script>
         document.addEventListener("DOMContentLoaded", function() {
             const pro_search = document.getElementById('pro_search');
             if (pro_search && !pro_search.contains(event.target)) {
                 const items = pro_search.querySelectorAll('li');
                 items.forEach(li => {
                     li.style.display = 'none';
                 });
             }
         });
         var imageModal = document.getElementById('imageModal');
         imageModal.addEventListener('show.bs.modal', function(event) {
             var button = event.relatedTarget;
             var productId = button.getAttribute('data-product-id');

             var input = imageModal.querySelector('#productIdInput');
             input.value = productId;
         });
     </script>
     <?php
        require_once 'footer.php';
        ?>