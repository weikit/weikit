<?php

namespace Weikit\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Weikit\Component\Base\Link;
use Weikit\Component\Detail\Detail;
use Weikit\Component\Detail\Field;
use Weikit\Component\Detail\Traits\HasDetail;
use Weikit\Component\Dialog\Dialog;
use Weikit\Component\Form\Form;
use Weikit\Component\Form\Input;
use Weikit\Component\Form\Traits\HasForm;
use Weikit\Component\Table\Column;
use Weikit\Component\Table\Table;
use Weikit\Component\Table\Traits\HasTable;
use Weikit\Search\UserSearch;

class ResourceController extends Controller
{
    use HasForm;
    use HasTable;
    use HasDetail;

    public function index()
    {
        return \inertia('weikit::resource/index', [
            'schema' => $this->getTable()
        ]);
    }

    public function search(Request $request, UserSearch $search)
    {
        return $search->search($request);
    }

    public function create()
    {
        return \inertia('weikit::resource/create', [
            'schema' => $this->getForm()
        ]);
    }

    public function store(Request $request)
    {

    }

    public function show(Request $request, User $user)
    {
        return \inertia('weikit::resource/show', [
            'schema' => $this->getDetail()
        ]);
    }

    public function edit(Request $request, User $user)
    {
        return \inertia('weikit::resource/edit', [
            'schema' => $this->getForm()->model($user)
        ]);
    }

    public function update(Request $request, User $user)
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
                Link::make('查看', route('admin.user.view', ['user' => 1])),
                Link::make('编辑', 'a')
                    ->dialog(
                        Dialog::make([
                            Link::make('b', 'b')
                        ])
                    ),
                Link::make('删除', 'b')
                    ->dialog(Dialog::make([
                        Link::make('b', 'b')
                    ]))
            ])
        ])->url(route('admin.user.search'));
    }

    protected function form()
    {
        return Form::make([
            Input::make('username')
                 ->label(__('weikit::auth.login.username'))
                 ->required(),
            Input::make('name')
                 ->label(__('weikit::auth.login.password'))
                 ->required(),
            Input::make('email')
                 ->label(__('weikit::auth.login.password'))
                 ->required(),
        ], __('weikit::auth.login.submit'));
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
