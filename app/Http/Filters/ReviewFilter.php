<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;


class ReviewFilter extends AbstractFilter
{
    public const COMPANY_ID = 'company_id';
    public const USER_ID = 'user_id';

    protected function getCallbacks(): array
    {
        return [
            self::COMPANY_ID => [$this, 'companyId'],
            self::USER_ID => [$this, 'userId'],
        ];
    }


    public function companyId(Builder $builder, $value)
    {
        $builder->where('evaluated_company_id', $value);
    }

    public function userId(Builder $builder, $value)
    {
        $builder->where('evaluated_user_id', $value);
    }
}
