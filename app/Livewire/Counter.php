<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;
    public $title = "counter Page";
    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter',['title' => $this->title]);
    }
}
