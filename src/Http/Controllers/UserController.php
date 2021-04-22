<?php

namespace Weikit\Http\Controllers;

use Illuminate\Http\Request;
use Weikit\Search\UserSearch;
use Weikit\Component\Table\Table;
use Weikit\Component\Table\Columns\Text;
use Weikit\Component\Table\Traits\HasTable;

class UserController extends Controller
{
    use HasTable;

    public function list()
    {
//        return inertia('weikit::user/list', [
//            'schema' => $this->getTable(),
//            'data' => Inertia::lazy(fn() => $search->search($request))
//        ]);

        return \inertia('weikit::user/list', [
            'schema' => $this->getTable()->url(route('admin.user.search')),
        ]);
    }

    public function search(Request $request, UserSearch $search)
    {
        return $search->search($request);
    }

    public function table()
    {
        return Table::make()
            ->columns([
                Text::make('username')->sortable(),
                Text::make('name')
            ]);
    }
}
