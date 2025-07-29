<?php
require_once "loader.php";
$conn = db_conn();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['type']) && $_POST['type'] === 'register') {
    if (empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['name']) || empty($_POST['name2']) || empty($_POST['pass2'])) {
        $error = 'please fill out all fields';
        echo json_encode($error);
    } else {
        $name = $_POST['name'];
        $name2 = $_POST['name2'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        if ($pass != $pass2) {
            $error = 'Passwords do not match.';
            echo json_encode($error);
        } else {
            $check = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
            if (mysqli_num_rows($check) > 0) {
                $error = 'Email is already registered.';
                echo json_encode($error);
            } else {
                $password = md5($pass2);

                $insert = mysqli_query($conn, "INSERT INTO `users` (`name`,`last_name`,`email`,`password`) VALUES ('$name','$name2','$email','$password')");
                $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

                if ($insert) {
                    $msql = mysqli_query(db_conn(), $sql);
                    $user = mysqli_fetch_assoc($msql);
                    $_SESSION['user'] = $user['user_id'];
                    $success = 'registered successfully';
                    echo json_encode(['message' => $success]);
                } else {
                    $error = 'Registration failed. Please try again.';
                    echo json_encode(['message' => $error]);
                }
            }
        }
    }
} else if (isset($_POST['type']) && $_POST['type'] === 'login') {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = 'please fill out all fields';
        echo json_encode($error);
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pass = md5($password);
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = db_select($sql);
        if ($result) {
            $msql = mysqli_query(db_conn(), $sql);
            $user = mysqli_fetch_assoc($msql);
            $_SESSION['user'] = $user['user_id'];
            $success = "you are logged in, going to panel";
            echo json_encode($success);
        } else {
            $error = "email or password is wrong!";
            echo json_encode($error);
        }
    }
} else if (isset($_POST['type']) && $_POST['type'] === 'add_pro') {
    $conn = db_conn();
    $userNumber = $_SESSION['user'];
    $title = $_POST['add_title_product'];
    $desc = $_POST['add_desc_product'];
    $price = $_POST['add_price_product'];
    $category = $_POST['category'];
    $data = [
        'title' => $title,
        'desc' => $desc,
        'price' => $price,
        'user_id' => $userNumber,
        'category' => $category
    ];

    $insert = db_insert('products', $data);
    if ($insert) {
        echo json_encode([
            'title' => $title,
            'desc' => $desc,
            'price' => $price,
            'category' => $category
        ]);
    } else {
        $error = 'Added product failed. Please try again.';
        echo json_encode($error);
    }
} else if (isset($_POST['type']) && $_POST['type'] === 'delete') {
    $conn = db_conn();
    $id = $_POST['proid'];
    $userNumber = $_SESSION['user'];

    $success = mysqli_query($conn, "DELETE FROM `products` WHERE `product_id` = '$id' AND `user_id` = '$userNumber'");
    if($success){
        $success = "success";
    }else{
        $success = "not done";
    }
} else if (isset($_POST['word']) && isset($_POST['type'])) {
    if ($_POST['type'] == 'pro') {
        $word = $_POST['word'];
        $sql = "SELECT * FROM `products` WHERE `title` LIKE '$word%'";
        $text = mysqli_query($conn, $sql);
        if (mysqli_num_rows($text) > 0) {
            $output = db_select($sql);
?>
            <?php foreach ($output as $item): ?>
                <li>
                    <div>
                        <p class="m-0 h4"><?= $item[1] ?></p>
                        <p class="m-0"><?= $item[2] ?></p>
                    </div>
                    <p class="m-0 h6 text-danger mt-4"><?= $item[3] ?>$</p>
                </li>
            <?php endforeach; ?>
<?php
        }
    }
} else if (isset($_POST['edit_user'])) {
    $conn = db_conn();
    $userNumber = $_SESSION['user'];
    $tempFile = $_FILES['files']['tmp_name'];
    $folder = 'uploads/';
    $new_name = 'file_' . time() . '.png';
    $status = move_uploaded_file($tempFile, $folder . $new_name);

    $name = $_POST['userName'];
    $lastname = $_POST['userlName'];
    $email = $_POST['userEmail'];

    $update = mysqli_query($conn, "UPDATE `users` SET `name`='$name',`last_name`='$lastname',`email`='$email',`file`= '$new_name' WHERE `users`.`user_id` = '$userNumber'");
    if ($update) {
        header("location:$base_url/panel");
        exit;
    } else {
        header("location:$base_url/panel");
        exit;
    }
} else if (isset($_POST['img_pro_upload'])) {
    $conn = db_conn();
    $userNumber = $_SESSION['user'];
    $tempFile = $_FILES['pro_image']['tmp_name'];
    $folder = 'uploads/';
    $new_name = 'file_' . time() . '.png';
    $status = move_uploaded_file($tempFile, $folder . $new_name);

    $proid = $_POST['product_id'];
    $data = [
        'pro_image' => $new_name,
        'product_id' => $proid
    ];

    $insert = db_insert('image_pro', $data);
    if ($insert) {
        header("location:$base_url/products");
        exit;
    }
} else {
    $error = "Something went wrong, try again later.";
    echo json_encode($error);
}
