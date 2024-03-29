<?php

namespace App\Services\Vacancy;

use App\Models\Vacancy;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\Area;
use App\Models\Skill;
use FFI\Exception;



class Service
{

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $skills = $data['skills'];
            $profession = $data['profession'];
            $area = $data['area'];

            unset($data['skills'], $data['profession'], $data['area']);

            $profession = empty($profession['id']) ?
                Profession::create($profession) :
                Profession::find($profession['id']);

            $area = empty($area['id']) ?
                Area::create($area) :
                Area::find($area['id']);

            $skillIds = [];
            foreach ($skills as $key => $skill) {

                $skill =  empty($skill['id']) ?
                    Skill::create(['name' => $skill['name'], 'profession_id' => $profession->id]) :
                    Skill::find($skill['id']);
                $skillIds[] = $skill->id;
            }

            $data['profession_id'] = $profession->id;
            $data['area_id'] = $area->id;

            $vacancy = Vacancy::create($data);
            $vacancy->skills()->attach($skillIds);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $vacancy;
    }

    public function update($vacancy, $data)
    {
        try {
            DB::beginTransaction();
            $skills = isset($data['skills']) ? $data['skills'] : false;
            $profession = isset($data['profession']) ? $data['profession'] : false;
            $area = isset($data['area']) ? $data['area'] : false;

            unset($data['skills'], $data['profession'], $data['area']);

            if ($profession) {
                $profession = empty($profession['id']) ?
                    Profession::create($profession) :
                    Profession::find($profession['id']);
                $data['profession_id'] = $profession->id;
            }
            if ($area) {
                $area = empty($area['id']) ?
                    Area::create($area) :
                    Area::find($area['id']);
                $data['area_id'] = $area->id;
            }

            if ($skills) {
                $skillIds = [];
                foreach ($skills as $key => $skill) {

                    $skill =  empty($skill['id']) ?
                        Skill::create(['name' => $skill['name'], 'profession_id' => $profession->id]) :
                        Skill::find($skill['id']);
                    $skillIds[] = $skill->id;
                }
                $vacancy->skills()->sync($skillIds);
            }

            $vacancy->update($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $vacancy;
    }
}
