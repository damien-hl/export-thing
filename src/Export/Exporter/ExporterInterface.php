<?php

namespace App\Export\Exporter;

use App\Export\ExportDataset;
use App\Export\ExportResult;

interface ExporterInterface
{
    public function export(ExportDataset $data): ExportResult;
}
