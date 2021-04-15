<?php

namespace Weikit\Http\Controllers\Example;

use Weikit\Component\Card;
use Weikit\Component\Form\Button;
use Weikit\Component\Form\Checkbox;
use Weikit\Component\Form\DatePicker;
use Weikit\Component\Form\Form;
use Weikit\Component\Form\Radio;
use Weikit\Component\Form\Select;
use Weikit\Component\Form\Textarea;
use Weikit\Component\Form\TextInput;
use Weikit\Component\Form\TimePicker;
use Weikit\Component\Form\Toggle;
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
