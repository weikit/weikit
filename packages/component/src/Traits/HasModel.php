<?php

namespace Weikit\Component\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasModel
 * @package Weikit\Component\Form\Traits
 * @property Model $model
 */
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
