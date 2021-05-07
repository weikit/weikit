<?php

namespace Weikit\Component\Form\Traits;


use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    protected Model $_model;

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function model(Model $model)
    {
        $this->_model = $model;

        return $this;
    }

    /**
     * @return Model|null
     */
    public function getModel()
    {
        return $this->_model;
    }
}
