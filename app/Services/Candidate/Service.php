<?php

namespace App\Services\Candidate;

use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\Area;
use App\Models\Candidate;
use App\Models\Skill;
use App\Models\Type;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;

class Service
{

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $skills = $data['skills'];
            $profession = $data['profession'];
            $area = $data['area'];
            $typeId = $data['type_id'];

            unset($data['skills'], $data['profession'], $data['area'], $data['type_id']);

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
            $data['user_id'] = Auth::user()->id;

            $candidate = Candidate::create($data);
            $candidate->skills()->attach($skillIds);
            $candidate->types()->attach([$typeId]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $candidate;
    }

    public function update()
    {
    }
}
