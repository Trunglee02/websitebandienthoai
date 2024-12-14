<?php
if (isset($_GET['brandid'])) {
    $query = "SELECT * FROM products WHERE status=1 AND brandid=" . $_GET['brandid'];
    $result = $connect->query($query);
} elseif (isset($_GET['keyword'])) {
    $query = "SELECT * FROM products WHERE status=1 AND name LIKE '%" . $_GET['keyword'] . "%'";
    $result = $connect->query($query);
} elseif (isset($_GET['fromprice'])) {
    $query = "SELECT * FROM products WHERE status=1 AND discount >= " . $_GET['fromprice'] . " AND discount < " . $_GET['toprice'];
    $result = $connect->query($query);
} elseif (isset($_GET['range'])) {
    $query = "SELECT * FROM products WHERE status=1 AND discount <= " . $_GET['range'];
    $result = $connect->query($query);
} elseif (isset($_GET['desc'])) {
    $query = "SELECT * FROM products WHERE status=1 ORDER BY discount DESC";
    $result = $connect->query($query);
} elseif (isset($_GET['asc'])) {
    $query = "SELECT * FROM products WHERE status=1 ORDER BY discount ASC";
    $result = $connect->query($query);
} elseif (isset($_GET['sale'])) {
    $query = "SELECT id, name, image, price, discount, ((price - discount) / price) * 100 AS discount_percentage FROM products WHERE status = 1 ORDER BY discount_percentage DESC";
    $result = $connect->query($query);
} elseif (isset($_GET['new'])) {
    $query = "SELECT * FROM products WHERE status = 1 ORDER BY creatdate DESC";
    $result = $connect->query($query);
}

if (isset($_GET['brandid'])) {
    $query = "SELECT * FROM brands WHERE id=" . $_GET['brandid'];
    $result_brand = $connect->query($query);
    $brandname = mysqli_fetch_array($result_brand);
}
$brands = $connect->query("SELECT * FROM brands");

?>

<section class="product-gallery-one py-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'; " aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>
                <?php if (isset($_GET['brandid'])) { ?>
                    <li class="breadcrumb-item"><a href="?option=mobile" style="text-decoration: none; color: black">Điện thoại</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $brandname['name'] ?></li>
                <?php } elseif (isset($_GET['keyword'])) { ?>
                    <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm cho "<?= $_GET['keyword'] ?>"</li>
                <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page">Điện thoại</li>
                <?php } ?>
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

    const filterButtons = document.querySelectorAll('.filter-button');
    // Tạo một object để lưu trữ trạng thái của các tùy chọn
    const optionStates = {};
    filterButtons.forEach(button => {
        const filterId = button.dataset.filter;
        optionStates[filterId] = false; // Khởi tạo trạng thái đóng cho tất cả các tùy chọn
        button.addEventListener('click', () => {
            const options = document.getElementById(`${filterId}Options`);

            // Đảo ngược trạng thái của tùy chọn
            optionStates[filterId] = !optionStates[filterId];

            // Đóng tất cả các tùy chọn khác
            const allOptions = document.querySelectorAll('.filter-options');
            allOptions.forEach(option => {
                option.classList.remove('show');
            });

            // Mở tùy chọn hiện tại nếu trạng thái là mở
            if (optionStates[filterId]) {
                options.classList.add('show');
            }
        });
    });
});

</script>