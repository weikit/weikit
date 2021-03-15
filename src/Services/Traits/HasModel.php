<?php

namespace Weikit\Services\Traits;

trait HasModel
{
    protected $modelClass;
    public function modelClass()
    {
        if ($this->modelClass === null) {
            throw new \BadMethodCallException('The Model class name of class "' . __CLASS__ . '" must be specified.');
        }
        return $this->modelClass;
    }

    private $model;

    public function model()
    {
        if ($this->model === null) {
            $this->model = resolve($this->modelClass());
        }

        return $this->model;
    }
}
