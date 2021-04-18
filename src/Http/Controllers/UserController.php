<?php

namespace Weikit\Http\Controllers;


use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Weikit\Component\Table\Columns\Text;
use Weikit\Component\Table\Table;
use Weikit\Component\Table\Traits\HasTable;

class UserController extends Controller
{
    use HasTable;

    public function list()
    {
        $query = QueryBuilder::for(User::class)
            ->allowedFilters(['username'])
            ->allowedSorts(['created_at']);

        return inertia('weikit::user/list', [
            'schema' => $this->getTable()->query($query)
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
