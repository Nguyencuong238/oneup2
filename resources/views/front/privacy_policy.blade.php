@extends('layouts.front')

@section('meta')
<title>Chính sách bảo mật - OneUp KOL Analytics</title>
<meta name="description" content="Chính sách bảo mật và quy định truyền thông của OneUp Việt Nam">
@endsection

@section('page')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #fff;
        color: #333;
    }

    .policy-container {
        display: flex;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Sidebar */
    .policy-sidebar {
        width: 30%;
        border-right: 1px solid #ccc;
        padding-right: 20px;
        overflow-y: auto;
        max-height: 90vh;
    }

    .policy-sidebar h3 {
        font-size: 16px;
        margin-top: 20px;
        margin-bottom: 10px;
        color: #111;
    }

    .policy-sidebar ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .policy-sidebar li {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        color: #333;
        transition: background-color 0.2s;
    }

    .policy-sidebar li:hover {
        background-color: #f5f5f5;
    }

    .policy-sidebar li.active {
        background-color: #e3f3eb;
        font-weight: bold;
    }

    /* Content */
    .policy-content {
        width: 70%;
        overflow-y: auto;
        max-height: 90vh;
        padding-left: 10px;
    }

    .policy-content h2 {
        font-size: 22px;
        color: #222;
        margin-top: 0;
    }

    .policy-content h3 {
        font-size: 18px;
        margin-top: 25px;
        color: #444;
    }

    .policy-content p,
    .policy-content li {
        line-height: 1.6;
        color: #555;
    }

    .policy-content ul {
        padding-left: 20px;
    }

    .contact-info {
        background: #f9f9f9;
        border-left: 4px solid #00b98b;
        padding: 15px;
        margin-top: 25px;
        border-radius: 5px;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background-color: #999;
    }
</style>

<div class="policy-container">
    <!-- Sidebar -->
    <div class="policy-sidebar">
        <h3>I. Chính sách bảo mật</h3>
        <ul>
            <li data-target="section1" class="active">1. Mục đích thu thập thông tin</li>
            <li data-target="section2">2. Phạm vi sử dụng</li>
            <li data-target="section3">3. Bảo mật dữ liệu</li>
            <li data-target="section4">4. Quyền của người dùng</li>
        </ul>

        <h3>II. Quy định truyền thông</h3>
        <ul>
            <li data-target="section5">1. Nguyên tắc chung</li>
            <li data-target="section6">2. Nội dung truyền thông</li>
            <li data-target="section7">3. Trách nhiệm của đối tác</li>
        </ul>
    </div>

    <!-- Content -->
    <div class="policy-content">
        <section id="section1">
            <h2>CHÍNH SÁCH BẢO MẬT</h2>
            <h3>1. Mục đích thu thập thông tin</h3>
            <ul>
                <li>OneUp thu thập thông tin cá nhân của người dùng (họ tên, email, số điện thoại, dữ liệu truy cập) để:</li>
                <li>Cung cấp dịch vụ tốt hơn</li>
                <li>Gửi thông báo, chăm sóc khách hàng, hỗ trợ kỹ thuật</li>
                <li>Cải thiện trải nghiệm người dùng và tối ưu nền tảng</li>
            </ul>
        </section>

        <section id="section2">
            <h3>2. Phạm vi sử dụng</h3>
            <ul>
                <li>Thông tin của người dùng chỉ được sử dụng trong nội bộ OneUp và không chia sẻ cho bên thứ ba trừ khi:</li>
                <li>Có sự đồng ý của khách hàng</li>
                <li>Theo yêu cầu của cơ quan nhà nước có thẩm quyền</li>
            </ul>
        </section>

        <section id="section3">
            <h3>3. Bảo mật dữ liệu</h3>
            <p>OneUp cam kết bảo mật tuyệt đối thông tin cá nhân bằng các biện pháp kỹ thuật hiện đại, mã hóa và phân quyền truy cập nghiêm ngặt.  
            Trong trường hợp có rủi ro kỹ thuật, OneUp sẽ thông báo kịp thời để người dùng phối hợp xử lý.</p>
        </section>

        <section id="section4">
            <h3>4. Quyền của người dùng</h3>
            <ul>
                <li>Cập nhật, chỉnh sửa hoặc yêu cầu xóa thông tin cá nhân</li>
                <li>Khiếu nại về việc thu thập và sử dụng thông tin</li>
                <li>Mọi yêu cầu được tiếp nhận qua email: <strong>contact@oneup.vn</strong></li>
            </ul>
        </section>

        <section id="section5">
            <h2>QUY ĐỊNH TRUYỀN THÔNG</h2>
            <h3>1. Nguyên tắc chung</h3>
            <ul>
                <li>Mọi hoạt động truyền thông, quảng bá, PR hoặc hợp tác Nhà sáng tạo nội dung do OneUp hoặc đối tác triển khai đều phải tuân thủ:</li>
                <li>Quy định pháp luật Việt Nam</li>
                <li>Chính sách đạo đức và bảo mật của OneUp</li>
            </ul>
        </section>

        <section id="section6">
            <h3>2. Nội dung truyền thông</h3>
            <ul>
                <li>Không sử dụng ngôn từ gây hiểu nhầm, kích động hoặc vi phạm thuần phong mỹ tục</li>
                <li>Không lạm dụng thương hiệu OneUp cho mục đích cá nhân</li>
                <li>Khi sử dụng logo, hình ảnh, tên thương mại “OneUp”, phải có sự chấp thuận bằng văn bản của công ty</li>
            </ul>
        </section>

        <section id="section7">
            <h3>3. Trách nhiệm của đối tác</h3>
            <p>Đối tác và người sáng tạo nội dung (Nhà sáng tạo nội dung, agency, cộng tác viên) có trách nhiệm đảm bảo nội dung đăng tải không vi phạm quyền sở hữu trí tuệ, không bịa đặt, xuyên tạc hoặc gây ảnh hưởng tiêu cực đến uy tín của OneUp.</p>

            <div class="contact-info">
                <p><strong>Thông tin liên hệ</strong></p>
                <p>Công ty Cổ phần OneUp Việt Nam<br>
                📍 Địa chỉ: [Cập nhật địa chỉ trụ sở chính]<br>
                🌐 Website: <a href="https://oneup.vn" target="_blank">https://oneup.vn</a><br>
                📧 Email: <a href="mailto:contact@oneup.vn">contact@oneup.vn</a></p>
            </div>
        </section>
    </div>
</div>

<script>
    // cuộn mượt + highlight sidebar
    const sidebarItems = document.querySelectorAll('.policy-sidebar li');
    const sections = document.querySelectorAll('.policy-content section');

    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            const targetId = item.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
            sidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
</script>
@endsection
