<?php

namespace Database\Seeders;
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

class DataPrivacyConsentSeeder extends Seeder
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
                'question_id' => '1',
                'answer' => 'I Agree',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('questions')->insert([
            [
                'questionnaire_id' => '1',
                'question_section_id' => '1',
                'question' => 'In compliance with the requirements of the Data Privacy Act of 2012 and its implementing rules and regulations, by giving us your personal information, you are allowing us to collect and use this information for whatever purpose it may serve related to this undertaking. Thank you very much.',
                'questionType' => 'radio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
