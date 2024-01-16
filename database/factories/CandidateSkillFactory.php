<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CandidateSkill;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CandidateSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $candidate = Candidate::get()->random();
        $professionId = $candidate->profession_id;

        $skill = Skill::where('profession_id', $professionId)->inRandomOrder()->first();

        $uniqueCheck = CandidateSkill::where('candidate_id', $candidate->id)
            ->where('skill_id', $skill->id)
            ->count();

        while ($uniqueCheck > 0) {
            $candidate = Candidate::get()->random();
            $professionId = $candidate->profession_id;
            $skill = Skill::where('profession_id', $professionId)->inRandomOrder()->first();

            $uniqueCheck = CandidateSkill::where('candidate_id', $candidate->id)
                ->where('skill_id', $skill->id)
                ->count();
        }
        return [
            'candidate_id' =>   $candidate->id,
            'skill_id' =>  $skill->id,
        ];
    }
}
