<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;


class WebReviewFilter extends AbstractFilter
{
    public const ID = 'id';
    public const PARENT_ID = 'parent_id';
    public const EVALUABLE_USER_ID = 'evaluated_user_id';
    public const EVALUABLE_COMPANY_ID = 'evaluated_company_id';
    public const VOTE = 'vote';
    public const REVIEWS = 'review';

    public const COMPANY_ID = 'company_id';
    public const USER_ID = 'user_id';

    protected function getCallbacks(): array
    {
        return [
            self::ID => [$this,  'id'],
            self::PARENT_ID => [$this,  'parentId'],
            self::EVALUABLE_USER_ID => [$this,  'evaluatedUserId'],
            self::EVALUABLE_COMPANY_ID => [$this,  'evaluatedCompanyId'],
            self::VOTE => [$this,  'vote'],
            self::REVIEWS => [$this,  'review'],
            self::COMPANY_ID => [$this, 'companyId'],
            self::USER_ID => [$this, 'userId'],
        ];
    }

    public function vote(Builder $builder, $value)
    {
        $builder->where('vote', $value);
    }

    public function review(Builder $builder, $value)
    {
        $builder->where('review', 'like', "%{$value}%");
    }

    public function id(Builder $builder, $value)
    {
        $builder->where('id', $value);
    }

    public function parentId(Builder $builder, $value)
    {
        $builder->where('parent_id', $value);
    }

    public function evaluatedUserId(Builder $builder, $value)
    {
        $builder->where('evaluated_user_id', $value);
    }

    public function evaluatedCompanyId(Builder $builder, $value)
    {
        $builder->where('evaluated_company_id', $value);
    }

    public function companyId(Builder $builder, $value)
    {
        $builder->where('company_id', $value);
    }

    public function userId(Builder $builder, $value)
    {
        $builder->where('user_id', $value);
    }
}
