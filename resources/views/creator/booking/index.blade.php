@extends('layouts.creator_master')

@section('meta')
    <meta name="description" content="Danh sách booking - OneUp KOL Analytics">
    <title>Booking - OneUp KOL Analytics</title>
@endsection

@section('page')
<div class="creator-container">
    <div class="page-header">
        <h2>Danh sách Booking</h2>
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
                    <th style="color:black">#</th>
                    <th style="color:black">Người đặt</th>
                    <th style="color:black">Dịch vụ</th>
                    <th style="color:black">Ghi chú</th>
                    <th style="color:black">Trạng thái</th>
                    <th style="color:black">Ngày đặt</th>
                    <th style="text-align:center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $index => $booking)
                <tr>
                    <td style="color:black; padding-top:25px">{{ $index + 1 }}</td>
                    <td style="color:black; padding-top:25px">
                        {{ $booking->user->name ?? 'Người dùng ẩn' }}<br>
                        <small style="color:#777;">ID: {{ $booking->user->id ?? 'N/A' }}</small>
                    </td>
                    <td style="color:black; padding-top:25px">
                        {{ $booking->service->name ?? '(Đã xóa)' }}
                    </td>
                    <td style="color:black; padding-top:25px">{{ $booking->note ?: '—' }}</td>
                    <td style="color:black; padding-top:25px">
                        @if ($booking->status === 'pending')
                            <span style="color:#ff9800;">Chờ duyệt</span>
                        @elseif ($booking->status === 'approved')
                            <span style="color:#4caf50;">Đã duyệt</span>
                        @elseif ($booking->status === 'rejected')
                            <span style="color:#f44336;">Từ chối</span>
                        @else
                            <span style="color:#777;">{{ ucfirst($booking->status) }}</span>
                        @endif
                    </td>
                    <td style="color:black; padding-top:25px">
                        {{ $booking->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="text-center" style="padding-top:25px">
                        @if($booking->status === 'pending')
                            <form action="{{ route('creator.bookings.update', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary">Duyệt</button>
                            </form>

                            <form action="{{ route('creator.bookings.update', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">Từ chối</button>
                            </form>
                        @else
                            <span class="badge {{ $booking->status == 'approved' ? 'badge-success' : 'badge-danger' }}">
                                {{ $booking->status == 'approved' ? 'Chấp nhận' : 'Từ chối' }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:black;">Chưa có booking nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
    <style>
    /* ======= Layout cơ bản ======= */
    .creator-container {
        padding: 30px;
        background: #f5f7fa;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    /* Nếu bạn có sidebar cố định bên trái */
    @media (min-width: 992px) {
        .creator-container {
            margin-left: 260px; /* bằng chiều rộng sidebar */
        }
    }

    /* ======= Header ======= */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-header h2 {
        font-size: 22px;
        color: #222;
        margin: 0;
    }

    /* ======= Bảng ======= */
    .table-wrapper {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow-x: auto;
        width: 100%;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        min-width: 800px; /* tránh co bảng */
    }

    .service-table th,
    .service-table td {
        border-bottom: 1px solid #eee;
        padding: 12px 10px;
        vertical-align: middle;
        color: #333;
    }

    .service-table th {
        background: #f0f2f5;
        font-weight: 600;
        text-align: left;
    }

    .service-table tbody tr:hover {
        background: #f9fbff;
    }

    /* ======= Nút ======= */
    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
        white-space: nowrap;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .inline-form {
        display: inline-block;
    }

    /* ======= Responsive ======= */
    @media (max-width: 991px) {
        .creator-container {
            margin-left: 0 !important;
            padding: 20px;
        }

        .service-table {
            font-size: 13px;
            min-width: 100%;
        }

        .table-wrapper {
            padding: 15px;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
        }
    }

    @media (max-width: 575px) {
        .page-header h2 {
            font-size: 18px;
        }

        .table-wrapper {
            padding: 10px;
        }

        .service-table th,
        .service-table td {
            padding: 8px 6px;
        }

        .btn {
            font-size: 12px;
            padding: 4px 8px;
        }
    }
    </style>
@endsection

