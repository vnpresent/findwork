<?php

namespace Database\Seeders;

use App\Models\WorkingForm;
use Illuminate\Database\Seeder;

class WorkingFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workingforms = config('setting.workingforms');
        foreach ($workingforms as $workingform) {
            WorkingForm::create([
                'name' => $workingform
            ]);
        }
    }
}
