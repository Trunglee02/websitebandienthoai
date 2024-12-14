<?php
// Truy vấn lấy dữ liệu
$query = "SELECT o.id AS order_id, o.orderdate, od.productid, od.price, od.price_original, od.number 
          FROM orders o
          JOIN orderdetail od ON o.id = od.orderid
          WHERE o.status = 3";
$result = $connect->query($query);

// Tạo mảng để lưu dữ liệu
$data = array();

// Lưu dữ liệu vào mảng
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Chuyển đổi dữ liệu thành định dạng JSON và lưu vào file
file_put_contents('data.json', json_encode($data));

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy thời gian hiện tại
$currentDateTime = date('Y-m-d H:i:s');

// Khởi tạo các biến để lưu trữ kết quả
$doanhThuNgay = 0;
$loiNhuanNgay = 0;
$donHangThanhCongNgay = 0;
$donHangDaHuyNgay = 0;

$queryNgay = "SELECT SUM(CASE WHEN o.status = 3 THEN od.price * od.number ELSE 0 END) AS doanhThu, 
    SUM(CASE WHEN o.status = 3 THEN (od.price - od.price_original) * od.number ELSE 0 END) AS loiNhuan, 
    COUNT(DISTINCT CASE WHEN o.status = 3 THEN o.id ELSE NULL END) AS donHangThanhCong, 
    COUNT(DISTINCT CASE WHEN o.status = 4 THEN o.id ELSE NULL END) AS donHangDaHuy 
    FROM orders o JOIN orderdetail od ON o.id = od.orderid WHERE DATE(o.updatedate) = CURDATE()
";
$resultNgay = $connect->query($queryNgay);

// Lưu dữ liệu vào các biến
if ($resultNgay->num_rows > 0) {
    $rowNgay = $resultNgay->fetch_assoc();
    $doanhThuNgay = $rowNgay['doanhThu'];
    $loiNhuanNgay = $rowNgay['loiNhuan'];
    $donHangThanhCongNgay = $rowNgay['donHangThanhCong'];
    $donHangDaHuyNgay = $rowNgay['donHangDaHuy'];
}

// Đóng kết nối
$connect->close();
?>

<div class="card-header py-3 d-flex align-items-center justify-content-between" style="display: flex;word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: .35rem;
    display: flex;
    margin-bottom: 10px;">
        <h6 class="m-0 font-weight-bold text-primary">TỔNG QUAN HÔM NAY</h6>
        <div class="d-flex align-items-center"> 
            <h6 class="me-2 mb-0">Cập nhật gần nhất: <?php echo $currentDateTime; ?></h6> 
            <button class="btn btn-outline-primary" onclick="location.reload()"> <i class="fas fa-sync"></i> </button> 
        </div>
</div>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="margin-top: 0 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doanh thu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($doanhThuNgay, 0, ',', '.'); ?> đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-coins fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="margin-top: 0 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Lợi nhuận</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($loiNhuanNgay, 0, ',', '.'); ?> đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="margin-top: 0 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Đơn hàng thành công</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($donHangThanhCongNgay, 0, ',', '.'); ?> đơn</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2" style="margin-top: 0 !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Đơn hàng đã hủy</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($donHangDaHuyNgay, 0, ',', '.'); ?> đơn</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bar Chart -->
<div class="card shadow mb-4">
    <div class="card-header py-3" style="display: flex">
        <h6 class="m-0 font-weight-bold text-primary" style="color:gray !important">THỐNG KÊ</h6>
    </div>
    <div class="card-body">
        <div class="chart-bar" style="position: relative; height: 350px;">
            <canvas id="myBarChart"></canvas>
        </div>
    </div>
</div>
