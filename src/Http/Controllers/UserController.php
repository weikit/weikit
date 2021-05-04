<?php

namespace Weikit\Http\Controllers;

use Illuminate\Http\Request;
use Weikit\Component\Base\Link;
use Weikit\Component\Dialog\Dialog;
use Weikit\Component\Form\Captcha;
use Weikit\Component\Form\Form;
use Weikit\Component\Form\TextInput;
use Weikit\Component\Form\Toggle;
use Weikit\Component\Form\Traits\HasForm;
use Weikit\Component\Layout\Grid;
use Weikit\Component\Table\Column;
use Weikit\Component\Table\Columns\Action;
use Weikit\Search\UserSearch;
use Weikit\Component\Table\Table;
use Weikit\Component\Table\Columns\Text;
use Weikit\Component\Table\Traits\HasTable;

class UserController extends Controller
{
    use HasTable;
    use HasForm;

    public function index()
    {
        return \inertia('weikit::user/index', [
            'schema' => $this->getTable()->url(route('admin.user.search')),
        ]);
    }

    public function search(Request $request, UserSearch $search)
    {
        return $search->search($request);
    }

    public function create(Request $request)
    {
        return \inertia('weikit::user/create', [
            'schema' => []
        ]);
    }

    public function edit(Request $request)
    {
        return \inertia('weikit::user/edit', [
            'schema' => []
        ]);
    }

    public function detail(Request $request)
    {
        return \inertia('weikit::user/detail', [
            'schema' => []
        ]);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }

    protected function table()
    {
        return Table::make()
            ->columns([
                Column::make('username')->sortable(),
                Column::make('name'),
                Column::make('action')->children([
                    Link::make('a', '编辑')
                        ->dialog(
                            Dialog::make([
                                Link::make('b', 'b')
                            ])
                        ),
                    Link::make('b', '删除')
                        ->dialog(Dialog::make([
                            Link::make('b', 'b')
                        ]))
                ])
            ]);
    }

    protected function form()
    {
//        return Form::make([
//            TextInput::make('username')
//                     ->label(__('weikit::auth.login.username'))
//                     ->required(),
//            TextInput::make('password')
//                     ->label(__('weikit::auth.login.password'))
//                     ->password()
//                     ->required(),
//            Captcha::make()
//                   ->label(__('weikit::captcha.input.label'))
//                   ->url(captcha_src('math'))
//                   ->required(),
//            Grid::make([
//                Toggle::make('remember')
//                      ->label(__('weikit::auth.login.remember')),
//            ])
//        ], __('weikit::auth.login.submit'))
//                   ->id('login_form')
//                   ->url(route('admin.auth.login'));
    }
}
