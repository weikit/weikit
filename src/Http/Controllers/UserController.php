<?php

namespace Weikit\Http\Controllers;

use Illuminate\Http\Request;
use Weikit\Component\Base\Link;
use Weikit\Component\Detail\Detail;
use Weikit\Component\Detail\Field;
use Weikit\Component\Dialog\Dialog;
use Weikit\Component\Form\Captcha;
use Weikit\Component\Form\Form;
use Weikit\Component\Form\Input;
use Weikit\Component\Form\Toggle;
use Weikit\Component\Form\Traits\HasForm;
use Weikit\Component\Layout\Grid;
use Weikit\Component\Table\Column;
use Weikit\Search\UserSearch;
use Weikit\Component\Table\Table;
use Weikit\Component\Table\Traits\HasTable;
use Weikit\Component\Detail\Traits\HasDetail;

class UserController extends Controller
{
    use HasForm;
    use HasTable;
    use HasDetail;

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

    public function view(Request $request)
    {
        return \inertia('weikit::user/detail', [
            'schema' => $this->getDetail()
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
        return Table::make([
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
//            Input::make('username')
//                     ->label(__('weikit::auth.login.username'))
//                     ->required(),
//            Input::make('password')
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

    public function detail()
    {
        return Detail::make([
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),

            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
            Field::make('aaa', 'asfasfasfasfsafasfasfasfasfsfasfsdfsafffffffffffffffffffffffffffffffffffffffffa'),
        ]);
    }


}
