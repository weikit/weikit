<?php

namespace Weikit\Http\Controllers\Example;

use Weikit\Component\Card;
use Weikit\Component\Forms\Button;
use Weikit\Component\Forms\Checkbox;
use Weikit\Component\Forms\DatePicker;
use Weikit\Component\Forms\Form;
use Weikit\Component\Forms\Radio;
use Weikit\Component\Forms\Select;
use Weikit\Component\Forms\Textarea;
use Weikit\Component\Forms\TextInput;
use Weikit\Component\Forms\TimePicker;
use Weikit\Component\Forms\Toggle;
use Weikit\Component\Layout\Grid;
use Weikit\Component\Tabs\Tab;
use Weikit\Component\Tabs\Tabs;
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
            'components' => $this->getComponents(),
        ]);
    }

    public function getComponents()
    {
        return Tabs::make()
           ->children([
               Tab::make('tab1')
                  ->child(
                      Form::make([
                          Grid::make([
                              TextInput::make('text')->label('text input'),
                              TextInput::make('password')->password()->label('password input'),
                          ]),
                          Checkbox::make('checkbox')->label('checkbox'),
                          Select::make('select')->options([
                              'a' => 'a option',
                              'b' => 'b option',
                          ])->label('select'),
                          Radio::make('radio')->options([
                              'a' => 'a option',
                              'b' => 'b option',
                          ])->label('radio'),
                          Toggle::make('toggle')->label('toggle'),
                          Textarea::make('textarea')->label('textarea'),
                          DatePicker::make('datePicker')->label('date picker'),
                          TimePicker::make('timePicker')->label('time picker'),
                      ])
                  ),
               Tab::make('tab2')
                  ->child(
                      Card::make()
                          ->child(
                              Form::make([
                                  TextInput::make('text')->label('text input'),

                              ])
                          )

                  ),
           ]);
    }
}
