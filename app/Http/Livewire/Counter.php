<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function mount()
    {
        $this->count = 1;
    }

    public function render()
    {
        return view('livewire.counter',['count' => $this->count]);
    }
}
