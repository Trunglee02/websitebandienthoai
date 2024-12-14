<?php
// Retrieve the current settings
$settings_result = $connect->query("SELECT * FROM setting WHERE id = 1");
$settings = $settings_result->fetch_assoc();
?>
<div class="container py-3">
    <div class="row">
        <div class="col-md-3">
            <a href="?option=home">
                <img src="images/<?= $settings['logo'] ?>" class="img-fluid" style="padding-top: 10px;" alt="Logo">
            </a>
        </div>
        <div class="col-md-5 position-relative">
            <form class="input-group mt-2" onsubmit="return validateSearch()">
                <input type="hidden" name="option" value="showproducts">
                <input type="search" name="keyword" class="form-control" placeholder="Bạn đang tìm?" autocomplete="off" onfocus="showSearchHistory()">
                <button class="input-group-text" id="basic-addon2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="search-history"></div>
        </div>
        <style>
            input[type="search"]:focus {
                outline: none;
                box-shadow: none;
                border: 1px solid #ccc;
            }

            .search-history {
                position: absolute;
                z-index: 1000;
                background: #fff;
                width: 87%;
                display: none;
                margin-top: 8px;
                border-radius: 5px;
                border: 1px solid transparent;
            }
            .search-history.show {
                border: 1px solid #ccc;
            }
            .search-history::after {
                content: "";
                position: absolute;
                top: -10px;
                left: 10px;
                width: 0;
                height: 0;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-bottom: 10px solid transparent;
            }
            .search-history.show::after {
                border-bottom-color: #ccc;
            }

            .search-history-item {
                padding: 8px;
                cursor: pointer;
            }
            .search-history-item:hover {
                background: #f0f0f0;
            }

            .clear-history { 
                display: flex;
                justify-content: space-between;
                padding: 8px;
                cursor: pointer;
                color: gray; 
            } 
            .clear-history:hover { 
                background: #f0f0f0; 
            }
            .clear-history span {
                flex-grow: 1;
            }
            .clear-history i {
                margin-left: 10px;
            }
        </style>
        <script>
            function validateSearch() {
                const keyword = document.querySelector('input[name="keyword"]').value;
                if (keyword.trim() === '') {
                    alert('Vui lòng nhập từ khóa tìm kiếm');
                    return false;
                }
                saveSearchHistory(keyword);
                hideSearchHistory();
                return true;
            }

            function saveSearchHistory(keyword) {
                let searchHistory = JSON.parse(localStorage.getItem('searchHistory')) || [];
                if (!searchHistory.includes(keyword)) {
                    searchHistory.push(keyword);
                    localStorage.setItem('searchHistory', JSON.stringify(searchHistory));
                }
            }

            function showSearchHistory() {
                const searchHistory = JSON.parse(localStorage.getItem('searchHistory')) || [];
                const historyContainer = document.querySelector('.search-history');
                historyContainer.innerHTML = '';

                if (searchHistory.length > 0) {
                    const clearHistoryButton = document.createElement('div');
                    clearHistoryButton.className = 'clear-history';
                    clearHistoryButton.innerHTML = '<span>Lịch sử tìm kiếm</span> <i class="fas fa-times" style="margin-top:3px"></i>';
                    clearHistoryButton.onclick = clearSearchHistory;
                    historyContainer.appendChild(clearHistoryButton);

                    searchHistory.forEach(keyword => {
                        const item = document.createElement('div');
                        item.className = 'search-history-item';
                        item.textContent = keyword;
                        item.onclick = () => {
                            document.querySelector('input[name="keyword"]').value = keyword;
                            hideSearchHistory();
                        };
                        historyContainer.appendChild(item);
                    });

                    historyContainer.classList.add('show');
                } else {
                    historyContainer.classList.remove('show');
                }

                historyContainer.style.display = 'block';
            }

            function clearSearchHistory() { 
                localStorage.removeItem('searchHistory'); 
                hideSearchHistory(); 
            }
            
            function hideSearchHistory() {
                const historyContainer = document.querySelector('.search-history');
                historyContainer.style.display = 'none';
                historyContainer.classList.remove('show');
                historyContainer.style.border = '1px solid transparent'; // Ẩn mũi tên bằng cách đặt viền trong suốt
            }

            document.addEventListener('click', (event) => {
                const searchBox = document.querySelector('input[name="keyword"]');
                const historyContainer = document.querySelector('.search-history');
                if (!searchBox.contains(event.target) && !historyContainer.contains(event.target)) {
                    hideSearchHistory();
                }
            });
        </script>
        <div class="col-md-3">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <div class="fs-3 text-danger">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>
                        <div class="col-9">
                            Tư vấn<br>
                            <a href="tel:+84889502728" class="text-danger text-decoration-none"><strong>0889502728</strong></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <div class="fs-3 text-danger">
                                <i class="fa-regular fa-circle-user"></i>
                            </div>
                        </div>
                        <div class="col-9" style="white-space: nowrap;">
                            Xin chào<br>
                            <?php if (isset($_SESSION['member']) && isset($_SESSION['member']['lastname'])) : ?>
                                <section>
                                    <a href="?option=history" style="color: red; text-decoration: none">
                                        <span><?php echo $_SESSION['member']['lastname']; ?></span>
                                    </a>
                                </section>
                            <?php else : ?>
                                <a href="?option=signin" class="text-danger text-decoration-none"><strong>Đăng nhập</strong></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 text-cart">
            <div class="icon-cart">
                <a href="?option=cart" class="position-relative">
                    <span class="fs-3"><i class="fa-solid fa-cart-shopping" style="color: #606060;"></i></span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $_SESSION['total_items'] ?? 0; ?>
                    </span>
                </a>
            </div>
            <div class="bbb">
                Giỏ hàng
            </div>
        </div>
    </div>
</div>
