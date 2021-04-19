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

    public function list(Request $request, UserSearch $search)
    {
        return inertia('weikit::user/list', [
            'schema' => $this->getTable()
                ->pagination($search->search($request))
        ]);
    }

    public function table()
    {
        return Table::make()
            ->columns([
                Text::make('username'),
                Text::make('name')
            ]);
    }
}
