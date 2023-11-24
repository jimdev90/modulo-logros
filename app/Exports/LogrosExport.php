<?php

namespace App\Exports;

use App\Models\CriminalGroup;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogrosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CriminalGroup::all();
    }
}
