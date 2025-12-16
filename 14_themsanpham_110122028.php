<?php
/**
 * Trang thêm sản phẩm cho gian hàng
 * Mã đề: 14
 * MSSV: 110122028
 */

include '14_ketnoi_110122028.php';

// Thông tin sinh viên
$maDe = "14";
$mssv = "110122028";
$hoTen = "Liễu Kiện An";
$lop = "DA22TTD"; // Thay bằng lớp thật của bạn

$thongBao = "";
$loaiThongBao = "";

// Lấy danh sách gian hàng
$sqlGianHang = "SELECT * FROM gianhang WHERE isBlock = 0";
$resultGianHang = $conn->query($sqlGianHang);

// Lấy danh sách loại sản phẩm
$sqlLoai = "SELECT * FROM loaisanpham WHERE isDelete = 0";
$resultLoai = $conn->query($sqlLoai);

// Lấy danh sách size
$sqlSize = "SELECT * FROM kichthuoc";
$resultSize = $conn->query($sqlSize);

// Xử lý thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['themSanPham'])) {
    $tenSanPham = trim($_POST['tenSanPham']);
    $moTa = trim($_POST['moTa']);
    $idSize = $_POST['idSize'];
    $gia = $_POST['gia'];
    $soLuong = $_POST['soLuong'];
    $maLoai = $_POST['maLoai'];
    $idGianHang = $_POST['idGianHang'];
    // Xử lý upload hình ảnh
    $hinhSanPham = "";
    if (isset($_FILES['hinhSanPham']) && $_FILES['hinhSanPham']['error'] == 0) {
        $targetDir = "images/uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['hinhSanPham']['name']);
        $targetFile = $targetDir . $fileName;
        
        if (move_uploaded_file($_FILES['hinhSanPham']['tmp_name'], $targetFile)) {
            $hinhSanPham = $targetFile;
        }
    }

    // Kiểm tra trùng tên sản phẩm trong cùng gian hàng
    $sqlKiemTra = "SELECT * FROM sanpham WHERE tenSanPham = ? AND idGianHang = ? AND isDelete = 0";
    $stmtKiemTra = $conn->prepare($sqlKiemTra);
    $stmtKiemTra->bind_param("si", $tenSanPham, $idGianHang);
    $stmtKiemTra->execute();
    $resultKiemTra = $stmtKiemTra->get_result();

    if ($resultKiemTra->num_rows > 0) {
        $thongBao = "Tên sản phẩm đã tồn tại trong gian hàng này!";
        $loaiThongBao = "error";
    } else {
        // Thêm sản phẩm mới
        $sqlThem = "INSERT INTO sanpham (tenSanPham, moTa, idSize, gia, soLuong, hinhSanPham, maLoai, idGianHang) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtThem = $conn->prepare($sqlThem);
        $stmtThem->bind_param("ssiisssi", $tenSanPham, $moTa, $idSize, $gia, $soLuong, $hinhSanPham, $maLoai, $idGianHang);
        
        if ($stmtThem->execute()) {
            $thongBao = "Thêm sản phẩm thành công!";
            $loaiThongBao = "success";
        } else {
            $thongBao = "Lỗi khi thêm sản phẩm: " . $conn->error;
            $loaiThongBao = "error";
        }
    }
}

