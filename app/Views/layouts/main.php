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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(241, 241, 241);
        }

        header {
            background-color: #03a9f4;
            height: 80px;
            color: white;
            display: flex;
            align-items: center;
            width: 100%;
            z-index: 1100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            font-size: 12px;
            text-align: center;
            margin-top: 20px;
        }

        .toggle-button {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 10px;
        }

        .menu a {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #333;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            height: 56px;
            border-radius: 14px;
            box-shadow: 0px 0px 2px 4px rgba(0, 0, 0, 0.13);
            transition: all 0.2s ease-in-out;
            margin-bottom: 3px;
        }

        .menu a:hover {
            background-color: rgb(224, 224, 224);
            transform: scale(0.99);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .menu a.active {
            background-color: rgb(237, 237, 237);
            border-left: 5px solid rgb(2, 216, 27);
            font-weight: 600;
        }

        /* Sidebar */
        .sidebar {
            width: 300px;
            background: white;
            position: fixed;
            left: 0;
            top: 75px;
            height: calc(100vh - 80px);
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 0px 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Content (no push effect) */
        .main {
            padding: 10px;
            transition: margin-left 0.3s ease;
            margin-left: 300px;
        }

        /* Hidden sidebar */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .profile-section {
            text-align: center;
            padding-top: 20px;
            margin-bottom: 35px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .profile-section h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .profile-section p {
            color: #666;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .main {
                margin-left: 0;
            }

            /* Sidebar hidden on small screens */
            .sidebar.hidden {
                transform: translateX(-100%);
            }
        }

        /* Sidebar toggle button */
        #toggleButton {
            display: none;
            /* Default hidden */
        }

        /* Show toggle button only on small screens */
        @media (max-width: 768px) {
            #toggleButton {
                display: block;
                /* Show toggle button on small screens */
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top px-3 shadow">
        <div class="container-fluid d-flex align-items-center">
            <!-- Flex container for toggle button and text -->
            <div class="d-flex align-items-center">
                <!-- Toggle Button -->
                <button class="btn btn-light p-2 rounded-circle shadow-sm me-2" type="button" id="toggleButton">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Brand Text -->
                <a class="navbar-brand d-flex align-items-center text-white text-decoration-none ms-3"
                    href="/spec/admin">
                    <img src="/RID.png" alt="RID Logo" class="img-fluid" style="width: 50px; height: auto;">
                    <div class="ms-2">
                        <h5 class="fw-bold mb-0">ระบบเผยแพร่คุณลักษณะเฉพาะครุภัณฑ์</h5>
                        <h6 class="mb-0">(Specifications)</h6>
                    </div>
                </a>
            </div>
        </div>
    </nav>



    <!-- Sidebar -->
    <div class="sidebar container-fluid col" id="sidebar">
        <div class="profile-section row" id="profile-section">
            <!-- <img src="https://via.placeholder.com/70" alt="User Avatar"> -->
            <h4 class="mt-3"><?= session()->get('Username') ?></h4>
            <p><?= session()->get('Dep_fullname') ?></p>
        </div>
        <div class="menu ">
            <a href="/spec/admin"><i class="bi bi-house-fill"></i> จัดการข้อมูลครุภัณฑ์</a>

            <?php if (session()->get('Status_id') == 1): ?>
                <a href="<?= base_url('spec/admin?active=typeSpec'); ?>"><i class="bi bi-file-earmark-text-fill"></i>
                    จัดการหมวดหลักครุภัณฑ์</a>
            <?php endif; ?>
            <a href="<?= base_url('spec/admin?active=SubtypeSpec'); ?>"><i class="bi bi-folder-fill"></i>
                จัดการหมวดย่อยครุภัณฑ์</a>
            <?php if (session()->get('Status_id') == 1): ?>
                <a href="<?= base_url('spec/admin?active=User'); ?>"><i class="bi bi-person-circle"></i> จัดการผู้ใช้งาน</a>
                <a href="<?= base_url('spec/admin?active=Department'); ?>"><i class="bi bi-people-fill"></i>
                    จัดการหน่วยงาน</a>
            <?php endif; ?>

            <a href="<?= base_url('spec/admin?active=Report'); ?>"><i class="bi bi-bar-chart-fill"></i> รายงาน</a>
            <a href="/spec/logout"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a>
        </div>
    </div>

    <main id="main" class="main">
        <?= $this->renderSection('content') ?>
    </main>
    <script>
        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.main');

        toggleButton.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('hidden');
            }
        });

        // Resize event to reset sidebar and content layout
        function handleResize() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('hidden'); // Show sidebar on large screens
                content.style.marginLeft = '300px';
                toggleButton.style.display = 'none'; // Hide toggle button on large screens
            } else {
                sidebar.classList.add('hidden'); // Hide sidebar on small screens
                content.style.marginLeft = '0';
                toggleButton.style.display = 'block'; // Show toggle button on small screens
            }
        }

        window.addEventListener('resize', handleResize);
        document.addEventListener('DOMContentLoaded', handleResize);

        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.menu a');
            const currentURL = window.location.href;
            const baseURL = window.location.origin + "/spec/admin";

            links.forEach(link => {
                link.classList.remove('active');
            });

            let activeLink = Array.from(links).find(link =>
                link.href === currentURL ||
                (currentURL === baseURL && link.href === baseURL)
            );

            // Default to highlight จัดการข้อมูลครุภัณฑ์ if no query params
            if (!activeLink) {
                activeLink = Array.from(links).find(link => link.href === baseURL);
            }

            if (activeLink) {
                activeLink.classList.add('active');
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>