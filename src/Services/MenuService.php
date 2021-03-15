<?php

namespace Weikit\Services;

use Weikit\Models\Menu;
use Weikit\Services\Contracts\MenuService as MenuServiceInterface;
use Weikit\Services\Traits\HasModel;
use Weikit\Services\Traits\HasQuery;

class MenuService implements MenuServiceInterface
{
    use HasModel,
        HasQuery;

    protected $modelClass = Menu::class;
}
