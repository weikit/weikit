<?php

namespace Weikit\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface Service
{
    public function modelClass(): string;

    public function model(): Model;

    public function query(array $options = []): Builder;

    public function one($where = null, array $options = []): Model;

    public function all($where = null, array $options = []): Collection;

    public function chunk(callable $callback, $where = null, array $options = []);

    public function paginate($where = null, array $options = []): LengthAwarePaginator;

    public function has($where = null, array $options = []): bool;

    public function count($columns = '*', $where = null, array $options = []): int;

    public function min(string $column, $where = null, array $options = []);

    public function max(string $column, $where = null, array $options = []);

    public function sum();

    public function avg();

    public function create(): Model;

    public function getByPK(): Model;

    public function deleteByPK();
}
