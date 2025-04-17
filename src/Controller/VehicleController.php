<?php

namespace App\Controller;

use App\Export\DataProvider\VehicleDataProvider;
use App\Export\ExportDataset;
use App\Export\Exporter\XlsxExporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vehicles')]
class VehicleController extends AbstractController
{
    #[Route('/export', name: 'vehicle_export')]
    public function export(
        VehicleDataProvider $vehicleDataProvider,
        XlsxExporter $xlsxExporter
    ): Response
    {
        $data = $vehicleDataProvider->getData();
        $dataset = new ExportDataset($data);
        $result = $xlsxExporter->export($dataset);

        $response = $this->file($result->filePath);
        $response->headers->set('Content-Type', $result->mimeType);

        return $response;
    }
}
