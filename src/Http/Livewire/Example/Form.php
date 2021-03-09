<?php

namespace Weikit\Http\Livewire\Example;

use Livewire\Component;
use Weikit\Components\Form\Form as FormBuilder;
use Weikit\Components\Form\Grid;
use Weikit\Components\Form\MultiSelect;
use Weikit\Components\Form\Select;
use Weikit\Components\Form\TextInput;

class Form extends Component
{
    public function getForm()
    {
        return FormBuilder::make()
            ->schema([
                Grid::make([
                    TextInput::make('name')
                        ->label('name')
                        ->required(),
                    TextInput::make('email')
                        ->label('email')
                        ->email()
                        ->required(),
                ]),
                Grid::make([
                    Select::make('select')
                        ->label('select')
                        ->options([
                            'a' => 'haha'
                        ])
                        ->required(),
                    MultiSelect::make('multi_select')
                          ->label('MultiSelect')
                          ->options([
                              'a' => 'haha'
                          ])
                          ->required(),
                ]),
            ]);
    }

    public function render()
    {
        return view('weikit::example.form')
            ->layout('weikit::components.layouts.base');
    }
}
