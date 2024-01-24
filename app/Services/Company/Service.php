<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Http\Request;
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
            $company = $data;
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $company;
    }

    public function update()
    {
    }
}
