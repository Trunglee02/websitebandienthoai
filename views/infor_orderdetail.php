<?php
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $query_order = "
        SELECT o.id, o.orderdate, o.name, o.mobile, o.email, 
               o.address, o.note, om.name as nameordermethod 
        FROM orders o 
        JOIN ordermethod om ON o.ordermethodid = om.id 
        WHERE o.id = $orderid
    ";
    $order = mysqli_fetch_array($connect->query($query_order));
    
    $query_order_detail = "
        SELECT b.*, a.name AS productname, a.image 
        FROM orderdetail b 
        JOIN products a ON b.productid = a.id 
        WHERE b.orderid = $orderid
    ";
    $result_order_detail = $connect->query($query_order_detail);
}
?>
<div class="d-flex align-items-center mt-4 ml-2"> 
    <a href="?option=history" class="d-flex align-items-center text-decoration-none"> 
        <i class="fas fa-chevron-left" style="font-size: 20px; color:gray"></i> 
        <span class="ms-2 fw-bold text-secondary fs-6">Quay lại</span> 
    </a> 
</div>
<h3 class="mt-3">Chi tiết đơn hàng #<?= $orderid ?></h3>
<?php $count=1;?>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalOrder=0;
        ?>
        <?php foreach ($result_order_detail as $detail): ?>
            <tr>
                <td><?=$count++?></td>
                <td width="50%"> <img src="images/<?=$detail['image']?>" width="20%"><?= $detail['productname'] ?></td>
                <td><?= $detail['number'] ?></td>
                <td><?= number_format($detail['price'], 0, ',', '.') ?> ₫</td>
                <td><?= number_format($subtotalOrder=$detail['price'] * $detail['number'], 0, ',', '.') ?> ₫</td>
            </tr>
            <?php $totalOrder+=$subtotalOrder;?>
        <?php endforeach; ?>
            <tr>
                <td colspan="6">
                    <section  class="text-end mb-3">Tổng tiền: <?=number_format($totalOrder,0,',','.')?> đ</section>
                </td>
            </tr>
    </tbody>
</table>
<h3 class="mt-4">Thông tin nhận hàng</h3>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?=$order['name']?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?=$order['mobile']?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?=$order['address']?></td>
        </tr>
            <td>Email: </td>
            <td><?=$order['email']?></td>
        </tr>
        <tr>
            <td>Ghi chú: </td>
            <td><?=$order['note']?></td>
        </tr>
        <tr>
            <td>Phương thức thanh toán: </td>
            <td><?=$order['nameordermethod']?></td>
        </tr>
    </tbody>
</table>

