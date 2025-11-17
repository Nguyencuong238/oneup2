<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KolImportTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        // Return example data - users should replace with their actual KOL names
        return [
            ['nguyenvana', 'Nguyễn Văn A', '0901234567', 'Beauty & Fashion'],
            ['tranthib', 'Trần Thị B', '0987654321', 'Food & Lifestyle'],
        ];
    }

    public function headings(): array
    {
        return [
            'Tên nhà sáng tạo nội dung *',
            'Tên đầy đủ (không bắt buộc)',
            'Số điện thoại (không bắt buộc)',
            'Danh mục (không bắt buộc)',
        ];
    }

    public function styles($sheet)
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
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
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Center align header
        $sheet->getStyle('A1:D1')->getAlignment()->setWrapText(true);

        return [];
    }
}
