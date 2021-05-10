<?php

namespace Weikit\Component\Card;

use Weikit\Component\Component;
use Weikit\Component\Traits\HasMake;
use Weikit\Component\Traits\HasChildren;

/**
 * Class Card
 * @package Weikit\Component
 *
 * @property Title $title
 */
class Card extends Component
{
    use HasMake;
    use HasChildren;

    /**
     * @param string|Title $title
     *
     * @return $this
     */
    public function title($title)
    {
        if (!($title instanceof Title)) {
            $title = Title::make($title);
        }

        return $this->set('title', $title);
    }
}
