<?php

namespace App\Exports;

use App\Models\Downtime;
use App\Models\Workorder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use App\Http\Resources\WorkorderReport\WorkorderReportCollection;

class WorkorderExport implements FromCollection, WithCustomStartCell, WithHeadings
{
    protected $workorder;

    public function __construct(Workorder $workorder)
    {
        $this->workorder = $workorder;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $workorderData = Workorder::where('id',$this->workorder->id)->get();
        return new WorkorderReportCollection($workorderData);
    }

    public function startCell(): string
    {
        return 'B5';
    }

    public function headings(): array
    {
        return [
            'Workorder',
            'Machine',
        ];
    }
}
