<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

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
                'desc' => json_encode([
                                     'en' => $this->faker->text(5000),
                                     'ar' => $this->faker->text(5000),
                ]),
                'img' => "exams/$i.png",
                'questions_num' => 15,
                'difficulty' => $this->faker->numberBetween(1,5),
  //لتحديد وقت الامتحان بنضيف عدد الامتحان من 1 الى 3 وبنضربه فى مدة الامتحان الواحد 30 دقيقه              
                'duration_mins' => $this->faker->numberBetween(1,3) * 30,
        ];
    }
}
