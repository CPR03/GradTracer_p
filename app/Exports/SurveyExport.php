<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SurveyExport implements WithMultipleSheets
{
    protected $sections;
    protected $surveys;
    protected $evaluations;

    public function __construct($sections, $surveys, $evaluations)
    {
        $this->sections = $sections;
        $this->surveys = $surveys;
        $this->evaluations = $evaluations;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new SurveyResponsesSheet($this->sections, $this->surveys);

        if ($this->evaluations->table_evaluation->isNotEmpty()) {
            $sheets[] = new RatingGridSheet($this->evaluations);
        }

        return $sheets;
    }
}
