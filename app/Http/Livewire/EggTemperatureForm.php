<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EggTemperature;

class EggTemperatureForm extends Component
{

    public $ps_no, $setting_date, $incubator_no, $location, $temp_check_date, $temperature, $quantity = 0;

    protected $rules = [
        'ps_no' => 'required|string|max:255',
        'setting_date' => 'required|date',
        'incubator_no' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'temp_check_date' => 'required|date',
        'temperature' => 'required|string|max:255',
        'quantity' => 'required|integer',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        EggTemperature::create([
            'ps_no' => $this->ps_no,
            'setting_date' => $this->setting_date,
            'incubator' => $this->incubator_no,
            'location' => $this->location,

            'temperature' => $this->temperature,
            'temperature_check_date' => $this->temp_check_date,            
            'quantity' => $this->quantity,            
        ]);

        $this->reset();

        session()->flash('success', 'Egg Temperature Recorded Successfully');
    }

    public function render()
    {
        return view('livewire.egg-temperature-form');
    }
}
