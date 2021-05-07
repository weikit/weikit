<?php

namespace Weikit\Component\Table;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder as Query;
use Weikit\Component\Component;
use Weikit\Component\Traits\HasMake;

class Table extends Component
{
    /**
     * @var Query|QueryBuilder
     */
    protected $query;

    public static function make(array $columns = [])
    {
        return (new static())
            ->columns($columns);
    }

    public function init()
    {
        $this->url(url()->current());
    }

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
        return $this->append('columns', $column->parent($this));
    }

    /**
     * @param string $url
     *
     * @return Table
     */
    public function url(string $url)
    {
        return $this->set('url', $url);
    }
}
