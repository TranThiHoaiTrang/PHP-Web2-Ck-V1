<?php
require_once '../../models/ProductModel.php';

$productModel = new ProductModel();
$user = NULL; //Add new user
$id = NULL;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $id_start = substr($id,3);
    $id_end=substr($id_start,0,-3);
    $productModel->deleteProduct($id_end);//Delete existing user
}
header('location: trash.php');