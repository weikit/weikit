<?php

namespace Weikit\Component\Table;

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

    public function query($query)
    {
        if ($query instanceof Query || $query instanceof QueryBuilder) {
            $this->query = $query;
        } else {
            throw new \InvalidArgumentException('Table query only accept instance "' . Query::class . '" or "' . QueryBuilder::class . '"');
        }

        return $this;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['data'] = $this->query->paginate();
        return $array;
    }
}
