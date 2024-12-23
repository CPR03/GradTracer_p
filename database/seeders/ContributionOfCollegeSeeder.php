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

class ContributionOfCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($count=0;$count<27;$count++){
            DB::table('multiple_answers')->insert([
                [
                    'multiple_question_id' => ($count+1),
                    'answer_column' => 'Poorly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'multiple_question_id' => ($count+1),
                    'answer_column' => 'Fairly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'multiple_question_id' => ($count+1),
                    'answer_column' => 'Highly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'multiple_question_id' => ($count+1),
                    'answer_column' => 'Very Highly',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                
                
            ]);
        }
        // DB::table('multiple_answers')->insert([

        //     // Multilple Questions
        //     [
        //         'multiple_question_id' => '1',
        //         'answer_column' => 'Poorly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '1',
        //         'answer_column' => 'Fairly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '1',
        //         'answer_column' => 'Highly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '1',
        //         'answer_column' => 'Very Highly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],

        //     [
        //         'multiple_question_id' => '2',
        //         'answer_column' => 'Poorly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '2',
        //         'answer_column' => 'Fairly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '2',
        //         'answer_column' => 'Highly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'multiple_question_id' => '2',
        //         'answer_column' => 'Very Highly',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
           

        // ]);

        DB::table('evaluations')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '9',
                'question' => 'Rate the contribution of the program to your personal and professional growth in terms
                of:',
                'questionType' => 'multiple_question',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'question_section_id' => '9',
                'question' => 'Rate the degree program you finished at MSEUF.',
                'questionType' => 'multiple_question',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('multiple_questions')->insert([
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Academic Profession',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Research Capability',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Learning Efficiency',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Communication Skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'People Skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Problem Solving Skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Information Technology Skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Meeting Present and Future Professional Needs',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Exposure to Local Community within Field of Specialization',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Exposure to International Community within Field of Specialization',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Critical Thinking Skills',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Salary Improvement and Promotion',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Opportunities Abroad',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '1',
                'question_section_id' => '9',
                'question_row' => 'Personality Development',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // Question Number 2
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Range of Courses',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Relevance to your Profession',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Extracurricular Activities',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Premium Given to Research',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Interdisciplinary Learning',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Teaching and Learning Environment',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Quality of Instruction',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Teacher-Student Relationships',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Library Resources',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Laboratory Resources',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Class Size',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Professors Pedagogical Expertise',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'questionnaire_id' => '1',
                'evaluation_id' => '2',
                'question_section_id' => '9',
                'question_row' => 'Professors Knowledge of Subject Matter',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
