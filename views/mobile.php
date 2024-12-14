<?php
 $option = 'mobile';
 $query = "select * from products where status=1";
 $page = isset($_GET['page']) ? $_GET['page'] : 1;
 $productsperpage = 10;
 $from = ($page - 1) * $productsperpage;
 $totalProducts = $connect->query($query);
 $totalPages = ceil(mysqli_num_rows($totalProducts) / $productsperpage);
 $query .= " limit $from, $productsperpage";
 $result = $connect->query($query);
?>
<?php
    $brands=$connect->query("select*from brands where status");
?>
<section class="product-gallery-one py-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Điện thoại</li>
            </ol>
        </nav>

        <?php
        $query = "SELECT * FROM imagebanner WHERE bannerid=2";
        $image = $connect->query($query);
        ?>
        <div class="cate-list mb-3">
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme filter">
                        <?php foreach ($image as $item) : ?>
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

        <h6>Lọc sản phẩm</h6>
        <div class="filter-button-group">
            <div class="brandFilter">
                <button class="filter-button" data-filter="brand">Hãng <i class="fas fa-angle-down ms-1"></i></button>
                <div class="filter-options" id="brandOptions">
                    <?php foreach ($brands as $item) : ?>
                        <p>
                            <a href="?option=showproducts&brandid=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="priceFilter">
                <button class="filter-button" data-filter="price">Giá <i class="fas fa-angle-down ms-1"></i></button>
                <div class="filter-options" id="priceOptions">
                    <section>
                        <form class="custom-width" style="width: 196px">
                            <input type="hidden" name="option" value="showproducts">
                            <span>0đ</span>
                            <input type="range" name="range" min="500000" max="100000000" step="500000" oninput="document.getElementById('max').innerHTML = parseInt(this.value).toLocaleString('vi-VN') + 'đ';" value="<?= isset($_GET['range']) ? $_GET['range'] : 100000000 ?>">
                            <span id="max"><?= isset($_GET['range']) ? number_format($_GET['range'], 0, ',', '.') . 'đ' : "100.000.000đ" ?></span><br>
                            <input type="submit" value="Áp dụng">
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <h6 class="mt-2">Sắp xếp theo</h6>
        <div class="arrange mb-3">
            <a href="?option=showproducts&desc">Giá cao - Thấp</a>
            <a href="?option=showproducts&asc">Giá thấp - Cao</a>
            <a href="?option=showproducts&sale">Giảm giá</a>
            <a href="?option=showproducts&new">Mới nhất</a>
        </div>
        <div class="product-gallery-one-content">
            <div class="product-gallery-one-content-product">
                <?php foreach ($result as $item) : ?>
                    <div class="product-gallery-one-content-product-item">
                        <a href="?option=productdetail&id=<?= $item['id'] ?>">
                            <img class="product-image" src="images/<?= $item['image'] ?>" alt="">
                            <?php if ($item['price'] > 0 && !empty($item['price'])) : ?>
                                <span class="discount-badge">Giảm <?= number_format(($item['price'] - $item['discount']) / $item['price'] * 100, 0) ?>%</span>
                            <?php endif; ?>
                        </a>
                        <div class="product-gallery-one-content-product-item-text">
                            <li><?= $item['name'] ?></li>
                            <li><?= number_format($item['discount'], 0, ',', '.') ?>đ</li>
                            <?php if ($item['price'] > 0 && !empty($item['price'])) : ?>
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
        <!-- Pagination section -->
        <nav aria-label="Page navigation example">
            <ul class="pagination" style="justify-content: center; margin-top: 5px">
                <!-- Link to previous page -->
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

                <!-- Page links -->
                <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'highlight' : '' ?>">
                        <a class="page-link" href="?option=<?= $option ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Link to next page -->
                <li class="page-item <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?option=<?= $option ?>&page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var rangeInput = document.querySelector('input[type="range"][name="range"]');
        var maxSpan = document.getElementById('max');
        
        // Thiết lập giá trị ban đầu của thanh trượt
        if (!rangeInput.value || rangeInput.value === "0") {
            rangeInput.value = 100000000; // Giá trị mặc định là 100 triệu nếu không có giá trị range được thiết lập
        }
        maxSpan.innerHTML = parseInt(rangeInput.value).toLocaleString('vi-VN') + 'đ';

        // Cập nhật giá trị khi người dùng thay đổi thanh trượt
        rangeInput.addEventListener('input', function() {
            maxSpan.innerHTML = parseInt(this.value).toLocaleString('vi-VN') + 'đ';
        });
    });
    const filterButtons = document.querySelectorAll('.filter-button');
    const optionStates = {};
    filterButtons.forEach(button => {
        const filterId = button.dataset.filter;
        optionStates[filterId] = false;
        button.addEventListener('click', () => {
            const options = document.getElementById(`${filterId}Options`);

            optionStates[filterId] = !optionStates[filterId];

            const allOptions = document.querySelectorAll('.filter-options');
            allOptions.forEach(option => {
                option.classList.remove('show');
            });

            if (optionStates[filterId]) {
                options.classList.add('show');
            }
        });
    });
</script>
