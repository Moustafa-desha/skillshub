<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Cat;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Symfony\Contracts\Service\Attribute\Required;

class CatController extends Controller
{
    public function index() {

                $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(10);
                return view('admin.cats.index')->with($data);
    }


    public function store(Request $request)
    {
                $request->validate([
                    
                    'name_en' => 'required|string|max:50',
                    'name_ar' => 'required|string|max:50',
                ]);
                
                Cat::create([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                ]);
                $request->session()->flash('msg', 'Row added successfully');

                return back();
    }

    public function update(Request $request){

                $request->validate([
                     //  هنا هنجيب الادى بتاع المنتج المراد ونتحقق ان كان مود فعلا ف الجدول من خلال ميسود اكسيزت
                    'id' =>      'required|exists:cats,id',
                    'name_en' => 'required|string|max:50',
                    'name_ar' => 'required|string|max:50',
                ]);
                
                Cat::findOrFail($request->id)->update([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                ]);
                $request->session()->flash('msg', 'Row edited successfully');
                return back();

    }

    public Function toggle(Cat $cat){

                $cat->update([
                    'active' => ! $cat->active
                ]);
                return back();
    }

    public function delete(Cat $cat , Request $request){

                try {
                    $cat->delete();
                    $msg = 'row deleted successfully';
                } catch(Exception $e) {
                    $msg = "can't deleted this row";
                }
                
                $request->session()->flash('msg' , $msg);

                    return back();
    }

}
