<?php

namespace App\Export\DataProvider;

use App\Export\ExportField;
use App\Export\ExportItem;
use App\Model\Vehicle;
use Symfony\Bundle\SecurityBundle\Security;

class VehicleDataProvider implements DataProviderInterface
{
    public function __construct(
        private Security $security,
    ) {}

    /**
     * @param Vehicle[] $vehicles
     */
    protected function fetchData(): array
    {
        return [    
            new Vehicle('AB-123-CD', 'VN1234567891011CD', 'Toyota', 'Corolla', '2020', 'Red'),
            new Vehicle('EF-456-GH', 'VN1234567891012CD', 'Renault', 'Clio', '2022', 'Blue'),
        ];
    }

    /**
     * @return ExportItem[]
     */
    public function getData(): array
    {
        $user = $this->security->getUser();

        return array_map(
            function (Vehicle $vehicle) use ($user) {
                /** @var ExportField[] */
                $fields = [];

                $fields[] = new ExportField('licensePlate', $vehicle->licensePlate);
                // Show/hide vehicle fields based on user roles
                if (null !== $user && in_array('ROLE_ADMIN', $user->getRoles())) {
                    $fields[] = new ExportField('vin', $vehicle->vin);
                }
                $fields[] = new ExportField('make', $vehicle->make);
                $fields[] = new ExportField('model', $vehicle->model);
                $fields[] = new ExportField('year', $vehicle->year);
                $fields[] = new ExportField('color', $vehicle->color);

                return new ExportItem($fields);
            },
            $this->fetchData()
        );
    }
}
