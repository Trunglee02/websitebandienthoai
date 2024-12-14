<?php
if (isset($_GET['keyword'])) {
    $query = "SELECT * FROM products WHERE status=1 AND name LIKE '%" . $_GET['keyword'] . "%'";
    $result=$connect->query($query);
}
?>
<div class="col-9 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=product"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a></h1>
</div>
<div class="col-3"><a href="?option=productadd" class="btn btn-success">Thêm sản phẩm</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Thực thi</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['name']?></td>
                <td><?=number_format($item['price_original'],0,',','.')?></td>
                <td><?=number_format($item['discount'],0,',','.')?></td>
                <td width="20%"><img src="../images/<?=$item['image']?>" width="50%"></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=productupdate&id=<?=$item['id']?>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>