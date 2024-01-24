<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;


class CompanyFilter extends AbstractFilter
{

    public const NAME = 'name';
    public const ADDRESS = 'address';
    public const USER_ID = 'user_id';

    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::ADDRESS => [$this, 'address'],
            self::USER_ID => [$this, 'userId'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function address(Builder $builder, $value)
    {
        $builder->where('address', 'like', "%{$value}%");
    }

    public function userId(Builder $builder, $value)
    {
        // dd($value);
        $builder->where('user_id', $value);
    }
}
