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

class GeneralInformationSeeder extends Seeder
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
                    'question_id' => '2',
                    'answer' => 'Full Name [Lastname, First Name Middle Name]',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '3',
                    'answer' => 'Email Address',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '4',
                    'answer' => 'Phone Number',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '5',
                    'answer' => 'Prsent Address',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '6',
                    'answer' => 'Permanent Address',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '7',
                    'answer' => 'Female',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '7',
                    'answer' => 'Male',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '8',
                    'answer' => '2022-05-27',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Single',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Married',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Divorced',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Widower',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Seperated',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '9',
                    'answer' => 'Others',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '10',
                    'answer' => 'Name of Spouse',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
            DB::table('questions')->insert([
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Full Name [Lastname, First Name Middle Name]',
                    'questionType' => 'simple',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Email Address',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Mobile Phone Number',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Present Address',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Permanent Address',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Sex',
                    'questionType' => 'radio',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Date of Birth ',
                    'questionType' => 'date',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Civil Status',
                    'questionType' => 'radio',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '2',
                    'question' => 'Name of Spouse',
                    'questionType' => 'simple',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        

            
        
    }
}
