<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>asset-spec-hub</title>
    <meta name="description" content="Asset Specification System" />
    <meta name="author" content="RID" />

    <meta property="og:title" content="Asset Specification System" />
    <meta property="og:description" content="Royal Irrigation Department Asset Specification System" />
    <meta property="og:type" content="website" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            overflow-x: hidden;
            width: auto;
            height: auto;
            margin-bottom: 120px;
            margin-top: 80px;
        }

        .navbar {
            z-index: 1051;
            margin-left: 350px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 0px 5px 2px rgba(23, 23, 23, 0.46);
        }

        .btn-login {
            box-shadow: 0px 0px 5px 4px rgba(23, 23, 23, 0.21);
            font-size: 0.85rem;
            padding: 8px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .toggle-btn {
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar {
            background-color: rgb(255, 255, 255);
            width: 350px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease-in-out;
            padding: 1rem;
            box-sizing: border-box;
            z-index: 1051;
            padding-top: 30px;
            box-shadow: 0px 0px 6px 4px rgba(0, 0, 0, 0.23);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            max-width: 200px;
            max-height: 200px;
            display: block;
            margin-bottom: 1rem;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .toggleButton {
            display: none;
        }

        .back-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            display: none;
        }

        .back-btn:hover {
            background: #f0f0f0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back-btn:active {
            transform: scale(0.95);
        }

        .back-btn i {
            font-size: 20px;
            color: #333;
        }

        .menu {
            padding:5px;
            background-color: rgb(243, 243, 243);
            display: flex;
            flex-direction: column;
            width: 100%;
            /* Ensure full width within sidebar */
            overflow-y: auto;
            /* Add scroll for overflow */
            max-height: calc(100vh - 300px);
            /* Limit height to prevent content overflow */
        }

        .menu a {
    
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 12px 16px;
            color: black;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            height: 60px;
            /* Ensures same height for all */
            border-radius: 20px 0px 20px 0px;
            box-shadow: 0px 0px 2px 4px rgba(0, 0, 0, 0.13);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            position: relative;
            margin-bottom: 2px;
            word-break: break-word;
            white-space: normal;
        }

        .menu a i {
            font-size: 1.4rem;
            margin-right: 10px;
            min-width: 24px;
            /* Ensure consistent space for icon */
            flex-shrink: 0;
            /* Prevent icon from shrinking */
            color: inherit;
        }

        .menu a:hover {
            transform: scale(0.99);
            background-color: rgb(246, 247, 247);
        }

        .content {
            margin-left: 350px;
            padding-top: 5rem;
            transition: margin-left 0.3s;
        }

        .content.full {
            margin-left: 0 !important;
        }

        .card {
            width: 100%;
            min-width: 300px;
            max-width: 300px;
            flex: 0 0 auto;
            box-shadow: 0px 0px 10px 0px rgb(207, 207, 207);
            border-radius: 7px;
            overflow: hidden;
            margin: 0 auto 20px;
            cursor: pointer;
        }

        .card:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: end;
            height: 100px;
            color: black;
            font-size: 1.2rem;
            text-align: end;
            padding: 0.5rem;
        }

        .card-body {
            display: flex;
            align-items: center;
            font-size: 1rem;
            height: 60px;
            background-color: #f8f9fa;
            color: #337ab7;
            padding: 0.5rem;
        }

        .card-header img {
            max-width: 100px;
            max-height: 80px;
            filter: invert(0.55);
        }

        .full-page-table {
            height: auto;
            overflow: visible;
        }

        .bg-lightblue {
            background-color: rgb(165, 230, 252) !important;
        }

        thead {
            background-color: #3498db;
            color: white;
        }

        thead th {
            padding: 1rem;
            text-align: center;
        }

        tbody td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }

        .full-page-table {
            height: auto;
            overflow: visible;
        }

        .table-responsive {
            max-height: none;
        }

        .carousel-inner {
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .card-slider {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: nowrap;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            border-radius: 25px;
            margin: 0 10px;
        }

        footer {
            background-color: #171717;
            color: white;
            text-align: right;
            padding: 10px 20px;
            font-weight: bold;
            position: fixed;
            bottom: 0;
            right: 0;
            width: calc(100% - 350px);
            z-index: 1000;
            transition: width 0.3s ease;
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.2);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
            z-index: 5;
        }

        .carousel-indicators {
            bottom: -15px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: rgba(23, 23, 23, 0.2);
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 10;

        }

        .carousel-indicators button {
            width: 5px;
            height: 5px;
            border-radius: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            /* Default inactive color */
            border: none;
            transition: width 0.3s, height 0.3s, background-color 0.3s;
        }

        .carousel-indicators .active {
            width: 13px;
            /* Larger size for active indicator */
            height: 13px;
            background-color: white;
            border-radius: 100%;
        }

        /* Improved responsive rules */
        @media (max-width: 1400px) {
            .navbar {
                margin-left: 0px;
            }

            .card-slider {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
                /* even spacing between cards */
            }

            .sidebar {
                transform: translateX(-100%);
                /* Hide sidebar by default on smaller screens */
            }

            .sidebar.visible {
                transform: translateX(0);
                /* Show sidebar when toggled */
            }

            .toggleButton {
                display: block;
            }

            .back-btn {
                display: flex;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            footer {
                width: 100%;
                /* Full width footer on small screens */
            }

            /* Ensure carousel controls don't overlap with card content */
            #customCarousel {
                padding: 0 40px;
                /* Add side padding to make room for controls */
                position: relative;
            }

            .carousel-control-prev {
                left: 0;
                background: rgba(0, 0, 0, 0.3);
                width: 35px;
                height: 35px;
                top: 50%;
                border-radius: 25px;
                transform: translateY(-50%);
            }

            .carousel-control-next {
                right: 0;
                background: rgba(0, 0, 0, 0.3);
                width: 35px;
                height: 35px;
                top: 50%;
                border-radius: 25px;
                transform: translateY(-50%);
            }

            /* Make cards take up more width on mobile */
            .col-md-3 {
                flex: 0 0 auto;
                width: 90%;
                /* Full width with margin */
                max-width: 300px;
                padding: 0;
                display: flex;
                justify-content: center;
            }

            .carousel-indicators{
                bottom: -35px;
            }
            /* Mobile specific card styling */
            .card {
                width: 100%;
                margin: 0 auto;
            }

            /* Better table layout for mobile */
            .table-responsive table,
            .table-responsive thead,
            .table-responsive tbody,
            .table-responsive th,
            .table-responsive td,
            .table-responsive tr {
                display: block;
            }

            /* Hide table headers on mobile */
            .table-responsive thead {
                display: none;
            }

            /* Style each row as a card */
            .table-responsive tr {
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                background-color: #f9f9f9;
            }

            .table-responsive td {
                text-align: left;
                padding: 10px;
                position: relative;
            }

            /* Add labels before each cell's data */
            .table-responsive td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                color: #3498db;
                margin-bottom: 5px;
            }
        }

        /* Additional media query for very small screens */
        @media (max-width: 767px) {
            .menu a {
                font-size: 0.9rem;
                padding: 10px 12px;
                height: auto;
                min-height: 50px;
            }

            .menu a i {
                font-size: 1.2rem;
                margin-right: 8px;
            }

            .sidebar {
                width: 300px;
            }

            .sidebar img {
                max-width: 150px;
                max-height: 150px;
            }
        }

        /* Fix for overflow text in menu items on smaller screens */
        @media (max-width: 400px) {
            .sidebar {
                width: 280px;
            }

            .menu a {
                font-size: 0.8rem;
                padding: 8px 10px;
                height: auto;
                min-height: 45px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar bg-info fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center p-2" href="/spec">
                <div class="ms-4">
                    <h4 class="text-white mb-0 fw-bold">ระบบเผยแพร่คุณลักษณะเฉพาะครุภัณฑ์</h4>
                    <h5 class="text-white mb-0">(SPECIFICATIONS)</h5>
                </div>
            </a>

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <a href="/spec/login" class="btn btn-login text-white">เข้าสู่ระบบ</a>

                <!-- Toggle Button -->
                <button class="btn btn-light toggle-btn ms-3" type="button" id="toggleButton">
                    <span class="navbar-toggler-icon bi bi-list"></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="row">
        <!-- Sidebar -->
        <div class="sidebar container-fluid col" id="sidebar">
            <!-- Back Button (inside sidebar) -->
            <button class="btn back-btn" id="backButton">
                <i class="bi bi-arrow-left"></i>
            </button>

            <img src="/RID.png" alt="RID Logo" class="" style="max-width: 200px; max-height: 200px;">
            <div class="menu">
                <a href="#" class="show-cards" data-goods-genre="ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร"
                    style="border-left: 5px solid #4caf50;">
                    <i class="bi bi-display"></i> ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักออกแบบวิศวกรรมและสถาปัตยกรรม"
                    style="border-left: 5px solid #7c2ae0;">
                    <i class="bi bi-box"></i> สำนักออกแบบวิศวกรรมและสถาปัตยกรรม
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักเครื่องจักรกล"
                    style="border-left: 5px solid #5bc0de;">
                    <i class="bi bi-gear"></i> สำนักเครื่องจักรกล
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักสำรวจด้านวิศวกรรมและธรณีวิทยา"
                    style="border-left: 5px solid #ff9800;">
                    <i class="bi bi-binoculars"></i> สำนักสำรวจด้านวิศวกรรมและธรณีวิทยา
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักบริหารจัดการน้ำและอุทกวิทยา"
                    style="border-left: 5px solid #ff5722;">
                    <i class="bi bi-droplet"></i> สำนักบริหารจัดการน้ำและอุทกวิทยา
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักวิจัยและพัฒนา"
                    style="border-left: 5px solid #e94b35;">
                    <i class="bi bi-clipboard-data"></i> สำนักวิจัยและพัฒนา
                </a>
                <a href="#" class="show-cards" data-goods-genre="สำนักงานเลขานุการกรม"
                    style="border-left: 5px solid #795548;">
                    <i class="bi bi-briefcase"></i> สำนักงานเลขานุการกรม
                </a>
                <a href="#" class="show-cards" data-goods-genre="all" style="border-left: 5px solid rgb(0, 0, 0);">
                    <i class="bi bi-list"></i> แสดงทั้งหมด
                </a>
            </div>

            <div class="mt-5 ms-2 text-center small">
                © 811 กรมชลประทาน ถ.สามเสน แขวงดุสิต เขตดุสิต กทม. 10300 โทร.02-241-0020 ถึง 29
            </div>
        </div>


        <!-- Main Content -->
        <div class="container-fluid content bg-white col" id="content">

            <div class="container-fluid d-flex justify-content-center align-items-center my-5">
                <div class="row w-100 align-items-center py-4 px-3 border rounded-pill mx-2 shadow-sm"
                    style="border: 1px solid #ccc; background-color: #fdfdfd;">

                    <!-- Search Label -->
                    <div class="col-lg-3 col-md-12 text-center text-lg-end fw-bold mb-2 mb-lg-0">
                        ระบุชื่อครุภัณฑ์ที่สืบค้น
                    </div>

                    <!-- Search Input -->
                    <div class="col-lg-5 col-md-12 mb-2 mb-lg-0">
                        <input class="form-control rounded-3 shadow-sm" id="searchInput" type="text"
                            placeholder="เช่น คอมพิวเตอร์โต๊ะ เป็นต้น" style="border: 1px solid #ddd;">
                    </div>

                    <!-- Buttons -->
                    <div class="col-lg-4 col-md-12 text-center text-lg-start">
                        <button class="btn home-btn fw-bold text-white rounded-2 me-2 mb-2 mb-lg-0"
                            style="background-color: #f0ad4e;">
                            <i class="bi bi-house-door-fill"></i> กลับหน้าหลัก
                        </button>
                        <button class="btn fw-bold text-white rounded-2 px-4 mb-2 mb-lg-0"
                            style="background-color: #5bc0de;">
                            <i class="bi bi-book-half"></i> คู่มือการใช้งาน
                        </button>
                    </div>
                </div>
            </div>


            <div id="customCarousel" class="carousel slide carousel-container" data-bs-interval="false">
                <div class="carousel-inner">
                    <?php
                    // Split posts into groups of 3
                    $chunked_posts = array_chunk($posts, 3);
                    $first = true;

                    foreach ($chunked_posts as $post_group): ?>
                        <div class="carousel-item <?= $first ? 'active' : '' ?>">
                            <div class="row justify-content-center card-slider">
                                <?php foreach ($post_group as $post): ?>
                                    <div class="col-md-3 px-3"> <!-- Reduced padding -->
                                        <div class="card open-card load-items "
                                            style="border-top: 5px solid<?= esc($post['Category_color'] ?? '#000000') ?>;"
                                            data-card-id="<?= esc($post['Category_id']) ?>">
                                            <div class="card-header row">
                                                <img class="col ms-3" src="<?= esc($post['Icon_path'] ?? '') ?>" alt="Icon">
                                                <span class="col me-1 ps-2"><?= esc($post['Category_name']) ?></span>
                                            </div>
                                            <div class="card-body">
                                                <span><?= esc($post['Dep_fullname'] ?? 'Unknown Department') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $first = false; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Navigation Buttons -->
                <button class="carousel-control-prev ms-4" type="button" data-bs-target="#customCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next me-4" type="button" data-bs-target="#customCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
                <div class="carousel-indicators">
                    <?php foreach ($chunked_posts as $index => $post_group): ?>
                        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="<?= $index ?>"
                            class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="full-page-table" style="display:none;">
                <!-- TABLE -->
                <div class="container">
                    <div id="items-table"></div>
                </div>
            </div>
            <footer class="footer">
                <div>Asset Spec System of Royal Irrigation Department</div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Improved debounce utility function
        function debounce(func, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Throttled resize handler (more efficient than debounce for resize)
        function throttle(func, limit) {
            let lastFunc;
            let lastRan;
            return function () {
                const context = this;
                const args = arguments;
                if (!lastRan) {
                    func.apply(context, args);
                    lastRan = Date.now();
                } else {
                    clearTimeout(lastFunc);
                    lastFunc = setTimeout(function () {
                        if ((Date.now() - lastRan) >= limit) {
                            func.apply(context, args);
                            lastRan = Date.now();
                        }
                    }, limit - (Date.now() - lastRan));
                }
            };
        }

        // Improved checks for content overflow
        function checkContentOverflow() {
            // Check if the width is below our breakpoint or if text is overflowing
            const isSmallScreen = window.innerWidth <= 1200;

            // Get the sidebar and content elements
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const navbar = document.querySelector('.navbar');
            const footer = document.querySelector('footer');
            const toggleButton = document.getElementById('toggleButton');
            const tableVisible = document.querySelector('.full-page-table').style.display !== 'none';

            // If small screen or table is visible, collapse sidebar
            if (isSmallScreen || tableVisible) {
                sidebar.classList.remove('visible');
                sidebar.classList.add('hidden');
                content.style.marginLeft = '0';
                navbar.style.marginLeft = '0';
                footer.style.width = '100%';
                toggleButton.style.display = 'block';

                // Hide toggle button when table is visible (card is opened)
                if (tableVisible) {
                    toggleButton.style.display = 'none';
                }
            } else {
                // On larger screens, show sidebar
                sidebar.classList.remove('hidden');
                sidebar.classList.add('visible');
                content.style.marginLeft = '350px';
                navbar.style.marginLeft = '350px';
                footer.style.width = 'calc(100% - 350px)';
                toggleButton.style.display = 'none';
            }
        }

        // ShowTable - Fixed version
        $(document).on('click', '.load-items', function (e) {
            e.preventDefault();

            const button = $(this);
            const Category_id = button.data('card-id');
            const tableContainer = $('.full-page-table');

            // Update layout immediately - hide sidebar and sidebar button
            document.getElementById('sidebar').classList.remove('visible');
            document.getElementById('sidebar').classList.add('hidden');
            document.getElementById('content').style.marginLeft = '0';
            $('.navbar').css('margin-left', '0');
            $('.carousel-container').hide();
            $('.home-btn').show();
            $('footer').css('width', '100%');
            // Hide toggle button when card is opened
            document.getElementById('toggleButton').style.display = 'none';

            button.prop('disabled', true);

            $.ajax({
                url: '/spec/fetchItems/' + Category_id,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    button.prop('disabled', false);

                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    const groupedBySubCategory = {};
                    $.each(response, function (index, equipment) {
                        if (!groupedBySubCategory[equipment.Sub_category_name]) {
                            groupedBySubCategory[equipment.Sub_category_name] = [];
                        }
                        groupedBySubCategory[equipment.Sub_category_name].push(equipment);
                    });

                    let html = '<div class="table-responsive"><table class="table table-bordered table-striped">';
                    html += `
                    <thead style="background-color: #3498db; color: white;">
                        <tr>
                            <th>รหัสครุภัณฑ์</th>
                            <th>รายละเอียด</th>
                            <th>ราคา</th>
                            <th>ดาวน์โหลด</th>
                            <th>ปรับปรุงข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                    let hasVisibleItems = false;

                    $.each(groupedBySubCategory, function (subCategory, items) {
                        // Only show items with status = 1 (active)
                        const visibleItems = items.filter(item => item.Equipment_status == 1);

                        if (visibleItems.length === 0) return;

                        hasVisibleItems = true;

                        html += `
                        <tr>
                            <td colspan="6" class="bg-lightblue text-start"><strong>${subCategory}</strong></td> 
                        </tr>
                    `;

                        $.each(visibleItems, function (index, item) {
                            html += `
                            <tr>
                                <td data-label="รหัสครุภัณฑ์">${item.Equipment_code}</td>
                                <td data-label="รายละเอียด">${item.Equipment_details}</td>
                                <td data-label="ราคา">${item.Price}</td>
                                <td data-label="ดาวน์โหลด">
                                    <a href="/spec/download/${encodeURIComponent(item.File_path_pdf.split('/').pop())}" class="btn btn-outline-primary btn-sm" title="Download">
                                        <i class="bi bi-download"></i> PDF
                                    </a>
                                </td>
                                <td data-label="ปรับปรุงข้อมูล">${item.Update_date || '-'}</td>
                            </tr>
                        `;
                        });
                    });

                    html += '</tbody></table></div>';

                    if (hasVisibleItems) {
                        $('#items-table').html(html);
                        tableContainer.show();
                    } else {
                        $('#items-table').html('<div class="alert alert-info">ไม่พบข้อมูลครุภัณฑ์ที่สามารถแสดงได้</div>');
                        tableContainer.show();
                    }

                    // Force layout check after rendering table
                    setTimeout(checkContentOverflow, 0);
                },
                error: function () {
                    button.prop('disabled', false);
                    alert('Error fetching data. Please try again later.');
                }
            });
        });

        // Improved Home Button click handler
        $(document).on('click', '.home-btn', function () {
            $('.full-page-table').hide();
            $('.carousel-container').show();
            $('.home-btn').hide();

            // Update layout based on screen size
            checkContentOverflow();
        });

        // Document ready function
        $(document).ready(function () {
            $('.home-btn').hide();

            // Apply initial layout check
            checkContentOverflow();

            // Initialize the sidebar toggle buttons
            const toggleButton = document.getElementById('toggleButton');
            const backButton = document.getElementById('backButton');
            const sidebar = document.getElementById('sidebar');

            // Toggle button shows sidebar on small screens
            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('visible');
            });

            // Back button hides sidebar
            backButton.addEventListener('click', function () {
                sidebar.classList.remove('visible');
                sidebar.classList.add('hidden');
            });

            // Add window resize event listener with throttling
            window.addEventListener('resize', throttle(function () {
                checkContentOverflow();
            }, 100));

            // Check for text overflow in menu items and apply responsive classes
            const menuItems = document.querySelectorAll('.menu a');
            menuItems.forEach(item => {
                // If text is too long, ensure it wraps properly
                if (item.scrollWidth > item.clientWidth) {
                    item.style.height = 'auto';
                    item.style.minHeight = '60px';
                }
            });
        });

        // Improved debounced search functionality
        $(document).ready(function () {
            let searchDebounceTimer;
            $('#searchInput').on('keyup', function () {
                const searchTerm = $(this).val().trim();
                clearTimeout(searchDebounceTimer);

                searchDebounceTimer = setTimeout(function () {
                    if (searchTerm.length === 0) {
                        $('#items-table').html('<p class="text-muted">Start typing to search for items.</p>');
                        $('.full-page-table').hide();
                        $('.carousel-container').show();
                        $('.home-btn').hide();

                        // Reset layout based on screen size
                        checkContentOverflow();
                        return;
                    }

                    $('.carousel-container').hide();
                    document.getElementById('sidebar').classList.remove('visible');
                    document.getElementById('sidebar').classList.add('hidden');
                    document.getElementById('content').style.marginLeft = '0';
                    $('.navbar').css('margin-left', '0');
                    $('footer').css('width', '100%');
                    $('.home-btn').show();

                    // Hide toggle button during search results
                    document.getElementById('toggleButton').style.display = 'none';

                    $.ajax({
                        url: '/spec/searchItems',
                        type: 'POST',
                        data: {
                            searchTerm: searchTerm
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.error) {
                                $('#items-table').html('<p class="text-danger">' + response.error + '</p>');
                                return;
                            }

                            // Filter to show only active items (status = 1)
                            const activeItems = response.filter(item => item.Equipment_status == 1);

                            if (activeItems.length === 0) {
                                $('#items-table').html('<div class="alert alert-info">ไม่พบข้อมูลครุภัณฑ์ที่ตรงกับการค้นหา</div>');
                                $('.full-page-table').show();
                                return;
                            }

                            let html = '<div class="table-responsive"><table class="table table-bordered">';
                            html += `
                                <thead style="background-color: #3498db; color: white;">
                                    <tr>
                                        <th>รหัสครุภัณฑ์</th>
                                        <th>รายละเอียด</th>
                                        <th>ราคา</th>
                                        <th>ดาวน์โหลด</th>
                                        <th>ประเภทครุภัณฑ์</th>
                                        <th>หน่วยงาน</th>
                                        <th>ปรับปรุงข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                            `;

                            $.each(activeItems, function (index, item) {
                                html += `
                                    <tr>
                                        <td data-label="รหัสครุภัณฑ์">${item.Equipment_code}</td>
                                        <td data-label="รายละเอียด">${item.Equipment_details}</td>
                                        <td data-label="ราคา">${item.Price}</td>
                                        <td data-label="ดาวน์โหลด">
                                            <a href="/spec/download/${encodeURIComponent(item.File_path_pdf.split('/').pop())}" class="btn btn-outline-primary btn-sm" title="Download">
                                                <i class="bi bi-download"></i> PDF
                                            </a>
                                        </td>
                                        <td data-label="ประเภทครุภัณฑ์">${item.Category_name}</td>
                                        <td data-label="หน่วยงาน">${item.Dep_fullname}</td>
                                        <td data-label="ปรับปรุงข้อมูล">${item.Update_date || '-'}</td>
                                    </tr>
                                `;
                            });

                            html += '</tbody></table></div>';
                            $('#items-table').html(html);
                            $('.full-page-table').show();
                        },
                        error: function () {
                            $('#items-table').html('<p class="text-danger">Error fetching data. Please try again later.</p>');
                        }
                    });
                }, 300);
            });
        });

        // Filter carousel by sidebar - Improved version
        $(document).ready(function () {
            let originalCards = $(".card.load-items").clone();

            $(document).on("click", ".show-cards", function (e) {
                e.preventDefault();
                let selectedCategory = $(this).data("goods-genre");

                // On mobile, close sidebar after selection
                if (window.innerWidth <= 1200) {
                    document.getElementById('sidebar').classList.remove('visible');
                    document.getElementById('sidebar').classList.add('hidden');
                }

                $("#customCarousel .carousel-inner").empty();
                $(".carousel-indicators").empty();

                let filteredCards = [];

                if (selectedCategory === "all") {
                    filteredCards = originalCards.toArray();
                } else {
                    originalCards.each(function () {
                        let cardCategory = $(this).find(".card-body span").text().trim();
                        if (cardCategory === selectedCategory) {
                            filteredCards.push(this);
                        }
                    });
                }

                let chunkSize = 3;
                let chunkedCards = [];
                for (let i = 0; i < filteredCards.length; i += chunkSize) {
                    chunkedCards.push(filteredCards.slice(i, i + chunkSize));
                }

                chunkedCards.forEach((group, index) => {
                    let isActive = index === 0 ? "active" : "";
                    let slide = `
                        <div class="carousel-item ${isActive}">
                            <div class="row justify-content-center card-slider">
                                ${group.map(card => `<div class="col-md-3 px-3">${card.outerHTML}</div>`).join("")}
                            </div>
                        </div>
                    `;
                    $("#customCarousel .carousel-inner").append(slide);

                    $(".carousel-indicators").append(`
                        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="${index}" 
                        class="${index === 0 ? 'active' : ''}" aria-label="Slide ${index + 1}"></button>
                    `);
                });

                if (filteredCards.length === 0) {
                    $("#customCarousel .carousel-inner").append(`
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <div class="col text-center">
                                    <h5 class="text-muted">ไม่พบข้อมูล</h5>
                                </div>
                            </div>
                        </div>
                    `);
                }

                // Reinitialize the carousel
                const carouselEl = document.getElementById('customCarousel');
                const carousel = bootstrap.Carousel.getInstance(carouselEl) || new bootstrap.Carousel(carouselEl);
                carousel.to(0);

                // Make sure the layout is updated
                checkContentOverflow();
            });
        });

        // Improved carousel indicator click handling
        $(document).on('click', '.carousel-indicators button', debounce(function () {
            const index = $(this).data('bs-slide-to');
            const carouselElement = document.getElementById('customCarousel');
            const buttons = $('.carousel-indicators button');

            buttons.prop('disabled', true); // Temporarily disable to prevent spam click

            let carouselInstance = bootstrap.Carousel.getInstance(carouselElement);
            if (!carouselInstance) {
                carouselInstance = new bootstrap.Carousel(carouselElement);
            }

            carouselInstance.to(index);

            // Re-enable buttons after slide animation
            setTimeout(() => buttons.prop('disabled', false), 600);
        }, 10));
    </script>
</body>

</html>