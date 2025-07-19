<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="Style.css ">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: rgb(255, 255, 255);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            width: auto;
            height: auto;
            margin-bottom: 120px;
            margin-top: 80px;
        }

        .navbar {
            z-index: 1051;
        }

        .sidebar {
            width: 300px;
            height: 100%;
            background: linear-gradient(0deg, #3ed6e5, #a0edf2);
            position: fixed;
            top: 80px;
            transition: transform 0.3s ease-in-out;
            padding: 1rem;
            box-sizing: border-box;
            z-index: 1050;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .toggle-button {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 10px;
        }

        #toggleButton {
            display: none;
        }

        .menu {
            margin-top: 50px;
        }

        .menu a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            text-align: center;
            white-space: normal;
            word-break: break-word;
            margin-bottom: 0.5rem;
            margin-left: 10px;
            border-radius: 2rem;
        }

        .menu a:hover {
            transform: scale(0.98);
        }

        .content {
            margin-left: 250px;
            padding-top: 5rem;
            transition: margin-left 0.3s;
        }

        .card {
            width: 100%;
            /* width: 300px; */
            flex: 0 0 auto;
            border: 2px solid;
            border-radius: 7px;
            overflow: hidden;
            margin-bottom: 40px;
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
            color: white;
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
            filter: invert(10);
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

        /* .clearfix::after {
            content: "";
            display: table;
            clear: both;
        } */

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #68dff0;
            color: white;
            font-weight: bold;
            margin-top: auto;
            z-index: 1049;
        }

        @media (max-width: 767px) {
            .sidebar {
                top: 160px;
                ;
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            #toggleButton {
                display: block;
            }

            .content {
                margin-left: 0;
                width: 80%;
            }

            */ .table-responsive table,
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

        .card-slider {
            display: flex;
            gap: 1rem;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-container {
            background-color: #3498db;
            /* Blue Background */
            padding: 20px;
            border-radius: 10px;
        }

        .carousel-inner {
            padding: 10px;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            background: rgba(0, 0, 0, 0.2);
            /* border-radius: 50%; */
            z-index: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
            z-index: 1048;
        }

        .carousel-indicators {
            bottom: -8px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: rgba(23, 23, 23, 0.5);
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center p-2" href="/spec">
                <img src="/RID.png" alt="RID Logo" style="max-width: 60px; max-height: 60px;">
                <div class="ms-2">
                    <h5 class="text-white mb-0">ระบบเผยแพร่คุณลักษณะเฉพาะครุภัณฑ์</h5>
                    <h5 class="text-white mb-0">(Specifications)</h5>
                </div>
            </a>

            <!-- Collapsible Content -->
            <div class="navbar-collapse justify-content-end" id="navbarContent">
                <a href="/spec/login" class="btn rounded-3 text-white px-4 py-2 mt-2 mt-lg-0"
                    style="background: linear-gradient(180deg, #3498da, rgba(41,128,186,1)); font-size: 0.85rem;">
                    เข้าสู่ระบบ
                </a>
            </div>
            <!-- Toggle Button -->
            <button class="btn btn-light p-2 mt-2 rounded-circle shadow-sm me-2" type="button" id="toggleButton">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="row">
        <!-- Sidebar -->
        <div class="sidebar container-fluid  col" id="sidebar">
            <div class="menu ">
                <a href="#" class="show-cards" data-goods-genre="ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร"
                    style="background-color:#4caf50; height: 60px">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักออกแบบวิศวกรรมและสถาปัตยกรรม"
                    style="background-color: #7c2ae0; height: 60px">สำนักออกแบบวิศวกรรมและสถาปัตยกรรม</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักเครื่องจักรกล"
                    style="background-color: #5bc0de; height: 60px">สำนักเครื่องจักรกล</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักสำรวจด้านวิศวกรรมและธรณีวิทยา"
                    style="background-color: #ff9800; height: 60px">สำนักสำรวจด้านวิศวกรรมและธรณีวิทยา</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักบริหารจัดการน้ำและอุทกวิทยา"
                    style="background-color: #ff5722; height: 60px">สำนักบริหารจัดการน้ำและอุทกวิทยา</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักวิจัยและพัฒนา"
                    style="background-color: #e94b35; height: 60px">สำนักวิจัยและพัฒนา</a>
                <a href="#" class="show-cards" data-goods-genre="สำนักงานเลขานุการกรม"
                    style="background-color: #795548; height: 60px">สำนักงานเลขานุการกรม</a>
                <a href="#" class="show-cards" data-goods-genre="all"
                    style="background-color: #000; height: 60px">แสดงทั้งหมด</a>
            </div>
            <div class="mt-5 ms-2">
                © 811 กรมชลประทาน ถ.สามเสน แขวงดุสิต เขตดุสิต กทม. 10300 โทร.02-241-0020 ถึง 29
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid content bg-white col" id="content">
            <div class="container-fluid d-flex justify-content-center align-items-center my-5">
                <div class="w-100 p-4 border"
                    style="background: rgba(52,152,218,255); max-width: 1200px; border-radius: 40px">
                    <div class="row align-items-center p-4 bg-white border rounded-pill mx-2"
                        style="border: 1px solid black;">
                        <!-- Search Label -->
                        <div class="col-md-3 text-center fw-bold mb-2">
                            ระบุชื่อครุภัณฑ์ที่สืบค้น
                        </div>

                        <!-- Search Input -->
                        <div class="col-md-5 px-3 mb-2">
                            <input class="form-control rounded-2" id="searchInput" type="text"
                                placeholder="เช่น คอมพิวเตอร์โต๊ะ เป็นต้น" style="border-color: rgb(225, 225, 225);">
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-4 text-center">
                            <button class="btn  home-btn fw-bold text-white rounded-1 mx-1 mb-2"
                                style="background-color: #f0ad4e">
                                <i class="bi bi-house-door-fill"></i> กลับหน้าหลัก
                            </button>
                            <button class="btn fw-bold text-white rounded-2 mx-2 px-4"
                                style="background-color: #5bc0de;">
                                <i class="bi bi-book-half"></i> คู่มือการใช้งาน
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="carousel-container">
                    <div id="customCarousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">
                            <?php
                            // Split posts into groups of 4
                            $chunked_posts = array_chunk($posts, 3);
                            $first = true;

                            foreach ($chunked_posts as $post_group): ?>
                                <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                    <div class="row justify-content-center card-slider">
                                        <?php foreach ($post_group as $post): ?>
                                            <div class="col-md-3 px-3"> <!-- Reduced padding -->
                                                <div class="card load-items "
                                                    style="border-color: <?= esc($post['Category_color'] ?? '#000000') ?>;"
                                                    data-card-id="<?= esc($post['Category_id']) ?>">
                                                    <div class="card-header row"
                                                        style="background-color: <?= esc($post['Category_color'] ?? '#000000') ?>;">
                                                        <img class="col ms-3" src="<?= esc($post['Icon_path'] ?? '') ?>"
                                                            alt="Icon">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#customCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                        <div class="carousel-indicators">
                            <?php foreach ($chunked_posts as $index => $post_group): ?>
                                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="<?= $index ?>"
                                    class="<?= $index === 0 ? 'active' : '' ?>"
                                    aria-label="Slide <?= $index + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="full-page-table" style="display:none;">

                <!-- TABLE -->
                <div class="container">
                    <div id="items-table"></div>
                </div>
            </div>
        </div>

        <footer class=" pb-4 pt-2" style="background-color: #68dff0; position: fixed; bottom: 0; width: 100%;">
            <div class="text-center text-white fw-bold">
                Asset Spec System of Royal Irrigation Department
            </div>
            <div class="text-center text-white fw-bold">
                Copyright © 2017 ---. All Rights Reserved. https://test-intranet.rid.go.th
            </div>
        </footer>
        <script>
            // Debounce utility
            function debounce(func, delay) {
                let timer;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            // ShowTable
            $(document).on('click', '.load-items', function (e) {
                e.preventDefault();

                const button = $(this);
                const Category_id = button.data('card-id');
                const tableContainer = $('.full-page-table');

                sidebar.classList.add('hidden');
                content.style.marginLeft = '0';
                $('.carousel-container').hide();
                $('.home-btn').show();

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

                        $.each(groupedBySubCategory, function (subCategory, items) {
                            html += `
                        <tr>
                            <td colspan="6" class="bg-lightblue text-start"><strong>${subCategory}</strong></td> 
                        </tr>
                    `;

                            $.each(items, function (index, item) {
                                html += `
                            <tr>
                                <td>${item.Equipment_code}</td>
                                <td>${item.Equipment_details}</td>
                                <td>${new Intl.NumberFormat().format(item.Price)}.-</td>
                                <td>
                                    <a href="/spec/download/${encodeURIComponent(item.File_path_pdf.split('/').pop())}" class="btn btn-outline-primary btn-sm" title="Download">
                            <i class="bi bi-download"></i> PDF
                        </a>
                                </td>
                                <td>${item.Update_date || '-'}</td>
                            </tr>
                        `;
                            });
                        });

                        html += '</tbody></table></div>';

                        $('#items-table').html(html);
                        tableContainer.show();
                    },
                    error: function () {
                        button.prop('disabled', false);
                        alert('Error fetching data. Please try again later.');
                    }
                });
            });

            // Home Button
            $(document).on('click', '.home-btn', function () {
                $('.full-page-table').hide();
                $('.carousel-container').show();

                // Only show sidebar if screen width > 767px
                if (window.innerWidth > 767) {
                    sidebar.classList.remove('hidden');
                    content.style.marginLeft = '300px';
                } else {
                    sidebar.classList.add('hidden');
                    content.style.marginLeft = '0';
                }

                $('.home-btn').hide();
            });

            // Ready
            $(document).ready(function () {
                $('.home-btn').hide();
            });

            // Debounced search functionality
            $(document).ready(function () {
                let debounceTimer;
                $('#searchInput').on('keyup', function () {
                    const searchTerm = $(this).val().trim();
                    clearTimeout(debounceTimer);

                    debounceTimer = setTimeout(function () {
                        if (searchTerm.length === 0) {
                            $('#items-table').html('<p class="text-muted">Start typing to search for items.</p>');
                            $('.full-page-table').hide();
                            $('.carousel-container').show();
                            $('.home-btn').hide();
                            sidebar.classList.remove('hidden');
                            content.style.marginLeft = '300px';
                            return;
                        }

                        $('.carousel-container').hide();
                        sidebar.classList.add('hidden');
                        content.style.marginLeft = '0';

                        $.ajax({
                            url: '/spec/searchItems',
                            type: 'POST',
                            data: { searchTerm: searchTerm },
                            dataType: 'json',
                            success: function (response) {
                                if (response.error) {
                                    $('#items-table').html('<p class="text-danger">' + response.error + '</p>');
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
                                    <th>ปรับปรุงข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;

                                $.each(response, function (index, item) {
                                    html += `
                                <tr>
                                    <td>${item.Equipment_code}</td>
                                    <td>${item.Equipment_details}</td>
                                    <td>${new Intl.NumberFormat().format(item.Price)}.-</td>
                                    <td>
                                        <a href="/spec/download/${encodeURIComponent(item.File_path_pdf.split('/').pop())}" class="btn btn-outline-primary btn-sm" title="Download">
                            <i class="bi bi-download"></i> PDF
                        </a>
                                    </td>
                                    <td>${item.Update_date || '-'}</td>
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

            // Filter carousel by sidebar
            $(document).ready(function () {
                let originalCards = $(".card.load-items").clone();

                $(document).on("click", ".show-cards", function (e) {
                    e.preventDefault();
                    let selectedCategory = $(this).data("goods-genre");

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

                    $("#customCarousel").carousel(0);
                });
            });

            // Sidebar toggle and responsive layout
            const toggleButton = document.getElementById('toggleButton');
            const sidebar = document.getElementById('sidebar');

            toggleButton.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('hidden');
                }
            });

            function handleResize() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('hidden');
                    content.style.marginLeft = '300px';
                    toggleButton.style.display = 'none';
                } else {
                    sidebar.classList.add('hidden');
                    content.style.marginLeft = '0';
                    toggleButton.style.display = 'block';
                }
            }

            window.addEventListener('resize', handleResize);
            document.addEventListener('DOMContentLoaded', handleResize);

            // ✅ Fixed: Debounced and safe carousel indicator click handling
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>