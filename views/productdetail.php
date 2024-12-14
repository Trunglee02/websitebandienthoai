<?php
    if(isset($_POST['content'])): 
        $content=$_POST['content'];
        if(isset($_SESSION['member']) && isset($_SESSION['member']['username'])):
            $productid=$_GET['id'];
            $username = $_SESSION['member']['username'];
			$memberData = mysqli_fetch_array($connect->query("SELECT id, email FROM member WHERE username='$username'"));
            $memberid=$memberData['id'];
			$email = $memberData['email'];
            $connect->query("insert comment(memberid,productid,date,content,email) values($memberid,$productid,now(),'$content','$email')");
            echo"<script>alert('Cảm ơn bạn đã bình luận sản phẩm!')</script>";
			echo"<script>location='?option=productdetail&id=$productid';</script>";
			exit();
        endif;
    endif;
?>
<?php
    $id=$_GET['id'];
    $query="select*from products where id=$id";
    $result=$connect->query($query);
    $item=mysqli_fetch_array($result);
?>
<?php
    if(isset($_GET['id'])){
        $query="SELECT p.id, p.brandid, b.id, b.name FROM products p
            JOIN brands b ON p.brandid = b.id
              WHERE p.id=".$_GET['id'];
        $result=$connect->query($query);
        $brand_name=mysqli_fetch_array($result);      
    }
?>
<?php
	$id=$_GET['id'];
	$imagepath=$connect->query("select * from imageproduct where productid=$id");
?>
<div class="container py-3">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>               
        <li class="breadcrumb-item"><a href="?option=mobile" style="text-decoration: none; color: black">Điện thoại</a></li>
        <li class="breadcrumb-item"><a href="?option=showproducts&brandid=<?=$item['brandid']?>" style="text-decoration: none; color: black"><?=$brand_name['name']?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$item['name']?></li>
    </ol>
</nav>
<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<button class="arrow arrow-left" onclick="prevImage()">&#8249;</button> 
						<button class="arrow arrow-right" onclick="nextImage()">&#8250;</button>
						<div class="preview-pic tab-content"> 
							<div class="tab-pane active" id="pic-1"><img src="images/<?=$item['image']?>" id="main-image" onclick="showModal(this.src)"></div>
							<?php foreach($imagepath as $path): ?> 
							<div class="tab-pane" id="pic-<?=$path['id']?>"><img src="images/<?=$path['path']?>" onclick="showModal(this.src)" /></div>
							<?php endforeach; ?> 
						</div> 
						<ul class="preview-thumbnail nav nav-tabs"> 
							<li class="active"><a data-target="#pic-1" style="display:block; border-radius: 8px; border: 1px solid #d8d0d0; width: 80px; height: 80px;" data-toggle="tab"><img src="images/<?=$item['image']?>" style="padding: 5px;" onclick="changeImage('images/<?=$item['image']?>')"></a></li> 
							<?php foreach($imagepath as $path): ?> 
							<li><a data-target="#pic-<?=$path['id']?>" style="display:block; border-radius: 8px; border: 1px solid #d8d0d0; width: 80px; height: 80px;" data-toggle="tab"><img src="images/<?=$path['path']?>" style="padding: 5px;" onclick="changeImage('images/<?=$path['path']?>')"></a></li> 
							<?php endforeach; ?> 
						</ul>
					</div>
					<div class="details col-md-6">
						<h2><section class="name"><?=$item['name']?></section></h2>
						<div class="rating mb-3" style="display: flex">
							<div class="stars" style="color: #FFC803;">
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<div class="review" style="color: gray; margin-left: 23px;">2 đánh giá</div>
						</div>
						<div class='product-price' style="list-style-type: none;">
							<li><?=number_format($item['discount'],0,',','.')?>đ</li>
							<?php if ($item['price'] > 0 && !empty($item['price'])): ?> <li><?=number_format($item['price'],0,',','.')?>đ</li> <?php endif; ?>
						</div> 
						<div class="promotion mt-3">
							<h3>Khuyến mãi</h3>
							<ul>
								<?=$item['description_short']?>
								<!-- <li>
								<i class="far fa-check-circle"></i> Miễn phí vận chuyển
								</li>
								<li>
								<i class="far fa-check-circle"></i> Phiếu mua hàng trị giá 200,000đ
								</li>
								<li>
								<i class="far fa-check-circle"></i> Thu cũ đổi mới giảm thêm đến 2,000,000 (Không kèm ưu đãi thanh toán qua cổng, mua kèm) 
								</li> -->
							</ul>
						</div>
						<div class="button-container container mt-3">
						<div class="row d-flex align-items-stretch">
							<div class="col-8">
								<input type="button" class="btn btn-danger w-100" value="Đặt mua" onclick="location='?option=cart&action=add&id=<?= $item['id'] ?>';">
							</div>
							<div class="col-4">
								<button class="btn btn-outline-danger" onclick="location='?option=cart&action=add&id=<?= $item['id'] ?>';">
									<i class="fas fa-shopping-cart"></i> Thêm vào giỏ
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
			<hr>
			<section class="description"><?=$item['description']?></section>
		
			</div>
		</div>
	</div>
