<?php

namespace Database\Seeders;



use App\Models\Cat;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* هنا احنا استخدمنا هاس() سكيل فاكتورى علشان يضيف لكل كاتجورى
          سكيل خاص بيها وهو رقم 8 سكيل وتقدر تتحكم فيه */
          
        Cat::Factory()->has(
            Skill::Factory()->has(
                Exam::Factory()->has(
                    Question::factory()->count(15),
                    )->count(2)
            )->count(8) 
        )->count(5)->create();
    }
}
 /*  المثال السابق الاب كاتيحورى فيه5 كاتيحورى يحتوى على 8سكيلس والاسكيلس تحتوى على 2اكسزام 
 والاكسزام  الواحد يحتوى على15 سؤال   */