// Lấy gian hàng được chọn để hiển thị sản phẩm
$gianHangChon = isset($_POST['idGianHang']) ? $_POST['idGianHang'] : (isset($_GET['gianhang']) ? $_GET['gianhang'] : 1);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm - Mã đề <?php echo $maDe; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0077be 0%, #00a8e8 100%);
            min-height: 100vh;
        }
        /* Header */
        header {
            background: linear-gradient(90deg, #1a1a2e, #16213e);
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #f39c12;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        header h1 .sakura {
            font-size: 32px;
            animation: sakuraFloat 2s ease-in-out infinite;
        }
        header h1 .sakura:first-child {
            animation-delay: 0s;
        }
        header h1 .sakura:last-child {
            animation-delay: 1s;
        }
        @keyframes sakuraFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(10deg); }
        }
        header .info {
            font-size: 14px;
            color: #ecf0f1;
        }
        header .info span {
            margin: 0 15px;
            padding: 5px 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
        /* Container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        /* Form thêm sản phẩm */
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .form-container h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
            font-size: 24px;
        }
        .form-toggle {
            cursor: pointer;
            user-select: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-toggle:hover {
            color: #3498db;
        }
        .form-toggle span {
            font-size: 16px;
            transition: transform 0.3s;
        }
        .form-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.4s ease, opacity 0.3s ease;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn-submit {
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.4);
        }
        /* Thông báo */
        .thongbao {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .thongbao.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .thongbao.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        /* Danh sách sản phẩm */
        .product-list {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .product-list h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #e74c3c;
        }
        .filter-bar {
            margin-bottom: 20px;
        }
        .filter-bar select {
            padding: 10px 20px;
            border: 2px solid #3498db;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }
        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .product-card {
            display: block;
            text-decoration: none;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 20px;
        }
        .product-info h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .product-info p {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .product-info .price {
            color: #e74c3c;
            font-size: 20px;
            font-weight: bold;
        }
        .product-info .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 10px;
        }
        .badge-loai {
            background: #3498db;
            color: white;
        }
        .badge-size {
            background: #9b59b6;
            color: white;
        }
        /* Footer */
        footer {
            background: linear-gradient(90deg, #1a1a2e, #16213e);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-top: 30px;
        }
        footer .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        footer h3 {
            color: #f39c12;
            margin-bottom: 20px;
            font-size: 22px;
        }
        .footer-grid {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        .footer-item {
            background: rgba(255,255,255,0.1);
            padding: 15px 25px;
            border-radius: 8px;
            min-width: 180px;
            text-align: center;
        }
        .footer-label {
            display: block;
            color: #f39c12;
            font-size: 11px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer-value {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
        }
        footer .ma-de {
            display: inline-block;
            background: #e74c3c;
            padding: 12px 35px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full-width {
                grid-column: span 1;
            }
            header .info span {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>
            <span class="sakura">🌸</span>
            GIAN HÀNG HANDMADE
            <span class="sakura">🌸</span>
        </h1>
        <div class="info">
            <span>Họ tên: <?php echo $hoTen; ?></span>
            <span>MSSV: <?php echo $mssv; ?></span>
            <span>Lớp: <?php echo $lop; ?></span>
            <span>Mã đề: <?php echo $maDe; ?></span>
        </div>
    </header>

    <div class="container">
        <!-- Form thêm sản phẩm -->
        <div class="form-container">
            <h2 class="form-toggle" onclick="toggleForm()">
                Thêm Sản Phẩm Mới <span id="toggleIcon">▼</span>
            </h2>
            
            <?php if ($thongBao != ""): ?>
                <div class="thongbao <?php echo $loaiThongBao; ?>">
                    <?php echo $thongBao; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data" id="formThemSP" class="form-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Chọn Gian Hàng:</label>
                        <select name="idGianHang" required>
                            <?php 
                            $resultGianHang->data_seek(0);
                            while($row = $resultGianHang->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $row['idGianHang']; ?>" 
                                    <?php echo ($gianHangChon == $row['idGianHang']) ? 'selected' : ''; ?>>
                                    <?php echo $row['tenGianHang']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tên Sản Phẩm:</label>
                        <input type="text" name="tenSanPham" required placeholder="Nhập tên sản phẩm...">
                    </div>

                    <div class="form-group">
                        <label>Loại Sản Phẩm:</label>
                        <select name="maLoai" required>
                            <?php 
                            $resultLoai->data_seek(0);
                            while($row = $resultLoai->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $row['maLoai']; ?>">
                                    <?php echo $row['tenLoai']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kích Thước (Size):</label>
                        <select name="idSize" required>
                            <?php 
                            $resultSize->data_seek(0);
                            while($row = $resultSize->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $row['idSize']; ?>">
                                    <?php echo $row['size']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Giá (VNĐ):</label>
                        <input type="number" name="gia" required min="0" placeholder="Nhập giá sản phẩm...">
                    </div>

                    <div class="form-group">
                        <label>Số Lượng:</label>
                        <input type="number" name="soLuong" required min="0" placeholder="Nhập số lượng...">
                    </div>

                    <div class="form-group full-width">
                        <label>Chọn hình ảnh:</label>
                        <input type="file" name="hinhSanPham" required accept="image/*">
                    </div>

                    <div class="form-group full-width">
                        <label>Mô Tả:</label>
                        <textarea name="moTa" placeholder="Nhập mô tả sản phẩm..."></textarea>
                    </div>
                </div>

                <button type="submit" name="themSanPham" class="btn-submit">
                    Thêm Sản Phẩm
                </button>
            </form>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="product-list">
            <h2>Danh Sách Sản Phẩm Của Gian Hàng</h2>
            
            <div class="filter-bar">
                <form method="GET" action="">
                    <label>Chọn gian hàng để xem: </label>
                    <select name="gianhang" onchange="this.form.submit()">
                        <?php 
                        $resultGianHang->data_seek(0);
                        while($row = $resultGianHang->fetch_assoc()): 
                        ?>
                            <option value="<?php echo $row['idGianHang']; ?>"
                                <?php echo ($gianHangChon == $row['idGianHang']) ? 'selected' : ''; ?>>
                                <?php echo $row['tenGianHang']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>
            </div>

            <div class="product-grid">
                <?php
                // Lấy sản phẩm của gian hàng, sắp xếp theo idSanPham giảm dần (thêm sau hiển thị trước)
                $sqlSanPham = "SELECT sp.*, lsp.tenLoai, kt.size, gh.tenGianHang 
                               FROM sanpham sp 
                               JOIN loaisanpham lsp ON sp.maLoai = lsp.maLoai 
                               JOIN kichthuoc kt ON sp.idSize = kt.idSize 
                               JOIN gianhang gh ON sp.idGianHang = gh.idGianHang
                               WHERE sp.idGianHang = ? AND sp.isDelete = 0
                               ORDER BY sp.idSanPham DESC";
                $stmtSP = $conn->prepare($sqlSanPham);
                $stmtSP->bind_param("i", $gianHangChon);
                $stmtSP->execute();
                $resultSP = $stmtSP->get_result();

                if ($resultSP->num_rows > 0):
                    while($sp = $resultSP->fetch_assoc()):
                ?>
                    <a href="14_chitietsanpham_110122028.php?id=<?php echo $sp['idSanPham']; ?>" class="product-card">
                        <img src="<?php echo $sp['hinhSanPham']; ?>" alt="<?php echo $sp['tenSanPham']; ?>">
                        <div class="product-info">
                            <h3><?php echo $sp['tenSanPham']; ?></h3>
                            <p><?php echo $sp['moTa']; ?></p>
                            <p>Số lượng: <?php echo $sp['soLuong']; ?></p>
                            <p class="price"><?php echo number_format($sp['gia'], 0, ',', '.'); ?> VNĐ</p>
                            <span class="badge badge-loai"><?php echo $sp['tenLoai']; ?></span>
                            <span class="badge badge-size"><?php echo $sp['size']; ?></span>
                        </div>
                    </a>
                <?php 
                    endwhile;
                else:
                ?>
                    <p style="grid-column: span 4; text-align: center; color: #7f8c8d; padding: 40px;">
                        Chưa có sản phẩm nào trong gian hàng này.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <h3>THÔNG TIN SINH VIÊN</h3>
            <div class="footer-grid">
                <div class="footer-item">
                    <span class="footer-label">Họ và tên:</span>
                    <span class="footer-value"><?php echo $hoTen; ?></span>
                </div>
                <div class="footer-item">
                    <span class="footer-label">MSSV:</span>
                    <span class="footer-value"><?php echo $mssv; ?></span>
                </div>
                <div class="footer-item">
                    <span class="footer-label">Lớp:</span>
                    <span class="footer-value"><?php echo $lop; ?></span>
                </div>
                <div class="footer-item">
                    <span class="footer-label">Email:</span>
                    <span class="footer-value"><?php echo $mssv; ?>@st.tvu.edu.vn</span>
                </div>
            </div>
            <div class="ma-de">MÃ ĐỀ KIỂM TRA: <?php echo $maDe; ?></div>
        </div>
    </footer>

    <script>
        function toggleForm() {
            var form = document.getElementById('formThemSP');
            var icon = document.getElementById('toggleIcon');
            if (form.style.maxHeight === '0px' || form.style.maxHeight === '') {
                form.style.maxHeight = form.scrollHeight + 'px';
                form.style.opacity = '1';
                icon.style.transform = 'rotate(180deg)';
            } else {
                form.style.maxHeight = '0px';
                form.style.opacity = '0';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
