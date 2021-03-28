<?php

namespace Weikit\Component;

use Weikit\Component\Traits\HasMake;
use Weikit\Component\Traits\HasChildren;

class Card extends Component
{
    use HasMake;
    use HasChildren;

    /**
     * @param string $title
     *
     * @return $this
     */
    public function title(string $title)
    {
        return $this->set('title', $title);
    }
}
