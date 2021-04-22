<?php

namespace Weikit\Component\Table;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder as Query;
use Spatie\QueryBuilder\QueryBuilder;
use Weikit\Component\Component;
use Weikit\Component\Traits\HasMake;
use Weikit\Component\Table\Columns\Column;

class Table extends Component
{
    use HasMake;

    /**
     * @var Query|QueryBuilder
     */
    protected $query;

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
        return $this->append('columns', $column);
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
