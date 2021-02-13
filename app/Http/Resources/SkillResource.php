<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name ('en'),
            'name_ar' => $this->name ('ar'),
            'img' => asset("uploads/$this->img"),
            // معناه لو طلبت منك تجيب الامتحانات تجيبهم مطلبتش اعمل نفسك اعمى وهات الاسكيلز بدون الامتحان
            'exams' => ExamResource::collection($this->whenLoaded('exams')),
        ];
    }
}
