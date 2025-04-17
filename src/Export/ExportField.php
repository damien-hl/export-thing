<?php

namespace App\Export;

class ExportField
{
    public function __construct(
        public string $label,
        public mixed $value,
        public ExportFieldType $type = ExportFieldType::STRING
    ) {}
}
