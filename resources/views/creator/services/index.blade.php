@extends('layouts.creator_master')

@section('meta')
    <meta name="description" content="Quản lý dịch vụ OneUp - Theo dõi và quản lý các chiến dịch KOL TikTok của bạn">
    <title>Dịch vụ - OneUp KOL Analytics</title>
@endsection

@section('page')
<div class="creator-container">
    <div class="page-header">
        <h2>Danh sách dịch vụ</h2>
        <button class="btn btn-primary" onclick="openModal()">+ Thêm dịch vụ</button>
        <div class="menu-toggle" onclick="$('.sidebar').toggleClass('active');">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="service-table">
            <thead>
                <tr>
                    <th style="color: black">#</th>
                    <th style="color: black">Ảnh</th>
                    <th style="color: black">Tên dịch vụ</th>
                    <th style="color: black">Mô tả</th>
                    <th style="color: black">Giá (VNĐ)</th>
                    <th style="color: black">Ngày tạo</th>
                    <th style="text-align:center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $index => $service)
                <tr>
                    <td style="color: black; padding-top: 30px">{{ $index + 1 }}</td>
                    <td>
                        @if($service->image)
                            <img src="{{ $service->image }}" alt="thumb" style="width:80px;height:56px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:80px;height:56px;background:#f0f2f5;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">
                                No image
                            </div>
                        @endif
                    </td>
                    <td style="color: black; padding-top: 30px">{{ $service->name }}</td>
                    <td style="color: black; padding-top: 30px">{{ $service->description }}</td>
                    <td style="color: black; padding-top: 30px">{{ number_format($service->price) }}</td>
                    <td style="color: black; padding-top: 30px">{{ $service->created_at->format('d/m/Y') }}</td>
                    <td class="text-center" style="color: black; padding-top: 30px">
                        <button class="btn btn-edit" onclick="editService({{ $service->id }}, '{{ addslashes($service->name) }}', '{{ addslashes($service->description) }}', {{ $service->price }})">Sửa</button>
                        <form action="{{ route('creator.services.delete', $service->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Bạn có chắc muốn xóa dịch vụ này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color: black">Chưa có dịch vụ nào được thêm.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal thêm/sửa --}}
<div id="serviceModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle" style="color: black">Thêm dịch vụ</h3>
        <form id="serviceForm" method="POST" action="{{ route('creator.services.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="service_id">
            <div class="form-group">
                <label style="color: black">Tên dịch vụ</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label style="color: black">Mô tả</label>
                <textarea name="description" id="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label style="color: black">Giá (VNĐ)</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label style="color: black">Ảnh (tùy chọn)</label>
                <input type="file" name="image" id="imageInput" accept="image/*">
                <div id="previewWrap" style="margin-top:8px;display:none;">
                    <img id="previewImg" src="" style="max-width:160px;max-height:120px;border-radius:6px;object-fit:cover;border:1px solid #eee;">
                    <button type="button" onclick="removePreview()" class="btn btn-secondary" style="margin-left:8px;padding:6px 8px;font-size:12px;">Xóa ảnh</button>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Hủy</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
    <style>
    .creator-container {
        padding: 30px;
        background: #f5f7fa;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-size: 22px;
        color: #222;
    }

    .table-wrapper {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow-x: auto;
    }

    .creator-container {
        margin-left: 260px; /* bằng chiều rộng sidebar */
        padding: 30px;
        background: #f5f7fa;
        min-height: 100vh;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .service-table th, .service-table td {
        border-bottom: 1px solid #eee;
        padding: 12px 10px;
        vertical-align: top;
    }

    .service-table th {
        background: #f0f2f5;
        font-weight: 600;
        color: #333;
        text-align: left;
    }

    .service-table tbody tr:hover {
        background: #f9fbff;
    }

    .text-center {
        text-align: center;
    }

    .inline-form {
        display: inline-block;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #fff;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        width: 400px;
        animation: fadeIn 0.2s ease;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .modal-actions {
        text-align: right;
        margin-top: 15px;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-10px);}
        to {opacity: 1; transform: translateY(0);}
    }

    /* ================== Responsive ================== */

/* Mobile-first: xử lý màn hình dưới 768px */
    @media (max-width: 768px) {
    .creator-container {
        margin-left: 0 !important;
        padding: 15px;
    }

    .page-header {
        gap: 12px;
    }

    .page-header h2 {
        font-size: 18px;
    }

    .btn.btn-primary {
        width: 100%;
        font-size: 14px;
        padding: 10px;
    }

    /* Table scroll */
    .table-wrapper {
        padding: 10px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .service-table {
        min-width: 650px; /* cho phép cuộn ngang */
        font-size: 13px;
    }

    .service-table th, .service-table td {
        padding: 8px 6px;
    }

    .service-table img {
        width: 60px;
        height: 40px;
    }

    /* Nút hành động nhỏ gọn */
    .btn {
        font-size: 12px;
        padding: 4px 8px;
    }

    .inline-form {
        display: block;
        margin-top: 4px;
    }

    /* Modal co giãn toàn màn hình nhỏ */
    .modal-content {
        width: 90%;
        max-width: 400px;
        margin: 0 5%;
        padding: 20px;
    }

    .form-group input,
    .form-group textarea {
        font-size: 14px;
        padding: 6px;
    }
}
/* Tablet (768px - 1024px) */
    @media (max-width: 1024px) and (min-width: 769px) {
        .creator-container {
            margin-left: 200px;
            padding: 20px;
        }

        .page-header h2 {
            font-size: 20px;
        }

        .service-table th, .service-table td {
            padding: 10px 8px;
        }

        .modal-content {
            width: 70%;
        }
    }
    </style>
@endsection

@section('js')
    <script>
    function openModal() {
        document.getElementById('serviceModal').style.display = 'flex';
        document.getElementById('modalTitle').innerText = 'Thêm dịch vụ';
        document.getElementById('serviceForm').action = "{{ route('creator.services.store') }}";
        document.getElementById('name').value = '';
        document.getElementById('description').value = '';
        document.getElementById('price').value = '';
        document.getElementById('service_id').value = '';
        clearPreview();
    }

    function closeModal() {
        document.getElementById('serviceModal').style.display = 'none';
    }

    function editService(id, name, description, price, image) {
        document.getElementById('serviceModal').style.display = 'flex';
        document.getElementById('modalTitle').innerText = 'Chỉnh sửa dịch vụ';
        document.getElementById('serviceForm').action = `/creator/services/${id}/update`;
        document.getElementById('name').value = name || '';
        document.getElementById('description').value = description || '';
        document.getElementById('price').value = price || '';
        document.getElementById('service_id').value = id;
        if (image) {
            showPreview(image);
        } else {
            clearPreview();
        }
    }

    const imageInput = document.getElementById('imageInput');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                showPreview(ev.target.result);
            };
            reader.readAsDataURL(file);
        });
    }

    function showPreview(src) {
        const wrap = document.getElementById('previewWrap');
        const img = document.getElementById('previewImg');
        img.src = src;
        wrap.style.display = 'block';
    }

    function clearPreview() {
        const wrap = document.getElementById('previewWrap');
        const img = document.getElementById('previewImg');
        img.src = '';
        wrap.style.display = 'none';
        if (imageInput) imageInput.value = '';
    }

    function removePreview() {
        clearPreview();
    }
    </script>
@endsection
