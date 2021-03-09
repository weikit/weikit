<?php

namespace Weikit\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('weikit::auth.login')
            ->layout('weikit::components.layouts.base');
    }
}
