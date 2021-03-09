<?php
namespace Weikit\Http\Livewire\Example;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('weikit::example.index')
            ->layout('weikit::components.layouts.base');
    }
}
