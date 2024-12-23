<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(SurveySeeder::class);
        $this->call(DataPrivacyConsentSeeder::class);
        $this->call(GeneralInformationSeeder::class);
        $this->call(EducationalBackgroundSeeder::class);
        $this->call(EmploymentInfoSeeder::class);
        $this->call(CurrentEmploymentStatusSeeder::class);
        $this->call(JobAfterCollegeSeeder::class);
        $this->call(SecondJobAfterCollegeSeeder::class);
        $this->call(NotEmployedSeeder::class);
        $this->call(ContributionOfCollegeSeeder::class);
    }
}