</div>
	<section class="comment mt-3 px-3">
    <h4>Bình luận</h4>
    <form method="post">
        <section>
            <textarea name="content" rows="5" class="form-control" placeholder="Hảy để lại bình luận cho chúng tôi..."></textarea>
            <button type="button" id="checkLoginButton" style="display: none;"></button> </section>
        <section class="text-end"><input type="submit" value="Gửi" class="btn btn-danger mt-2"></section>
    </form>
    <?php
        $comments=$connect->query("select*from member a join comment b on a.id=b.memberid join products c on b.productid=c.id where b.status and productid=".$_GET['id']);
        if(mysqli_num_rows($comments)==0):
            echo"<section style='color:green'>No comments!</section>";
        else:
            foreach($comments as $comment):
    ?>
		<div class="item" style="display: flex;margin-bottom: 20px;">
			<div class="avt" style="width: 40px;height: 40px;border: 1px solid #ccc;border-radius: 50px;background: #f1f1f1;overflow: hidden;">
				<img src="images/no-avt.png" alt="" style="max-width: 100%;"></div>
			<div class="infor" style="margin-left: 15px;">
				<p class="name" style="font-weight: bold;margin-bottom: 0;"><?=$comment['username']?></p>
				<div class="date" style="font-style: italic;color: gray"><?=$comment['date']?></div>
				<div class="content mt-2" style=""><?=$comment['content']?></div>
			</div>
		</div>
    <?php
        endforeach;
        endif;
    ?>
	</section>
</div>      

<!-- Modal to show full-screen image --> 
 <div class="modal fade" id="main-image-modal" tabindex="-1" role="dialog" aria-hidden="true"> 
	<div class="modal-dialog modal-lg"> 
		<div class="modal-content"> 
		<div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			<div class="modal-body"> 
				<img src="" id="main-image-modal-src"> 
			</div> 
		</div> 
	</div> 
</div>
<script> 
	let currentImageIndex = 0; 
	const images = ["images/<?=$item['image']?>", <?php foreach($imagepath as $path) echo "'images/".$path['path']."',"; ?>]; 
	
	function changeImage(src) { 
		document.getElementById('main-image').src = src; 
		currentImageIndex = images.indexOf(src); 
	} 
	
	function prevImage() { 
		if (currentImageIndex > 0) { 
			currentImageIndex--; 
			document.getElementById('main-image').src = images[currentImageIndex]; 
		} 
	} 
	function nextImage() { 
		if (currentImageIndex < images.length - 1) { 
			currentImageIndex++; document.getElementById('main-image').src = images[currentImageIndex]; 
		} 
	} 
	function showModal(src) { 
		document.getElementById('main-image-modal-src').src = src; 
		$('#main-image-modal').modal('show'); 
	} 

    document.querySelector('textarea[name="content"]').addEventListener('click', function() {
        document.getElementById('checkLoginButton').click();
    });
    document.getElementById('checkLoginButton').addEventListener('click', function() {
    if (!<?php echo json_encode(isset($_SESSION['member'])); ?>) {
        alert('Vui lòng đăng nhập để bình luận.');
        window.location.href = '?option=signin&productid=<?php echo $_GET['id']; ?>';
    }
	});   
</script>
