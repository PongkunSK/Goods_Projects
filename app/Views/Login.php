<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, #2fcaff, #f45eff);
        }
        .container {
            background: white;
            width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        button {
            background: linear-gradient(90deg, #2fcaff, #f45eff);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            opacity: 0.9;
        }
        .input-group-text i {
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/RID.png" style="height: 170px; width: 170px;">
        <h4 class="mt-1 text-primary">ระบบเผยแพร่คุณลักษณะเฉพาะครุภัณฑ์</h4>
        <h4 class="text-primary">(Specifications)</h4>

        <!-- Display error message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/spec/authenticate">
            

            <div class="mb-4">
                <p class="text-start fw-bold">ชื่อผู้ใช้</p>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input id="username" name="username" type="text" class="form-control" placeholder="กรอกชื่อผู้ใช้" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-start fw-bold">รหัสผ่าน</p>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input id="password" name="password" type="password" class="form-control" placeholder="กรอกรหัสผ่าน" required>
                </div>
            </div>

            <button type="submit">เข้าสู่ระบบ</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>