<?php

namespace App\Exports;

use App\Models\CriminalGroup;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LogrosExport implements FromView
{
    protected $dataCountCriminalGroups;
    protected $dataCountCurrencies;
    protected $dataCountDrug;
    protected $dataCountExplosives;
    protected $dataCountFireArms;
    protected $dataCountFuels;
    protected $dataCountOthers;
    protected $dataCountPersons;
    protected $date;
    protected $dateNext;
    protected $unidad;
    public function __construct(
        $dataCountCriminalGroups,
        $dataCountCurrencies,
        $dataCountDrug,
        $dataCountExplosives,
        $dataCountFireArms,
        $dataCountFuels,
        $dataCountOthers,
        $dataCountPersons,
        $date,
        $dateNext,
        $unidad
    )
    {
        $this->dataCountCriminalGroups = $dataCountCriminalGroups;
        $this->dataCountCurrencies = $dataCountCurrencies;
        $this->dataCountDrug = $dataCountDrug;
        $this->dataCountExplosives = $dataCountExplosives;
        $this->dataCountFireArms = $dataCountFireArms;
        $this->dataCountFuels = $dataCountFuels;
        $this->dataCountOthers = $dataCountOthers;
        $this->dataCountPersons = $dataCountPersons;
        $this->date = $date;
        $this->dateNext = $dateNext;
        $this->unidad = $unidad;
    }


    public function view(): View
    {
        return view('reports.report-view', [
            'criminal_groups' => $this->dataCountCriminalGroups,
            'currencies' => $this->dataCountCurrencies,
            'drugs' => $this->dataCountDrug,
            'explosives' => $this->dataCountExplosives,
            'firearms' => $this->dataCountFireArms,
            'fuels' => $this->dataCountFuels,
            'others' => $this->dataCountOthers,
            'persons' => $this->dataCountPersons,
            'date' => $this->date,
            'dateNext' => $this->dateNext,
            'unidad' => $this->unidad
        ]);
    }
}
