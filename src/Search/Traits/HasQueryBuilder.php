<?php
namespace Weikit\Search\Traits;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

trait HasQueryBuilder
{
    public function search(Request $request)
    {
        return $this->buildSearch($request)->paginate();
    }

    public function buildSearch(Request $request)
    {
        return tap(QueryBuilder::for(static::$model, $request), function(QueryBuilder $builder) {
            $this->buildFilters($builder);
            $this->buildSorts($builder);
            $this->buildFields($builder);
            $this->buildAppends($builder);
        });
    }

    protected function buildFilters(QueryBuilder $builder)
    {
        if ($this->filters !== []) {
            $builder->allowedFilters($this->filters);
        }
    }

    protected function buildSorts(QueryBuilder $builder)
    {
        if ($this->sorts !== []) {
            $builder->allowedSorts($this->sorts);
        }
    }

    protected function buildFields(QueryBuilder $builder)
    {
        if ($this->fields !== []) {
            $builder->allowedFields($this->fields);
        }
    }

    protected function buildAppends(QueryBuilder $builder)
    {
        if ($this->appends !== []) {
            $builder->allowedAppends($this->appends);
        }
    }
}
