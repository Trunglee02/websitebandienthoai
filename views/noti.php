<style>
.container {
    max-width: 1000px;
    margin: auto;
}

.job-listings {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: space-between;
    margin: 45px 0px;
}

.job-listing {
    border: 1px solid #ddd;
    padding: 15px;
    width: calc(33% - 8px); /* Adjust the width accordingly */
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 5px;
}

.job-listing .header {
    display: flex;
    align-items: center;
}

.job-listing .hot {
    display: inline-block;
    background-color: #ff6f61;
    color: #fff;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 12px;
    margin-right: 10px;
}

.job-listing h3 {
    margin: 0;
    font-size: 16px;
    color: #333;
    flex: 1;
}

.job-listing .details {
    flex-direction: row;
    justify-content: space-between;
    margin: 10px 0;
}

.job-listing .details p {
    margin: 0;
    font-size: 14px;
    color: #666;
    flex: 1; /* Ensure each detail takes equal space */
}

.job-listing p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

.job-listing a {
    display: inline-block;
    text-decoration: none;
    color: #007bff;
    margin-top: 10px;
}
</style>
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tuyển dụng</li>
        </ol>
    </nav>
    <div class="job-listings" style="margin-bottom: 150px">
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Nhân Viên Thu Ngân</h3>
            </div>
            <div class="details">
                <p class="location">Hồ Chí Minh</p>
                <p class="quantity">SL: 2</p>
            </div>
            <p class="salary">Từ 7 - 10 Triệu</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Nhân Viên Tư Vấn Bán Hàng</h3>
            </div>
            <div class="details">
                <p class="location">Hồ Chí Minh</p>
                <p class="quantity">SL: 5</p>
            </div>
            <p class="salary">Từ 9 - 12 Triệu</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Quản Lý Cửa Hàng</h3>
            </div>
            <div class="details">
                <p class="location">Hà Nội</p>
                <p class="quantity">SL: 1</p>
            </div>
            <p class="salary">Từ 12 - 18 Triệu</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Kỹ Thuật Viên Sửa Và Thay Thế Linh Kiện</h3>
            </div>
            <div class="details">
                <p class="location">Hà Nội</p>
                <p class="quantity">SL: 2</p>
            </div>
            <p class="salary">Lương: Thỏa thuận</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Bảo Vệ Cửa Hàng</h3>
            </div>
            <div class="details">
                <p class="location">Hà Nội</p>
                <p class="quantity">SL: 2</p>
            </div>
            <p class="salary">Từ 5 - 7 triệu</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
        <div class="job-listing">
            <div class="header">
                <span class="hot">HOT</span>
                <h3>Nhân viên Giao Nhận Kho</h3>
            </div>
            <div class="details">
                <p class="location">Hà Nội</p>
                <p class="quantity">SL: 3</p>
            </div>
            <p class="salary">Từ 9 - 12 Triệu</p>
            <a href="?option=dang-xay-dung" class="apply">Ứng tuyển</a>
        </div>
    </div>
</div>
