<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;


class CandidateFilter extends AbstractFilter
{

    public const TITLE = 'title';
    public const PROFESSION_ID = 'profession_id';
    public const AREA_ID = 'area_id';
    public const USER_ID = 'user_id';
    public const SALARY = 'salary';
    public const EXPERIENCE_MONTHS = 'experience_months';
    public const TYPE_ID = 'type_id';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::PROFESSION_ID => [$this, 'professionId'],
            self::AREA_ID => [$this, 'areaId'],
            self::USER_ID => [$this, 'userId'],
            self::SALARY  => [$this, 'salary'],
            self::EXPERIENCE_MONTHS => [$this, 'experienceMonths'],
            self::TYPE_ID => [$this, 'typeId'],
        ];
    }
    public function salary(Builder $builder, $value)
    {
        $builder->where('salary', '<=', $value);
    }
    public function experienceMonths(Builder $builder, $value)
    {
        $builder->where('experience_months', '>=', $value);
    }
    public function typeId(Builder $builder, $value)
    {
        $builder->join('candidate_type', 'candidates.id', '=', 'candidate_type.candidate_id')
            ->where('candidate_type.type_id', $value);
        //     ->select('candidates.*');
        // $builder->whereHas('types', function (Builder $query) use ($value) {
        //     $query->where('type_id', $value);
        // });
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
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
        $builder->where('user_id', $value);
    }
}
