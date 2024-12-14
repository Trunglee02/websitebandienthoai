<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $imagebanner=$connect->query("select * from imagebanner where id=$id");
        if(mysqli_num_rows($imagebanner) != 0){
            $connect->query("delete from imagebanner where id=$id");
        }
    }
?>
<?php
    $query="select a.name, a.id, b.id as 'imageid', b.image, b.status, b.bannerid from imagebanner b join banner a on a.id=b.bannerid";
    $result=$connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ảnh banner</h1>
</div>
<div class="col-4" style="padding-left: 70px;"><a href="?option=banneradd" class="btn btn-success">Thêm banner</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Loại banner</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Thực thi</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1; ?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['imageid']?></td>
                <td><?=$item['name']?></td>
                <td width="20%"><img src="../images/<?=$item['image']?>" width="50%"></td>
                <td><?=$item['status'] == 1 ? 'Hoạt động' : 'Khóa'?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="?option=bannerupdate&id=<?=$item['imageid']?>">Sửa</a>
                    <a class="btn btn-sm btn-danger" href="?option=banner&id=<?=$item['imageid']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
