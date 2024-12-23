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

class CurrentEmploymentStatusSeeder extends Seeder
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
                'question_id' => '17',
                'answer' => 'Type Here..',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '18',
                'answer' => 'Type Here..',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '19',
                'answer' => 'Permanent',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '19',
                'answer' => 'Probationary',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '19',
                'answer' => 'Contractual',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '19',
                'answer' =>  'Job Order/ Casual',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '19',
                'answer' => 'Other',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '20',
                'answer' => 'Government',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '20',
                'answer' => 'Private',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '20',
                'answer' => 'NGO/INGO',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '20',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '21',
                'answer' => 'Type here..',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Managers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Professionals',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Technicians and associate professionals',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Clerical support workers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Service and sales workers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Skilled agricultural, forestry and fishery workers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Craft and related trades workers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Plant and machine operators and assemblers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' =>  'Elementary occupations',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '22',
                'answer' => 'Armed forces occupations',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '23',
                'answer' => 'Type Here..',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '24',
                'answer' => 'Type Here..',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '25',
                'answer' => '2022-05-27',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '26',
                'answer' => 'Local',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '26',
                'answer' => 'Abroad',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '26',
                'answer' => 'Others',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '27',
                'answer' => 'Yes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'question_id' => '27',
                'answer' => 'No',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    

        DB::table('questions')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Name of organization/company/employer',
                'questionType' => 'textBox',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Company Address',
                'questionType' => 'textBox',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Employment Status',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Type of Organization',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Major line of business of the company you are presently employed in',
                'questionType' => 'textBox',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Occupational Classification (2012 Philippine Standard Occupational Classification (PSOC)) (https://psa.gov.ph/classification/psoc/technical-notes)',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Job Designation/ Title',
                'questionType' => 'textBox',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Department/ Division',
                'questionType' => 'simple',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Employment Date',
                'questionType' => 'date',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Place of Work',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'questionnaire_id' => '1',
                'question_section_id' => '5',
                'question' => 'Is this your first job after college?',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
