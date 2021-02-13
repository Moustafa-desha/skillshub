<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;

class SkillController extends Controller
{
    public function show($id) {

        $skill = Skill::with('exams')->findOrFail($id);

        return new SkillResource($skill);
    }
}
