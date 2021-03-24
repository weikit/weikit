<?php

namespace Weikit\Http\Controllers\Example;

use Weikit\Components\Form\Checkbox;
use Weikit\Components\Form\Form;
use Weikit\Components\Form\Select;
use Weikit\Components\Form\Textarea;
use Weikit\Components\Form\TextInput;
use Weikit\Components\Form\Toggle;
use Weikit\Http\Controllers\Controller;

class ComponentController extends Controller
{
    public function test()
    {
        return view('weikit::example.test');
    }

    public function page()
    {
        return view('weikit::example.component', [
            'schema' => $this->getSchema()
        ]);
    }

    public function getSchema()
    {
        return Form::make()
            ->schema([
                TextInput::make('username'),
                TextInput::make('password')->password(),
                Checkbox::make('checkbox')->label('checkbox label'),
                Select::make('select')->options(['a' => 'a option', 'b' => 'b option'])->label('select label'),
                Toggle::make('toggle')->label('toggle label'),
                Textarea::make('textarea')->label('textarea label')
            ]);
    }
}
