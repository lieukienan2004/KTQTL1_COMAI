<?php
/**
 * Trang chi tiết sản phẩm
 * Mã đề: 14
 * MSSV: 110122028
 */

include '14_ketnoi_110122028.php';

// Thông tin sinh viên
$maDe = "14";
$mssv = "110122028";
$hoTen = "Liễu Kiện An";
$lop = "DA22TTD";

// Lấy id sản phẩm từ URL
$idSanPham = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin sản phẩm
$sqlSanPham = "SELECT sp.*, lsp.tenLoai, kt.size, gh.tenGianHang 
               FROM sanpham sp 
               JOIN loaisanpham lsp ON sp.maLoai = lsp.maLoai 
               JOIN kichthuoc kt ON sp.idSize = kt.idSize 
               JOIN gianhang gh ON sp.idGianHang = gh.idGianHang
               WHERE sp.idSanPham = ? AND sp.isDelete = 0";
$stmt = $conn->prepare($sqlSanPham);
$stmt->bind_param("i", $idSanPham);
$stmt->execute();
$result = $stmt->get_result();
$sanPham = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sanPham ? $sanPham['tenSanPham'] : 'Không tìm thấy'; ?> - Mã đề <?php echo $maDe; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0077be 0%, #00a8e8 100%);
            min-height: 100vh;
        }
        header {
            background: linear-gradient(90deg, #1a1a2e, #16213e);
            color: white; padding: 20px; text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        header h1 { font-size: 28px; margin-bottom: 10px; color: #f39c12; }
        header .info { font-size: 14px; color: #ecf0f1; }
        header .info span {
            margin: 0 15px; padding: 5px 10px;
            background: rgba(255,255,255,0.1); border-radius: 5px;
        }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .product-detail {
            background: white; border-radius: 15px; padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
        }
        .product-image img {
            width: 100%; height: 400px; object-fit: cover; border-radius: 12px;
        }
        .product-info h2 { color: #2c3e50; font-size: 28px; margin-bottom: 15px; }
        .product-info .price {
            color: #e74c3c; font-size: 32px; font-weight: bold; margin: 20px 0;
        }
        .product-info .description {
            color: #7f8c8d; font-size: 16px; line-height: 1.8; margin: 20px 0;
            padding: 15px; background: #f8f9fa; border-radius: 8px;
        }
        .info-row { display: flex; margin: 10px 0; align-items: center; }
        .info-row .label {
            width: 120px; font-weight: 600; color: #34495e;
        }
        .info-row .value { color: #2c3e50; }
        .badge {
            display: inline-block; padding: 8px 15px; border-radius: 20px;
            font-size: 14px; margin-right: 10px; margin-top: 15px;
        }
        .badge-loai { background: #3498db; color: white; }
        .badge-size { background: #9b59b6; color: white; }
        .badge-shop { background: #27ae60; color: white; }
        .btn-back {
            display: inline-block; background: #3498db; color: white;
            padding: 12px 30px; border-radius: 8px; text-decoration: none;
            margin-top: 25px; transition: all 0.3s;
        }
        .btn-back:hover { background: #2980b9; transform: translateY(-2px); }
        .not-found {
            background: white; border-radius: 15px; padding: 60px;
            text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .not-found h2 { color: #e74c3c; margin-bottom: 20px; }
        footer {
            background: linear-gradient(90deg, #1a1a2e, #16213e);
            color: white; padding: 30px 20px; text-align: center; margin-top: 30px;
        }
        footer h3 { color: #f39c12; margin-bottom: 20px; font-size: 22px; }
        .footer-grid {
            display: flex; justify-content: center; gap: 15px;
            margin-bottom: 25px; flex-wrap: wrap;
        }
        .footer-item {
            background: rgba(255,255,255,0.1); padding: 15px 25px;
            border-radius: 8px; min-width: 180px; text-align: center;
        }
        .footer-label {
            display: block; color: #f39c12; font-size: 11px;
            margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;
        }
        .footer-value { color: #fff; font-size: 14px; font-weight: 500; }
        footer .ma-de {
            display: inline-block; background: #e74c3c; padding: 12px 35px;
            border-radius: 8px; font-weight: bold; font-size: 15px;
        }
        @media (max-width: 768px) {
            .product-detail { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <h1>GIAN HÀNG HANDMADE</h1>
        <div class="info">
            <span>Họ tên: <?php echo $hoTen; ?></span>
            <span>MSSV: <?php echo $mssv; ?></span>
            <span>Lớp: <?php echo $lop; ?></span>
            <span>Mã đề: <?php echo $maDe; ?></span>
        </div>
    </header>

    <div class="container">
        <?php if ($sanPham): ?>
        <div class="product-detail">
            <div class="product-image">
                <img src="<?php echo $sanPham['hinhSanPham']; ?>" alt="<?php echo $sanPham['tenSanPham']; ?>">
            </div>
            <div class="product-info">
                <h2><?php echo $sanPham['tenSanPham']; ?></h2>
                <p class="price"><?php echo number_format($sanPham['gia'], 0, ',', '.'); ?> VNĐ</p>
                
                <div class="info-row">
                    <span class="label">Số lượng:</span>
                    <span class="value"><?php echo $sanPham['soLuong']; ?> sản phẩm</span>
                </div>
                
                <div class="description">
                    <strong>Mô tả:</strong><br>
                    <?php echo $sanPham['moTa'] ? $sanPham['moTa'] : 'Chưa có mô tả'; ?>
                </div>
                
                <span class="badge badge-loai"><?php echo $sanPham['tenLoai']; ?></span>
                <span class="badge badge-size"><?php echo $sanPham['size']; ?></span>
                <span class="badge badge-shop"><?php echo $sanPham['tenGianHang']; ?></span>
                
                <br>
                <a href="14_themsanpham_110122028.php?gianhang=<?php echo $sanPham['idGianHang']; ?>" class="btn-back">
                    ← Quay lại danh sách
                </a>
            </div>
        </div>
        <?php else: ?>
        <div class="not-found">
            <h2>Không tìm thấy sản phẩm!</h2>
            <p>Sản phẩm bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <a href="14_themsanpham_110122028.php" class="btn-back">← Quay lại trang chủ</a>
        </div>
        <?php endif; ?>
    </div>

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
</body>
</html>
<?php $conn->close(); ?>
