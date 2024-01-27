<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;


class VacancyFilter extends AbstractFilter
{

    public const NAME = 'name';
    public const PROFESSION_ID = 'profession_id';
    public const AREA_ID = 'area_id';
    public const USER_ID = 'user_id';

    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::PROFESSION_ID => [$this, 'professionId'],
            self::AREA_ID => [$this, 'areaId'],
            self::USER_ID => [$this, 'userId'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function professionId(Builder $builder, $value)
    {
        $builder->where('profession_id', $value);
    }
    public function areaId(Builder $builder, $value)
    {
        $builder->where('area_id', $value);
    }

    public function userId(Builder $builder, $value)
    {
        $builder->join('companies', 'vacancies.company_id', '=', 'companies.id')
            ->where('companies.user_id', $value);
    }
}
