<?php
    if (isset($_SESSION['member']) && isset($_SESSION['member']['username'])) {
        // Lấy thông tin từ mảng $_SESSION['member']
        $username = $_SESSION['member']['username'];
        $query = "SELECT * FROM member WHERE username = '$username'";
        $member = mysqli_fetch_array($connect->query($query));
    }
?>
<?php
    $memberid = $member['id'];
    $query = "
        SELECT c.id, c.orderdate, c.status, 
               SUM(b.price * b.number) AS total_price 
        FROM orderdetail b 
        JOIN orders c ON b.orderid = c.id 
        WHERE c.memberid = $memberid 
        GROUP BY c.id, c.orderdate, c.status
    ";
    $result_order = $connect->query($query);
?>
<div id="content">
    <div id="orders" class="section active">
        <h5 class="mt-3">Đơn hàng</h5>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Ngày đặt</th>
                        <th>Trạng Thái</th>
                        <th>Tổng tiền</th>
                        <th>Đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result_order as $item): ?>
                    <tr>
                        <td>#<?= $item['id'] ?></td>
                        <td><?= $item['orderdate'] ?></td>
                        <td><?= $item['status'] == 1 ? 'Chưa xử lý' : ($item['status'] == 2 ? 'Đang xử lý' : ($item['status'] == 3 ? 'Đã xử lý' : 'Đã hủy')) ?></td>
                        <td><?= number_format($item['total_price'], 0, ',', '.') ?> ₫</td>
                        <td><a href="?option=history&infor=1&orderid=<?= $item['id'] ?>">Xem chi tiết</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
