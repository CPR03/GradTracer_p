<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Questionnaire;
use App\Models\QuestionSection;
class MultiStepForm extends Component
{
    public $sections;

    public function render()
    {
        $this->sections = QuestionSection::all();
        return view('livewire.multi-step-form');
    }
    public function mount($sections){
        
    }
}
