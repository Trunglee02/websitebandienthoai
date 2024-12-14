<?php
if (isset($_GET['keyword'])) {
    $query = "SELECT * FROM brands WHERE status=1 AND name LIKE '%" . $_GET['keyword'] . "%'";
    $result=$connect->query($query);
}
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=brand"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a></h1>
</div>
<div class="col-4"><a href="?option=brandadd" class="btn btn-success">Thêm thương hiệu</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên thương hiệu</th>
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
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=brandupdate&id=<?=$item['id']?>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="?option=brand&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
