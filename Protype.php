<?php
session_start();
// --------------Factory----------
require 'models/FactoryPattent.php';
$factory = new FactoryPattent();
$protypeModel = $factory->make('home');
$productModel = $factory->make('home');
// --------------Factory----------

$proty = $protypeModel->getProtype();

if (isset($_GET['type_id'])) {
    $typeid = $_GET['type_id'];
    // $protype = $protypeModel->getprotypeOnProduct($typeid);
}
$search  = '';
$searchCate  = '';
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include_once("views/head.php"); ?>

<body>

    <!--================Main Header Area =================-->
    <?php include_once("views/header.php"); ?>
    <!--================End Main Header Area =================-->
    <?php


    ?>
    <!--================End Main Header Area =================-->
    <section class="banner_area">
        <div class="container">
            <div class="banner_text">
                <h3>Thể loại</h3>
                <ul>
                    <li><a href="index.php">Nhà</a></li>
                    <li><a href="shop.php">Cửu tiệm</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Main Header Area =================-->
    <?php if (isset($_GET['type_id'])) { ?>
        <!--================Product Area =================-->
        <section class="product_area p_100">
            <div class="container">
                <div class="row product_inner_row">
                    <div class="col-lg-9">
                        <!-- </?php if ($protype) { ?> -->
                        <input type="hidden" name="type_id" value="<?php echo $typeid ?>">
                        <div class="row m0 product_task_bar">
                            <div class="product_task_inner">
                                <div class="float-left">

                                </div>
                                <div class="float-right">
                                    <h4>Thể loại</h4>

                                </div>
                            </div>
                        </div>
                        <!-- Tien lam phan trang -->
                        <?php
                        if (isset($_GET['submit'])) {
                            // search categories
                            if (!empty($_GET['search-cate'])) {
                                ?>
                                <div class="row product_item_inner">
                                    <?php
                                    $searchCate = $_GET['search-cate'];
                                    $products = $productModel->searchCategories($searchCate);
                                    $num_result_cate = count($products);
                                    foreach ($products as $product) { ?>
                                        <div class="col-lg-4 col-md-4 col-6">
                                            <div class="cake_feature_item">
                                                <div class="cake_img">
                                                    <img src="<?= $product['pro_image'] ?>" alt="">
                                                    <?php if (isset($_SESSION['lgUserID'])) { ?>
                                                        <?php if (empty($productModel->getWhishlistExist($_SESSION['lgUserID'], $product['id']))) { ?>
                                                            <div class="icon-whishlist">
                                                                <a href="shop.php?id=<?= md5($product['id'] . 'chuyen-de-web-2') ?>">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                    <?php }
                                                    } ?>
                                                </div>
                                                <div class="cake_text">
                                                    <h4>$<?= $product['price'] ?></h4>
                                                    <h3><?= $product['name'] ?></h3>
                                                    <a class="pest_btn" href="cart.php?id=<?= $product['id'] ?>" onclick="return insertCart(<?= $product['id'] ?>)">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <!-- Phân trang -->
                                <?php
                                $number_of_pages = ceil($num_result_cate / 6);
                                if ($number_of_pages > 1) { ?>
                                    <div class="product_pagination">
                                        <div class="left_btn">
                                        </div>
                                        <div class="middle_list">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <?php
                                                    for ($i = 1; $i <= $number_of_pages; $i++) {
                                                    ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="shop.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="right_btn">
                                        </div>
                                    </div>
                            <?php }
                            }
                        } else { ?>

                            <div class="row product_item_inner">

                                <?php
                                $products = $productModel->paginationProtype($typeid, $page, 6);
                                if (count($products) > 0) {

                                    foreach ($products as $product) { ?>
                                        <div class="col-lg-4 col-md-4 col-6">
                                            <div class="cake_feature_item">
                                                <div class="cake_img">
                                                    <img src="<?= $product['pro_image'] ?>" alt="">
                                                    <?php if (isset($_SESSION['lgUserID'])) { ?>
                                                        <?php if (empty($productModel->getWhishlistExist($_SESSION['lgUserID'], $product['id']))) { ?>
                                                            <div class="icon-whishlist">
                                                                <a href="shop.php?id=<?= md5($product['id'] . 'chuyen-de-web-2') ?>">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                    <?php }
                                                    } ?>
                                                </div>
                                                <div class="cake_text">
                                                    <h4>$<?= $product['price'] ?></h4>
                                                    <h3><?= $product['name'] ?></h3>
                                                    <a class="pest_btn" href="cart.php?id=<?= $product['id'] ?>" onclick="return insertCart(<?= $product['id'] ?>)">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>


                            </div>
                            <!-- Phân trang -->
                            <?php
                            $result = $productModel->getprotypeOnProduct($typeid);
                            $number_of_result = count($result);
                            $number_of_pages = ceil($number_of_result / 6);
                            if ($number_of_pages <= 1) { ?>
                            <?php } else { ?>
                                <div class="product_pagination">
                                    <div class="left_btn">
                                        <a href="Protype.php?type_id=<?php echo $typeid; ?>&page=<?php if ($page > 1) echo $page - 1;
                                                                    else echo 1 ?>">
                                            <i class="lnr lnr-arrow-left"></i> Trước
                                        </a>
                                    </div>
                                    <div class="middle_list">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <?php
                                                for ($i = 1; $i <= $number_of_pages; $i++) {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="Protype.php?type_id=<?php echo $typeid; ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="right_btn">
                                        <a href="Protype.php?type_id=<?php echo $typeid; ?>&page=<?php if ($page < $number_of_pages) echo $page + 1;
                                                                    else echo $number_of_pages ?>">
                                            Sau <i class="lnr lnr-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php  } ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3">
                        <div class="product_left_sidebar">
                            <aside class="left_sidebar search_widget">
                                <form method="get" class="input-group">
                                    <input type="hidden" name="type_id" value="<?php echo $typeid ?>">
                                    <input type="text" name="search-cate" value="<?= $searchCate ?>" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" name="submit" value="submit"><i class="icon icon-Search"></i></button>
                                    </div>
                                </form>
                            </aside>
                            <aside class="left_sidebar p_catgories_widget">
                                <div class="p_w_title">
                                    <h3>Danh mục sản phẩm</h3>
                                </div>
                                <?php
                                $manufactures = $protypeModel->getManufactures();

                                ?>
                                <ul class="list_style">
                                    <?php foreach ($manufactures as $manufacture) { ?>
                                        <li><a href="manufacture-shop.php?manu_id=<?= md5($manufacture['manu_id'] . 'chuyen-de-web-2') ?>"><?= $manufacture['manu_name'] ?>
                                                (<?= count($protypeModel->countProductWithManufacture($manufacture['manu_id'])) ?>)</a></li>
                                    <?php } ?>

                                </ul>
                            </aside>

                            <aside class="left_sidebar p_sale_widget">
                                <div class="p_w_title">
                                    <h3>Sản phẩm mới nhất</h3>
                                </div>
                                <?php
                                $latests = $protypeModel->getProductLasters();

                                ?>
                                <?php
                                if (!empty($latests)) {
                                    foreach ($latests as $latest) {

                                ?>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="<?= $latest['pro_image'] ?>" alt="<?= $latest['name'] ?>" style="max-width: 100px;">
                                            </div>
                                            <div class="media-body">
                                                <a href="product-details.php?id=<?= md5($latest['id'] . 'chuyen-de-web-2') ?>">
                                                    <h4><?= $latest['name'] ?></h4>
                                                </a>

                                                <h5>$<?= $latest['price'] ?></h5>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <?php include "404.php"; ?>
    <?php } ?>
    <!--================End Product Area =================-->

    <!--================Newsletter Area =================-->
    <?php include_once("views/layouts/news.php"); ?>
    <!--================End Newsletter Area =================-->

    <!--================Footer Area =================-->
    <?php include_once("views/layouts/footer.php"); ?>
    <!--================End Footer Area =================-->


    <!--================Search Box Area =================-->
    <?php include_once("views/layouts/search.php"); ?>
    <!--================End Search Box Area =================-->





    <?php include_once("views/footer.php"); ?>
</body>

</html>