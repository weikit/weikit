<?php

namespace Weikit\Component\Table;

use Weikit\Component\Component;
use Weikit\Component\Traits\HasMake;

class Table extends Component
{
    use HasMake;

    /**
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        foreach($columns as $column) {
            $this->column($column);
        }
        return $this;
    }

    /**
     * @param Column $column
     *
     * @return Table
     */
    public function column(Column $column)
    {
        return $this->append('columns', $column);
    }
}
