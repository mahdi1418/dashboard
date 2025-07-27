<?php
require_once 'create-tables.php';
function db_conn()
{
    global $config;
    $conn = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['name']);
    if ($conn) {
        return $conn;
    } else {
        return false;
    }
}
$conn = db_conn();
function db_insert($table_name , $input_array = array()){
    $connection = db_conn();
    $keys_string = '';
    $values_string = '';
    $array_length = count($input_array);
    $i = 1;

    foreach($input_array as $key => $value){
        $keys_string .= "`$key`";
        $values_string .= "'$value'";

        if($i < $array_length){
            $keys_string.= ',';  
            $values_string .= ',';  
        }
        $i++;
    }

    $sql = "INSERT INTO `$table_name` ($keys_string) VALUES ($values_string)";
    $result = mysqli_query($connection,$sql);
    return $result;
}



function db_delete($table_name, $input_array)
{
    $connection = db_conn();
    $where_string = '';

    $array_length = count($input_array);
    $i = 1;

    foreach ($input_array as $key => $value) {
        $where_string .= "$key='$value'";

        if ($i < $array_length) {
            $where_string .= ' AND ';
        }
        $i++;
    }

    $sql = "DELETE FROM $table_name WHERE $where_string";
    $result = mysqli_query($connection, $sql);
    return $result;
}
function db_select($sql)
{
    $connection = db_conn();
    $result = mysqli_query($connection, $sql);
    $output = mysqli_fetch_all($result);
    return $output;
}

function db_select_one($sql)
{
    $conn = db_conn();
    $result = mysqli_query($conn, $sql);
    $output = mysqli_fetch_row($result);
    return $output;
}
