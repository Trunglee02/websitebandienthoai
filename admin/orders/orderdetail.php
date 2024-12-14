<?php
    if(isset($_POST['status'])){
        $connect->query("update orders set status=".$_POST['status'].", updatedate=NOW() where id=".$_GET['id']);
        echo"<script>location='?option=order&status=1';</script>";
    }
?>
<?php
    $query="select a.username,a.mobile as 'mobilemember',a.email as 'emailmember',b.*,c.name as 'nameordermethod' from member 
    a join orders b on a.id=b.memberid join ordermethod c on b.ordermethodid=c.id where b.id=".$_GET['id'];
    $order=mysqli_fetch_array($connect->query($query));  
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <a href="?option=order&status=<?= $_GET['status'] ?>"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> 
    <h1 class="h3 mb-0 text-gray-800">CHI TIẾT ĐƠN HÀNG<br> (Mã đơn hàng: #<?=$order['id']?>)</h1>
</div>
<h3 class="mt-4">Thông tin người dùng</h3>
<table class="table">
    <tbody>
        <tr>
            <td>Tên khách hàng: </td>
            <td><?=$order['username']?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?=$order['mobilemember']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?=$order['emailmember']?></td>
        </tr>
        <tr>
            <td>Ngày đặt: </td>
            <td><?=$order['orderdate']?></td>
        </tr>
    </tbody>
</table>
<h3 class="mt-4">Thông tin nhận hàng</h3>
<table class="table">
    <tbody>
        <tr>
            <td>Tên người nhận: </td>
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
            <td>Note: </td>
            <td><?=$order['note']?></td>
        </tr>
        <tr>
            <td>Phương thức thanh toán: </td>
            <td><?=$order['nameordermethod']?></td>
        </tr>
    </tbody>
</table>
<?php
    $query="select b.number,b.price,c.name,c.image from orders a join orderdetail
    b on a.id=b.orderid join products c on b.productid=c.id where a.id=".$order['id'];
    $orderdetails=$connect->query($query);
?>
<form method="post">
    <h3 class="mt-4">Các sản phẩm đặt mua</h3>
    <?php $count=1;?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalOrder=0;
            ?>
            <?php foreach($orderdetails as $item): ?>
                <tr>
                    <td><?=$count++?></td>
                    <td><?=$item['name']?></td>
                    <td width="20%"><img src="../images/<?=$item['image']?>" width="50%"></td>
                    <td><?=number_format($item['price'],0,',','.')?> đ</td>
                    <td><?=$item['number']?></td>
                    <td><?=number_format($subtotalOrder=$item['price']*$item['number'],0,',','.')?> đ</td>
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
    <h3 class="mt-4">Trạng thái đơn hàng</h3>
    <p style="display: <?=$order['status']==2 || $order['status']==3?'none':''?>"><input type="radio" name="status" value="1" <?=$order['status']==1?'checked':''?>> Chưa xử lý</p>
    <p style="display: <?=$order['status']==3?'none':''?>"><input type="radio" name="status" value="2" <?=$order['status']==2?'checked':''?>> Đang xử lý</p>
    <p><input type="radio" name="status" value="3" <?=$order['status']==3?'checked':''?>> Đã xử lý</p>
    <p style="display: <?=$order['status']==3?'none':''?>"><input type="radio" name="status" value="4" <?=$order['status']==4?'checked':''?>> Hủy</p>
    <section><input <?=$order['status']==3?'disabled':''?> type="submit" value="Cập nhật" class="btn btn-primary"></section>
</form>