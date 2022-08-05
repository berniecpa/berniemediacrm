<?php

namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class WithContract implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  Builder $builder
     * @param  mixed   $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $value === '1' ? $builder->whereNotNull('contract_id') : $builder->whereNull('contract_id');
    }
}
