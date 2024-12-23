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
class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionnaire = Questionnaire::create([
            'user_id' => '1',
            'title' => 'Graduate Tracer',
        ]);

        
        if(DB::table('question_sections')->count() == 0){
            DB::table('question_sections')->insert([
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Data Privacy Consent',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'General Information',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Educational Background',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Employment Information',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Current Employment Status',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Job after college (First job)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Job after college (Second job)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Not Employed',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'questionnaire_id' => '1',
                    'section_name' => 'Contribution of the program you graduated',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        }

        

    }
}
