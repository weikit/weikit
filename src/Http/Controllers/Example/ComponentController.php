<?php

namespace Weikit\Http\Controllers\Example;

use Weikit\Components\Card;
use Weikit\Components\Form\Checkbox;
use Weikit\Components\Form\DatePicker;
use Weikit\Components\Form\Form;
use Weikit\Components\Form\Radio;
use Weikit\Components\Form\Select;
use Weikit\Components\Form\Textarea;
use Weikit\Components\Form\TextInput;
use Weikit\Components\Form\TimePicker;
use Weikit\Components\Form\Toggle;
use Weikit\Components\Tab;
use Weikit\Components\Tabs;
use Weikit\Http\Controllers\Controller;

class ComponentController extends Controller
{
    public function remote()
    {
        return view('weikit::example.remote');
    }

    public function page()
    {
        return view('weikit::example.component', [
            'schema' => $this->getSchema()
        ]);
    }

    public function getSchema()
    {
        return Card::make()
            ->child(
                Tabs::make()
                    ->children([
                        Tab::make()
                           ->label('tab1')
                           ->child(
                            Form::make()
                                ->children([
                                    TextInput::make('text')->label('text input'),
                                    TextInput::make('password')->password()->label('password input'),
                                    Checkbox::make('checkbox')->label('checkbox'),
                                    Select::make('select')->options(['a' => 'a option', 'b' => 'b option'])->label('select'),
                                    Radio::make('radio')->options(['a' => 'a option', 'b' => 'b option'])->label('radio'),
                                    Toggle::make('toggle')->label('toggle'),
                                    Textarea::make('textarea')->label('textarea'),
                                    DatePicker::make('datePicker')->label('date picker'),
                                    TimePicker::make('timePicker')->label('time picker')
                                ])
                        ),
                        Tab::make()
                           ->label('tab2')
                           ->child(
                            Form::make()
                                ->children([
                                    TextInput::make('text')->label('text input'),

                                ])
                        ),
                    ])
            );
    }
}
