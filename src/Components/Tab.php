<?php

namespace Weikit\Components;

use Weikit\Components\Concerns\HasChildren;
use Weikit\Components\Form\Field;

class Tab extends Component
{
    use HasChildren;

    /**
     * @param string $label
     *
     * @return Field
     */
    public function label(string $label)
    {
        return $this->set('label', $label);
    }

}
