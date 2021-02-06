<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*دى لتفنفيذ ميسود الديفنشن اول مره اسم الصوره بزيد و تانى مره
         static $i =0;
         $i++;
           اسم الصوره بيزيد رقم على اخر رقم كان والاساستك دى بتتفذ اول مره فقط */

        static $i = 0;
        $i++;

        return [
                'name' => json_encode([
                                       'en' => $this->faker->word(),
                                       'ar' => $this->faker->word(),
                ]),
                'img' => "skills/$i.png",
        ];
    }
}
