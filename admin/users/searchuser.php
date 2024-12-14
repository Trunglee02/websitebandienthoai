<?php
if (isset($_GET['keyword'])) {
    $query = "SELECT * FROM member WHERE status=1 AND username LIKE '%" . $_GET['keyword'] . "%'";
    $result=$connect->query($query);
}
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=user"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a></h1>
</div>
<div class="col-4" style="padding-left: 80px;"><a href="?option=useradd" class="btn btn-success">Thêm người dùng</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên tài khoản</th>
            <th>Ngày tham gia</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Thực thi</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['username']?></td>
                <td><?=$item['creatdate']?></td>
                <td><?=$item['mobile']?></td>
                <td><?=$item['email']?></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=userupdate&id=<?=$item['id']?>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="?option=user&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
