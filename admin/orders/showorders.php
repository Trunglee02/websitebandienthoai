<?php
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $connect->query("delete from orderdetail where orderid=$id");
    $connect->query("delete from orders where id=$id");
    echo"<script>location='?option=order&status=4';</script>";
    }
?>
<?php
    $status=$_GET['status'];
    $query = "
    SELECT c.id, c.orderdate, c.name, c.address, c.status, 
           SUM(b.price * b.number) AS total_price,
           m.username
    FROM orderdetail b 
    JOIN orders c ON b.orderid = c.id 
    JOIN member m ON c.memberid = m.id 
    WHERE c.status = $status 
    GROUP BY c.id, c.orderdate, c.status, m.username
    ";
    $result=$connect->query($query);
?>
<?php
    $option = 'order&status=' . $status;
    $page=1; //xem các sản phẩm ở trang số bnhieu
    if(isset($_GET['page'])){
        $page=$_GET['page'];       
    }
    //số lượng sản phẩm muốn để mỗi trang
    $productsperpage=10;
    //lấy các sản phẩm bắt đầu từ chỉ số bn trong bảng(0 là bắt đầu từ bản ghi đầu tiên)
    $from=($page-1)*$productsperpage;
    //lấy tổng số sản phẩm
    $totalProducts=$connect->query($query);
    //tính tổng số trang có được
    $totalPages=ceil(mysqli_num_rows($totalProducts)/$productsperpage);
    //lấy các sản phẩm ở trang hiện thời
    $query.= " limit $from,$productsperpage";
    $result=$connect->query($query);
?>
<div class="col-6 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Đơn hàng <?=$status==1?'chưa xử lý':($status==2?'đang xử lý':($status==3?'đã xử lý':'hủy'))?></h1>
</div>
<div class="col-6">
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="?option=ordersearch" method="GET" onsubmit="return validateSearch()">
    <input type="hidden" name="option" value="ordersearch">
    <input type="hidden" name="status" value="<?=$status?>">
    <div class="input-group" style="border: 2px solid; border-radius: 8px;">
        <input type="text" name="keyword" class="form-control bg-light border-0 small" autocomplete="off" style="border-radius: 8px;" placeholder="Tìm kiếm..."
            aria-label="Search" aria-describedby="basic-addon2">
        <button class="input-group-text">
            <i class="fas fa-search fa-sm"></i>
        </button>
    </div>
</form>

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
        <?php $count= $from + 1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['orderdate']?></td>
                <td><?=$item['username']?></td>
                <td><?=$item['address']?></td>
                <td><?= number_format($item['total_price'], 0, ',', '.') ?> đ</td>
                <td><a class="btn btn-sm btn-primary" href="?option=orderdetail&status=<?=$status?>&id=<?=$item['id']?>">Chi tiết</a>
                <a style="display: <?=$status==4?'':'none'?>" class="btn btn-sm btn-danger" href="?option=order&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<section class="pages text-center mb-3">
    <span class="text-secondary">Trang </span>
    <?php for($i=1; $i<=$totalPages;$i++):?>
        <a class="<?=(empty($_GET['page'])&&$i==1)||(isset($_GET['page'])&&$_GET['page']==$i)?'underline':''?>" 
        href="?option=<?=$option?>&page=<?=$i?>"><?=$i?></a>
    <?php endfor;?>
</section>
<script>
    function validateSearch() {
        const keyword = document.querySelector('input[name="keyword"]').value;
        if (keyword.trim() === '') {
            alert('Vui lòng nhập từ khóa tìm kiếm');
            return false; // Ngăn chặn gửi form
        }
        saveSearchHistory(keyword);
        hideSearchHistory();
        return true; // Cho phép gửi form
    }
</script>