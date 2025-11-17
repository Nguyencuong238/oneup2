<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CampaignCreatorsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function collection()
    {
        return $this->campaign->kols->map(function ($kol) {
            return [
                'Tên nhà sáng tạo' => $kol->display_name,
                'Tài khoản TikTok' => $kol->tiktok_username ?? 'N/A',
                'Số lượng người theo dõi' => $kol->followers ?? 0,
                'Tỷ lệ tương tác' => ($kol->engagement ?? 0) . '%',
                'Danh mục' => $kol->category->name ?? 'N/A',
                'Giá ước tính' => '₫' . number_format($kol->price_campaign ?? 0, 0, ',', '.'),
                'Liên hệ' => $kol->phone ?? 'N/A',
                'Email' => $kol->email ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tên nhà sáng tạo',
            'Tài khoản TikTok',
            'Số lượng người theo dõi',
            'Tỷ lệ tương tác',
            'Danh mục',
            'Giá ước tính',
            'Liên hệ',
            'Email',
        ];
    }

    public function styles($sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0066FF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Auto-size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Center align data
        $sheet->getStyle('A2:H' . ($this->campaign->kols->count() + 1))
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        return [];
    }
}
