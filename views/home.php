<?php
    $option = 'home';
    $query = "select * from products where status=1";
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $productsperpage = 10;
    $from = ($page - 1) * $productsperpage;
    $totalProducts = $connect->query($query);
    $totalPages = ceil(mysqli_num_rows($totalProducts) / $productsperpage);
    $query .= " limit $from, $productsperpage";
    $result = $connect->query($query);
?>

<section class="mymaincontent">
    <div class="btn-zalo-chat id_ZL">
        <a id="btnZaloChat" target="_blank" rel="noopener nofollow" href="https://zalo.me/0969674755">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/2048px-Icon_of_Zalo.svg.png" width="45" height="45">
        </a>              
    </div>
</section>

<section class="mymaincontent">
    <div class="btn-facebook-chat id_FB">
        <a id="btnFacebookChat" target="_blank" rel="noopener nofollow" href="https://www.facebook.com/trunglee008">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/1024px-2023_Facebook_icon.svg.png" width="45" height="45">
        </a>              
    </div>
</section>

<?php
    $query = "select * from imagebanner where bannerid=1";
    $imageslide = $connect->query($query);
?>

<div class="container">
    <div class="slider mb-3">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < $imageslide->num_rows; $i++): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="<?= $i == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $i + 1 ?>"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner">
                <?php $isFirst = true; ?>
                <?php while ($row = $imageslide->fetch_assoc()): ?>
                    <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                        <img src="images/<?= $row['image'] ?>" alt="...">
                    </div>
                    <?php $isFirst = false; ?>
                <?php endwhile; ?>
            </div>
            <style> 
            .carousel-item img { 
                width: 100%; 
                height: 250px; 
                object-fit: cover; 
            }
            </style>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <?php
        $query = "select * from imagebanner where bannerid=2";
        $image = $connect->query($query);
    ?>
    <div class="cate-list mb-3">
        <div class="row">
            <div class="large-12 columns">
                <div class="owl-carousel owl-theme">
                <?php foreach ($image as $item): ?>
                <div class="item">
                    <div class="category-icon">
                        <img src="images/<?= $item['image'] ?>" alt="img-fluid">
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-gallery-one py-3">
    <div class="container">
        <div class="product-gallery-one-content">
            <div class="row product-gallery-one-content-title">
                <div class="col-md-4">
                    <h4>ĐIỆN THOẠI NỔI BẬT</h4>
                </div>
                <div class="title-menu col-md-8 text-end">
                    <a href="?option=showproducts&brandid=1">Iphone</a>
                    <a href="?option=showproducts&brandid=2">Samsung</a>
                    <a href="?option=showproducts&brandid=3">Xiaomi</a>
                    <a href="?option=showproducts&brandid=4">OPPO</a>
                    <a href="?option=mobile">Xem tất cả</a>
                </div>
            </div>
            <div class="product-gallery-one-content-product">
                <?php foreach ($result as $item): ?>
                <div class="product-gallery-one-content-product-item">
                    <a href="?option=productdetail&id=<?= $item['id'] ?>">
                        <img class="product-image" src="images/<?= $item['image'] ?>" alt="">
                        <?php if ($item['price'] > 0 && !empty($item['price'])): ?>
                            <span class="discount-badge">Giảm <?= number_format(($item['price'] - $item['discount']) / $item['price'] * 100, 0) ?>%</span>
                        <?php endif; ?>
                    </a>
                    <div class="product-gallery-one-content-product-item-text">
                        <li><?= $item['name'] ?></li>
                        <li><?= number_format($item['discount'], 0, ',', '.') ?>đ</li>
                        <?php if ($item['price'] > 0 && !empty($item['price'])): ?>
                            <li><?= number_format($item['price'], 0, ',', '.') ?>đ</li>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <style>
        .pagination .page-item.highlight .page-link {
            color: red;
        }
        </style>
        <nav aria-label="Page navigation example">
            <ul class="pagination" style="justify-content: center; margin-top: 5px">
                <!-- Link đến trang trước -->
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?option=<?= $option ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                $maxPagesToShow = 3;
                $startPage = max(1, $page - floor($maxPagesToShow / 2));
                $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
                if ($endPage - $startPage < $maxPagesToShow - 1) {
                    $startPage = max(1, $endPage - $maxPagesToShow + 1);
                }
                ?>

                <!-- Các liên kết trang -->
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'highlight' : '' ?>">
                        <a class="page-link" href="?option=<?= $option ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Link đến trang sau -->
                <li class="page-item <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?option=<?= $option ?>&page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>
