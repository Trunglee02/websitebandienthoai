<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $users=$connect->query("select*from member where id=$id");
        if(mysqli_num_rows($users)!=0){
            $connect->query("delete from member where id=$id");
        }
    }
?>
<?php
    $query="select*from member";
    $result=$connect->query($query);
?>
<div class="col-3 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
</div>
<div class="col-6">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" onsubmit="return validateSearch()">
        <div class="input-group" style="border: 2px solid; border-radius: 8px;">
            <input type="hidden" name="option" value="usersearch">
            <input type="text" name="keyword" class="form-control bg-light border-0 small" autocomplete="off" style="border-radius: 8px;" placeholder="Tìm kiếm..."
                aria-label="Search" aria-describedby="basic-addon2">
                <button class="input-group-text">
                    <i class="fas fa-search fa-sm"></i>
                </button>
        </div>
    </form>
</div>
<div class="col-3" style="padding-left: 80px;"><a href="?option=useradd" class="btn btn-success">Thêm người dùng</a></div>
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
