<?php

namespace Weikit\Component\Detail\Traits;

use Weikit\Component\Detail\Detail;

trait HasDetail
{
    private $detail;

    public function getDetail(): Detail
    {
        if (!method_exists($this, 'detail')) {
            throw new \Exception('Missing detail method.');
        }

        if ($this->detail === null) {
            $this->detail = $this->detail();
        }

        return $this->detail;
    }
}
