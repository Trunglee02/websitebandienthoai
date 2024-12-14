<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from comment where id=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("delete from comment where id=$id");
        }
    }
?>
<?php
  $query = "SELECT 
  comment.id, 
  COALESCE(member.username, 'Guest') AS username, 
  comment.content, 
  comment.date, 
  CASE 
      WHEN comment.memberid = 0 THEN comment.email 
      ELSE member.email 
  END AS email, 
  comment.status, 
  CASE 
      WHEN comment.productid = 0 THEN 'Trang liên hệ' 
      ELSE products.name 
  END AS product_name, 
  comment.date 
FROM comment 
LEFT JOIN member ON comment.memberid = member.id 
LEFT JOIN products ON comment.productid = products.id";

$result = $connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bình luận</h1>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Người gửi</th>
            <th>Nội dung</th>
            <th>Ngày</th>
            <th>Nơi gửi</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Thực thi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$item['id']?></td>
                <td><?=$item['username']?></td>
                <td><?=$item['content']?></td>
                <td><?=$item['date']?></td>
                <td><?=$item['product_name']?></td>
                <td><?=$item['email']?></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td style="width: 10%;"><a class="btn btn-sm btn-primary" href="?option=commentupdate&id=<?=$item['id']?>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="?option=comment&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>