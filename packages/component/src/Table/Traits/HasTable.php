<?php

namespace Weikit\Component\Table\Traits;

use Weikit\Component\Table\Table;

trait HasTable
{
    private $table;

    public function getTable(): Table
    {
        if (!method_exists($this, 'table')) {
            throw new \Exception('Missing table method.');
        }

        if ($this->table === null) {
            $this->table = $this->table();
        }

        return $this->table;
    }
}
