<?php

namespace App\Export\DataProvider;

use App\Export\ExportItem;

interface DataProviderInterface
{
    /**
     * @return ExportItem[]
     */
    public function getData(): array;
}
