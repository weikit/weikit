<?php

namespace Weikit\Component\Card;

use Weikit\Component\Component;

class CardTitle extends Component
{
    public function __construct(string $title)
    {
        $this->title($title);

        parent::__construct();
    }

    /**
     * @return static
     */
    public static function make(string $title)
    {
        return new static($title);
    }

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
