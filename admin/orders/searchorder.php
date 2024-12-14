<?php
if (isset($_GET['keyword']) && isset($_GET['status'])) {
    $status=$_GET['status'];
    $query = "
    SELECT c.id, c.orderdate, c.name, c.address, c.status, 
           SUM(b.price * b.number) AS total_price,
           m.username
    FROM orderdetail b 
    JOIN orders c ON b.orderid = c.id 
    JOIN member m ON c.memberid = m.id 
    WHERE c.status = $status AND c.id LIKE '%" . $_GET['keyword'] . "%'
    GROUP BY c.id, c.orderdate, c.status, m.username
    ";
    $result=$connect->query($query);
}
?>
<div class="col-3 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=order&status=<?=$status?>"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a></h1>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Cập nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['orderdate']?></td>
                <td><?=$item['username']?></td>
                <td><?=$item['address']?></td>
                <td><?= number_format($item['total_price'], 0, ',', '.') ?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=orderdetail&id=<?=$item['id']?>">Chi tiết</a>
                <a style="display: <?=$status==4?'':'none'?>" class="btn btn-sm btn-danger" href="?option=order&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>