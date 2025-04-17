<?php

namespace App\Export\Exporter;

use App\Export\ExportDataset;
use App\Export\ExportFieldType;
use App\Export\ExportResult;
use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class XlsxExporter implements ExporterInterface
{
    const MIME_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    protected function mapToDataType(ExportFieldType $type): string
    {
        return match ($type) {
            ExportFieldType::STRING => DataType::TYPE_STRING,
            ExportFieldType::INTEGER => DataType::TYPE_NUMERIC,
            ExportFieldType::FLOAT => DataType::TYPE_NUMERIC,
            ExportFieldType::BOOLEAN => DataType::TYPE_BOOL,
            ExportFieldType::DATE => DataType::TYPE_STRING,
            ExportFieldType::DATETIME => DataType::TYPE_STRING,
            default => DataType::TYPE_STRING,
        };
    }

    public function export(ExportDataset $data): ExportResult
    {
        $items = $data->items;

        $headers = [];
        foreach ($items as $item) {
            if (empty($headers)) {
                foreach ($item->fields as $field) {
                    $headers[] = $field->label;
                }
            }
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        foreach ($headers as $columnIndex => $header) {
            $sheet->setCellValue([$columnIndex + 1, 1], $header);
        }

        // Set data
        foreach ($items as $rowIndex => $item) {
            foreach ($item->fields as $columnIndex => $field) {
                $sheet->setCellValueExplicit(
                    CellAddress::fromColumnRowArray([$columnIndex + 1, $rowIndex + 2], $sheet),
                    $field->value,
                    $this->mapToDataType($field->type)
                );
            }
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filePath = './exported_data.xlsx';
        $writer->save($filePath);

        return new ExportResult($filePath, self::MIME_TYPE);
    }
}
