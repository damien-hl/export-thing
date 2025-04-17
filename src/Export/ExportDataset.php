<?php

namespace App\Export;

class ExportDataset
{
    /**
     * @param ExportItem[] $items
     */
    public function __construct(
        public array $items,
    ) {}
}
