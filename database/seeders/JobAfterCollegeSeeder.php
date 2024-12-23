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

class JobAfterCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            
            // Question 28
            [
                'question_id' => '28',
                'answer' => 'Salaries and benefits',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Career challenge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Related to special skill',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Related to course or program of study',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Proximity to residence',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Peer influence',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Family influence',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '28',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 29
            [
                'question_id' => '29',
                'answer' => 'Yes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '29',
                'answer' => 'No',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 30
            [
                'question_id' => '30',
                'answer' => 'Response to an advertisement',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'As walk-in applicant',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'question_id' => '30',
                'answer' => 'Recommended by someone',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'Information from friends',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'Arranged by school`s job placement officer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'Family business',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'Job Fair or Public Employment Service Office (PESO)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '30',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 31
            [
                'question_id' => '31',
                'answer' => 'Less than a month',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => '1-6 months',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => '7-11 months',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => '1 year to less than 2 years',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => '2 years to less than 3 years',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => '3 years to less than 4 years',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '31',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 32
            [
                'question_id' => '32',
                'answer' => 'Below ₱10,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱10,000 - ₱20,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱21,000 - ₱30,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱31,000 - ₱40,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱41,000 - ₱50,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱51,000 - ₱60,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱61,000 - ₱70,000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => '₱71,000 above',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '32',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 33
            [
                'question_id' => '33',
                'answer' => 'Yes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '33',
                'answer' => 'No',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '33',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question 34
            [
                'question_id' => '34',
                'answer' => 'Communication skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '34',
                'answer' => 'Human Relations skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '34',
                'answer' => 'Entrepreneurial skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '34',
                'answer' => 'Problem-solving skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '34',
                'answer' => 'Critical Thinking skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '34',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    

        DB::table('questions')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'What is your main reason for accepting the job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'Is your first job related to the course you took up in college?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'How did you find your first job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'How long did it take you to land your first job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'What is your initial gross monthly earning in your first job after college?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'Was the curriculum you had in college relevant to your first job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '6',
                'question' => 'What competencies learned in college did you find very useful in your first job?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            

        ]);
    }
}
