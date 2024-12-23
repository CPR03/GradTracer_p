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
class EducationalBackgroundSeeder extends Seeder
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
                    'question_id' => '11',
                    'answer' => 'BS in Computer Science',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '11',
                    'answer' => 'BS in Information Technology',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '11',
                    'answer' => 'BS in Information Systems',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '11',
                    'answer' => 'ETEEAP- BS in Information Technology',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '11',
                    'answer' => 'Associate in Computer Technology',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '12',
                    'answer' => 'Type your Specializations',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '13',
                    'answer' =>  'Year Graduated',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '14',
                    'answer' => 'Type your Honors',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'question_id' => '15',
                    'answer' => 'Type your Examination(s) Passed',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        

            DB::table('questions')->insert([
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '3',
                    'question' => 'Baccalaureate Degree in MSEUF-CCMS',
                    'questionType' => 'radio',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '3',
                    'question' => 'Write your Specialization (if applicable, i.e. with specialization in Data Analytics)',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '3',
                    'question' => 'Year Graduated',
                    'questionType' => 'simple',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '3',
                    'question' => 'Honors/ Awards received in college or while earning the degree',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'question_section_id' => '3',
                    'question' => 'Professional examination (s) Passed',
                    'questionType' => 'textBox',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        

            
        
    
    }
}
