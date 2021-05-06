<?php
namespace Weikit\Component\Detail;

use Weikit\Component\Component;

class Detail extends Component
{
    public static function make(array $fields = [])
    {
        return (new static())
            ->fields($fields);
    }

    /**
     * @param array $columns
     *
     * @return $this
     */
    public function fields(array $fields)
    {
        foreach($fields as $field) {
            $this->field($field);
        }

        return $this;
    }

    /**
     * @param Field $column
     *
     * @return Detail
     */
    public function field(Field $field)
    {
        return $this->append('fields', $field);
    }
}
