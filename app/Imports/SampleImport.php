<?php

namespace App\Imports;

use App\Models\Provincia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SampleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Provincia([
            'nombre' => $row['nombre'],
            'id_pais' => $row['id_pais'],
        ]);
    }
}
