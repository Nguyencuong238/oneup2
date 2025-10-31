@extends('layouts.front')

@section('meta')
    <title>Điều khoản dịch vụ - OneUp KOL Analytics</title>
    <meta name="description" content="Điều khoản & điều kiện sử dụng dịch vụ của OneUp KOL Analytics.">
@endsection

@section('page')
<style>
    body {
        font-family: "Segoe UI", Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.7;   
    }

    .terms-wrapper {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    /* Sidebar */
    .terms-sidebar {
        width: 280px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 20px 0;
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .terms-sidebar h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111;
        text-transform: uppercase;
        padding: 0 20px;
        margin-bottom: 10px;
    }

    .terms-sidebar ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .terms-sidebar li {
        margin-bottom: 6px;
    }

    .terms-sidebar a {
        display: block;
        padding: 8px 20px;
        text-decoration: none;
        color: #333;
        border-left: 3px solid transparent;
        transition: all 0.2s;
    }

    .terms-sidebar a:hover,
    .terms-sidebar a.active {
        background-color: #f1f5f9;
        border-left-color: #007bff;
        color: #007bff;
    }

    /* Content */
    .terms-content {
        flex: 1;
        background: #fff;
        padding: 40px 50px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .terms-content h2 {
        text-align: center;
        font-size: 36px;
        font-weight: 700;
        color: #222;
        margin-bottom: 40px;
        text-transform: uppercase;
    }

    .terms-content h3 {
        font-size: 22px;
        font-weight: 600;
        color: #111;
        margin-top: 30px;
    }

    .terms-content p {
        margin-bottom: 10px;
    }

    .terms-content ul {
        margin-left: 25px;
        margin-bottom: 20px;
    }

    .note-box {
        background: #f1f5f9;
        border-left: 4px solid #007bff;
        padding: 20px;
        border-radius: 6px;
        margin-top: 30px;
    }

    .text-black{
        color: black;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .terms-wrapper {
            flex-direction: column;
        }
        .terms-sidebar {
            width: 100%;
            position: relative;
            top: 0;
        }
    }
</style>

<section class="terms-wrapper">

    <!-- Sidebar -->
    <aside class="terms-sidebar">
        <h3>I. Điều khoản sử dụng</h3>
        <ul>
            <li><a href="#agree">1. Đồng ý “Thỏa thuận Sử Dụng”</a></li>
            <li><a href="#definition">2. Định nghĩa chung</a></li>
            <li><a href="#register">3. Đăng ký tài khoản</a></li>
            <li><a href="#package">4. Đăng ký gói</a></li>
            <li><a href="#payment">5. Thanh toán</a></li>
            <li><a href="#ads">6. Về quảng cáo</a></li>
            <li><a href="#end">7. Chấm dứt sử dụng</a></li>
        </ul>

        <h3>II. Bảo mật thông tin</h3>
        <ul>
            <li><a href="#security">1. Cam kết bảo mật</a></li>
            <li><a href="#user-rights">2. Quyền của người dùng</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <div class="terms-content">
        <h2>Điều khoản dịch vụ</h2>

        <h3 id="agree">1. Đồng ý “Thỏa thuận Sử Dụng”</h3>
        <p class="text-black">Bằng việc tạo tài khoản và nhấn “Đồng ý”, bạn xác nhận đã đọc, hiểu và đồng ý tuân thủ toàn bộ nội dung của thỏa thuận này.</p>
        <p class="text-black">Nếu không đồng ý, vui lòng ngừng sử dụng nền tảng OneUp ngay lập tức.</p>

        <h3 id="definition">2. Định nghĩa chung</h3>
        <ul>
            <li><strong>OneUp:</strong> Nền tảng phân tích KOL Creator Community tại Việt Nam.</li>
            <li><strong>Tài khoản:</strong> Là tài khoản định danh do người dùng đăng ký bằng email hoặc số điện thoại.</li>
        </ul>

        <h3 id="register">3. Đăng ký tài khoản</h3>
        <p class="text-black">Người dùng phải cung cấp thông tin chính xác và chịu trách nhiệm bảo mật tài khoản.</p>

        <h3 id="package">4. Đăng ký gói dịch vụ</h3>
        <p class="text-black">Khách hàng cần kiểm tra thông tin gói, quyền lợi và thời hạn trước khi thanh toán.</p>

        <h3 id="payment">5. Thanh toán</h3>
        <p class="text-black">Dịch vụ được kích hoạt sau khi nhận đủ thanh toán. Phí đã thanh toán không hoàn lại trừ khi có thỏa thuận khác.</p>

        <h3 id="ads">6. Về quảng cáo</h3>
        <p class="text-black">Dựa trên thông tin người dùng cung cấp, OneUp có thể gửi thông tin khuyến mãi, ưu đãi hoặc cập nhật dịch vụ qua email, SMS, Zalo,...</p>
        <p class="text-black">OneUp và các đối tác truyền thông có quyền khai thác hợp pháp các kênh quảng bá dịch vụ theo quy định pháp luật.</p>

        <h3 id="end">7. Chấm dứt sử dụng dịch vụ</h3>
        <p class="text-black">OneUp có quyền khóa hoặc chấm dứt tài khoản nếu người dùng vi phạm điều khoản, gian lận hoặc ảnh hưởng đến quyền lợi người khác.</p>

        <h3 id="security">8. Bảo mật thông tin</h3>
        <p class="text-black">OneUp cam kết bảo vệ dữ liệu cá nhân của người dùng bằng các biện pháp kỹ thuật và tổ chức an toàn.</p>

        <h3 id="user-rights">9. Quyền của người dùng</h3>
        <p class="text-black">Người dùng có quyền yêu cầu xem, chỉnh sửa hoặc xóa dữ liệu cá nhân bằng cách liên hệ qua email: contact@oneup.vn</p>

        <div class="note-box">
            <strong>Lưu ý:</strong> Việc tiếp tục sử dụng nền tảng sau khi có các thay đổi trong điều khoản đồng nghĩa với việc bạn chấp nhận các điều chỉnh đó.
        </div>
    </div>
</section>

<script>
// Kích hoạt menu khi cuộn tới section
document.addEventListener("scroll", () => {
    const sections = document.querySelectorAll(".terms-content h3[id]");
    let current = "";
    sections.forEach(section => {
        const top = section.offsetTop - 150;
        if (scrollY >= top) current = section.getAttribute("id");
    });
    document.querySelectorAll(".terms-sidebar a").forEach(a => {
        a.classList.remove("active");
        if (a.getAttribute("href") === `#${current}`) a.classList.add("active");
    });
});
</script>
@endsection
