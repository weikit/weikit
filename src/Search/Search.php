<?php

namespace Weikit\Search;

use Illuminate\Http\Request;

abstract class Search
{
    protected $filters = [];
    protected $sorts = [];
    protected $fields = [];
    protected $appends = [];

    protected $builder;

    abstract public function search(Request $request);
}
