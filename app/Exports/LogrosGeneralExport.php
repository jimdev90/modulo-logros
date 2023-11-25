<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LogrosGeneralExport implements FromView
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
        $dateNext
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
    }

    public function view(): View
    {
        return view('reports.report-general-view', [
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
        ]);
    }

}
