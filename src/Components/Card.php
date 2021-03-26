<?php

namespace Weikit\Components;

use Weikit\Components\Concerns\HasChildren;

class Card extends Component
{
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
