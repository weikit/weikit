<?php

namespace Weikit\Services;

use Weikit\Models\Menu;
use Weikit\Services\Traits\HasModel;
use Weikit\Services\Traits\HasQuery;

class MenuService
{
    use HasModel,
        HasQuery;

    protected $modelClass = Menu::class;
}
