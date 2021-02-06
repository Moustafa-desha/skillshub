<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    
        //to till laravel this column fillabel by Opposite way usesr can't insert in this column 
        protected $guarded = ['id','created_at', 'updated_at'];

  
        //relationship bettwen table

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
    
    public function questions(){

        return $this->hasMany(Question::class);
    }

    public function users(){
                                return $this->belongsToMany(User::class)
                                ->withPivot('score', 'time_mins', 'status')->withTimestamps();
    }

    public function name($lang = null){
                                // for dashbord to read 2 diffrient langs
                                $lang = $lang ?? App::getLocale();

                                return json_decode($this->name)->$lang;
    }

    public function desc($lang = null){
                                // for dashbord to read 2 diffrient langs
                                $lang = $lang ?? App::getLocale();

                                return json_decode($this->desc)->$lang;
    }


    public function scopeActive($query) {

                                 return $query->where('active', 1);

}
}
