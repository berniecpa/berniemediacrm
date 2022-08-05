<?php

namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class DateRange implements FilterInterface
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
        $column = isset($value[2]) ? $value[2] : 'created_at';
        return $builder->whereBetween($column, [$value[0] . ' 00:00:00', $value[1] . ' 23:59:59']);
    }
}
