<?php

namespace App\Export;

class ExportResult
{
    public function __construct(
        public readonly string $filePath,
        public readonly string $mimeType,
    ) {}
}
