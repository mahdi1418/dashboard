<?php
require_once "loader.php";
global $base_url;
session_start();
session_unset();
session_destroy();
header("Location:$base_url/login");
exit;
