<?php

namespace Database\Seeders;

use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\QuestionSection;
use App\Models\MultipleQuestion;
use App\Models\MultipleAnswer;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use DB; 

class EmploymentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'question_id' => '16',
                'answer' => 'Employed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '16',
                'answer' => 'Not Employed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '16',
                'answer' => 'Self-Employed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '16',
                'answer' => 'Not working and looking for a job',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '16',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    

        DB::table('questions')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '4',
                'question' => 'Are you currently employed?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
