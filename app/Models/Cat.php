<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Cat extends Model
{
    use HasFactory;
    //to till laravel this column fillabel by Opposite way usesr can't insert in this column 
    protected $guarded = ['id','created_at', 'updated_at'];

                                
                                    //relationship bettwen table
                                    public function skills(){
                                    return $this->hasMany(Skill::class);
    }

    public function name($lang = null){
                                    // for dashbord to read 2 diffrient langs
                                    $lang = $lang ?? App::getLocale();

                                    return json_decode($this->name)->$lang;
    }

    public function scopeActive($query) {

                                    return $query->where('active', 1);

    }
}
