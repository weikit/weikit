<?php
namespace Weikit\Search;

use App\Models\User;
use Weikit\Search\Traits\HasQueryBuilder;

class UserSearch extends Search
{
    use HasQueryBuilder;

    public static $model = User::class;
}
