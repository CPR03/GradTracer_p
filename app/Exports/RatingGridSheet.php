<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RatingGridSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $evaluations;

    public function __construct($evaluations)
    {
        $this->evaluations = $evaluations;
    }

    public function title(): string
    {
        return 'Rating Grid Results';
    }

    public function collection()
    {
        $data = collect();

        foreach ($this->evaluations->table_evaluation as $evaluation) {
            foreach ($evaluation->multiple_questions as $question) {

                $ratings = $question->eval_responses;
                $total = $ratings->count();

                $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                foreach ($ratings as $rating) {
                    $ratingCounts[(int)$rating->answer_name]++;
                }

                $avg = $total > 0 ? $ratings->avg('answer_name') : 0;

                $data->push([
                    'evaluation' => $evaluation->question,
                    'criteria' => $question->question_row,
                    'poor_count' => $ratingCounts[1],
                    'poor_percent' => $total > 0 ? ($ratingCounts[1] / $total) * 100 : 0,
                    'fair_count' => $ratingCounts[2],
                    'fair_percent' => $total > 0 ? ($ratingCounts[2] / $total) * 100 : 0,
                    'good_count' => $ratingCounts[3],
                    'good_percent' => $total > 0 ? ($ratingCounts[3] / $total) * 100 : 0,
                    'excellent_count' => $ratingCounts[4],
                    'excellent_percent' => $total > 0 ? ($ratingCounts[4] / $total) * 100 : 0,
                    'average' => $avg
                ]);
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Evaluation',
            'Criteria',
            'Poor (1) Count',
            'Poor %',
            'Fair (2) Count',
            'Fair %',
            'Good (3) Count',
            'Good %',
            'Excellent (4) Count',
            'Excellent %',
            'Average Rating'
        ];
    }

    public function map($row): array
    {
        return [
            $row['evaluation'],
            $row['criteria'],
            $row['poor_count'],
            number_format($row['poor_percent'], 1) . '%',
            $row['fair_count'],
            number_format($row['fair_percent'], 1) . '%',
            $row['good_count'],
            number_format($row['good_percent'], 1) . '%',
            $row['excellent_count'],
            number_format($row['excellent_percent'], 1) . '%',
            number_format($row['average'], 2)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A' => ['width' => 30],
            'B' => ['width' => 40],
            'C' => ['width' => 15],
            'D' => ['width' => 15],
            'E' => ['width' => 15],
            'F' => ['width' => 15],
            'G' => ['width' => 15],
            'H' => ['width' => 15],
            'I' => ['width' => 15],
            'J' => ['width' => 15],
            'K' => ['width' => 15],
        ];
    }
}
