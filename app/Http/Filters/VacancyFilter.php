<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class VacancyFilter extends AbstractFilter
{

    public const TITLE = 'title';
    public const PROFESSION_ID = 'profession_id';
    public const AREA_ID = 'area_id';
    public const USER_ID = 'user_id';
    public const CLOSED = 'closed';
    public const SALARY = 'salary';
    public const EXPERIENCE_MONTHS = 'experience_months';
    public const NATURE_ID = 'nature_id';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::PROFESSION_ID => [$this, 'professionId'],
            self::AREA_ID => [$this, 'areaId'],
            self::USER_ID => [$this, 'userId'],
            self::CLOSED => [$this, 'closed'],
            self::SALARY  => [$this, 'salary'],
            self::EXPERIENCE_MONTHS => [$this, 'experienceMonths'],
            self::NATURE_ID => [$this, 'natureId'],
        ];
    }
    public function salary(Builder $builder, $value)
    {
        $builder->where('salary', '>=', $value);
    }
    public function experienceMonths(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {
            $query->where('experience_months', '<=', $value)
                ->orWhereNull('experience_months');
        });
    }
    public function natureId(Builder $builder, $value)
    {
        $builder->where('nature_id', $value);
    }
    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function professionId(Builder $builder, $value)
    {
        $builder->where('profession_id', $value);
    }
    public function closed(Builder $builder, $value)
    {
        $builder->where('closed', (bool) !$value);
    }
    public function areaId(Builder $builder, $value)
    {
        $builder->where('area_id', $value);
    }

    public function userId(Builder $builder, $value)
    {
        $builder->join('companies', 'vacancies.company_id', '=', 'companies.id')
            ->where('companies.user_id', $value)
            ->select('vacancies.*');;
    }
}
