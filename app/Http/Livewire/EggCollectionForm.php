<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EggCollectionForm extends Component
{
    public $ps_no;
    public $house_no;
    public $production_date;
    public $collection_time;
    public $collection_eggs_quantity;
    
    protected $rules = [
        'ps_no' => 'required|string|max:255',
        'house_no' => 'required|string|max:255',
        'production_date' => 'required|date',
        'collection_time' => 'required|date_format:H:i',
        'collection_eggs_quantity' => 'required|integer',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $validateData = $this->validate();

        session()->flash('success', 'Egg Collection Added Successfully');

        $this->reset();
    }
    public function render()
    {
        return view('livewire.egg-collection-form');
    }
}
