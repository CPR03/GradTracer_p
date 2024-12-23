<?php

namespace App\Exports;

use App\Models\SurveyResponse;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResponseExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SurveyResponse::all();
    }
}
