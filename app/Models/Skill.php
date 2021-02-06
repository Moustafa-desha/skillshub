<?php

namespace App\Models;

use App\Models\Cat;
use App\Models\Exam;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Stmt\Return_;

class Skill extends Model
{
    use HasFactory;

        //to till laravel this column fillabel by Opposite way usesr can't insert in this column 
        protected $guarded = ['id','created_at', 'updated_at'];

  
        //relationship bettwen table

    public function cat(){
        
                        return $this->belongsTo(Cat::class);
    }

    public function exams(){

                         return $this->hasMany(Exam::class);
    }

    public function name($lang = null){
                         // for dashbord to read 2 diffrient langs

                         $lang = $lang ?? App::getLocale();
                         return json_decode($this->name)->$lang;
    }

                    // to count how many student in exam
    public function studentsCount(){

                             $studentsNum= 0;
                            foreach($this->exams as $exam){
                                $studentsNum += $exam->users()->count();
                            }

                                return $studentsNum;

    }

    public function scopeActive($query) {

                            return $query->where('active', 1);

    }
}
