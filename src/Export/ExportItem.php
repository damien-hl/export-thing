<?php

namespace App\Export;

class ExportItem
{
    /**
     * @param ExportField[] $fields
     */
    public function __construct(
        public array $fields,
    ) {}
}
