<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SurveyResponsesSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $sections;
    protected $surveys;

    public function __construct($sections, $surveys)
    {
        $this->sections = $sections;
        $this->surveys = $surveys;
    }

    public function title(): string
    {
        return 'Survey Responses';
    }

    public function collection()
    {
        $data = collect();

        foreach ($this->sections->sections as $section) {
            foreach ($section->questions as $question) {
                foreach ($this->surveys->surveys as $survey) {
                    foreach ($survey->responses as $response) {
                        if ($response->question_id == $question->id) {
                            $data->push([
                                'respondent' => $survey->name,
                                'section' => $section->section_name,
                                'question' => $question->question,
                                'response' => $response->answer_name,
                                'submitted' => $survey->created_at
                            ]);
                        }
                    }
                }
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Respondent',
            'Section',
            'Question',
            'Response',
            'Submitted'
        ];
    }

    public function map($row): array
    {
        return [
            $row['respondent'],
            $row['section'],
            $row['question'],
            $row['response'],
            $row['submitted']->format('M d, Y g:i A')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A' => ['width' => 25],
            'B' => ['width' => 25],
            'C' => ['width' => 40],
            'D' => ['width' => 30],
            'E' => ['width' => 20],
        ];
    }
}
