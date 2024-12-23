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

class SecondJobAfterCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([

            // Question 35
            [
                'question_id' => '35',
                'answer' => 'Salaries and benefits',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '35',
                'answer' => 'Career challenge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '35',
                'answer' => 'Related to special skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '35',
                'answer' => 'Proximity to residence',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '35',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 36
            [
                'question_id' => '36',
                'answer' => 'less than a month',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '36',
                'answer' => '1-6 months',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '36',
                'answer' => '7-11 months',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '36',
                'answer' => '1 year to less than 2 years',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '36',
                'answer' => '2 years to less than 3 years',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '36',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 37
            [
                'question_id' => '37',
                'answer' => 'Below ₱10,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱10,000 - ₱20,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱21,000 - ₱30,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱31,000 - ₱40,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱41,000 - ₱50,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱51,000 - ₱60,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱61,000 - ₱70,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => '₱71,000 above',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '37',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 38
            [
                'question_id' => '38',
                'answer' => 'Rank or Clerical',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '38',
                'answer' => 'Professional, Technical or Supervisory',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '38',
                'answer' => 'Managerial or Executive',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '38',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 39
            [
                'question_id' => '39',
                'answer' => 'Rank or Clerical',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '39',
                'answer' => 'Professional, Technical or Supervisory',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '39',
                'answer' => 'Managerial or Executive',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '39',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('questions')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '7',
                'question' => 'What was your reason (s) for changing job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '7',
                'question' => 'How long did you stay in your first job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '7',
                'question' => 'What is your gross monthly earning in your current job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '7',
                'question' => 'Job Level Position- First Job',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '7',
                'question' => 'Job Level Position- Current/Present Job',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
