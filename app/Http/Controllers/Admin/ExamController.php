<?php

namespace App\Http\Controllers\Admin;

use App\Events\ExamAddedEvent;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index() {

                $data['exams'] = Exam::select('id','name','skill_id','img','questions_num','active')
                ->orderBy('id', 'DESC')->paginate(10);
                
                return view('admin.exams.index')->with($data);
    }

            //  دة معناه اختصار لفايند او فيلد  الامتحان الخاص بايدى ده وابعت معاه الداتا
    public function show(Exam $exam){

                $data['exam'] = $exam;

                return view('admin.exams.show')->with($data);
    }

    public function showQuestions(Exam $exam){

            $data['exam'] = $exam;

            return view('admin.exams.show-questions')->with($data);
    }


    public function create(){

                // دى علشان السيلكت اوبشن اللى هنضيف تحتها الامتحان
            $data['skills'] = Skill::select('id','name')->get();

            return view('admin.exams.create')->with($data);

    }


    public function store(Request $request)
    {
        
                $request->validate([
                    
                    'name_en' =>    'required|string|max:50',
                    'name_ar' =>    'required|string|max:50',
                    'desc_en'    =>    'required|string',
                    'desc_ar'    =>    'required|string',
                    'img'     =>    'required|image|max:2048',
                    'skill_id'=>    'required|exists:skills,id',
                    'questions_num'=> 'required|integer|min:1',
                    'difficulty'=>   'required|integer|min:1|max:5',
                    'duration_mins'=> 'required|integer|min:1',
                ]);
                
                // ده مسار حفظ الصور ولازم نظبطة فى ملف filesystem 
                $path = Storage::putFile("exams", $request->file('img'));

                $exam  = Exam::create([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),

                    'desc' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),

                        'img' => $path,
                        'skill_id' =>$request->skill_id,
                        'questions_num'=> $request->questions_num,
                        'difficulty'=> $request->difficulty,
                        'duration_mins'=> $request->duration_mins,
                        // دى علشان ميظهرش اسم الامتحان قبل ما يضيف الاسئلة بتاعته لما يضيف الاسئلة هنخليها ترو
                        'active' => 0 ,
                ]);
                
                        // دى علشان ميدخلش على كريت اكزام على طول لازم يمر من هنا الاول
                        $request->session()->flash('prev',"exam/$exam->id");
                        return redirect( url("dashboard/exams/create-questions/{$exam->id}") );
            }



    public function createQuestions(Exam $exam, Request $request){

             //    دى بنفحص ان كان مرمش اضافة الامتحان الاول قبل ما يضيف الاسئلة وكمان لو محصلش معاه خطا فى نفس الصفحه بنرجعه ع الصفحه دى

                        if (session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id"){
                            return redirect ( url("dashboard/exams") );
                        }

                            $data['exam_id'] = $exam->id;
                            $data['questions_num'] = $exam->questions_num; 

                            return view('admin.exams.create-questions')->with($data);

    }


    public function storeQuestions(Exam $exam, Request $request){

        // هنا بنتاكد ان لو حصل معاه خطا بنشيله السيشن ونرجعه نفس الصفحه ولو مفيش فوق بنرجعه لصفحه تانيه
            $request->session()->flash('current', "exam/$exam->id");

                        $request->validate([

                                'titles' => 'required|array',
                                'titles.*' => 'required|string|max:500',
                                'right_ans' => 'required|array',
                                'right_ans.*' => 'required|integer|in:1,2,3,4',
                                'option_1s' => 'required|array',
                                'option_1s.*' => 'required|string|max:255',
                                'option_2s' => 'required|array',
                                'option_2s.*' => 'required|string|max:255',
                                'option_3s' => 'required|array',
                                'option_3s.*' => 'required|string|max:255',
                                'option_4s' => 'required|array',
                                'option_4s.*' => 'required|string|max:255',
                        ]);
                         
                        for ($i=0; $i < $exam->questions_num; $i++) {

                            Question::create([
                                    'exam_id' => $exam->id,
                                    'title' => $request->titles[$i],
                                    'option_1' => $request->option_1s[$i],
                                    'option_2' => $request->option_2s[$i],
                                    'option_3' => $request->option_3s[$i],
                                    'option_4' => $request->option_4s[$i],
                                    'right_ans' => $request->right_ans[$i],

                            ]);
                        }

                        // هنا هنفتح الامتحان بعد ما ضاف الاسئله ونحوله للصفحه
                        $exam->update([
                                'active' => 1,
                        ]);


                    //    هنا هنفعل البوشر عن طريق ميسود الايفنت واسم الايفنت اللى انشاناه
                        event(new ExamAddedEvent);

                        return redirect( url("dashboard/exams") );
                    }


    public function edit(Exam $exam){

                        $data['skills'] = Skill::select('id','name')->get();
                        $data['exam'] = $exam;

                        return view('admin.exams.edit')->with($data);
    }



    public function update(Exam $exam, Request $request){


                    $request->validate([
                        'name_en' => 'required|string|max:50',
                        'name_ar' => 'required|string|max:50',
                        'desc_en' => 'required|string|max:5000',
                        'desc_ar' => 'required|string|max:5000',
                        'img'     => 'nullable|image|max:2048',
                        'skill_id' => 'required|exists:skills,id',
                        'difficulty' => 'required|integer|min:1|max:5',
                        'duration_mins' => 'required|integer|min:1',
                    ]);

                    $path = $exam->img;

                    if ($request->hasFile('img')){
                        Storage::delete($path);
                        $path = Storage::putFile("exams", $request->file('img'));
                    }

                    $exam->update([

                        'name' => json_encode([
                            'en' => $request->name_en,
                            'ar' => $request->name_ar,
                        ]),
    
                        'desc' => json_encode([
                            'en' => $request->name_en,
                            'ar' => $request->name_ar,
                        ]),
    
                            'img' => $path,
                            'skill_id' =>$request->skill_id,
                            'difficulty'=> $request->difficulty,
                            'duration_mins'=> $request->duration_mins,
                    ]);
                    $request->session()->flash('msg', 'Row updated successfully');
                    
                    return redirect( url("dashboard/exams/show/$exam->id") );
    }



    public function toggle(Exam $exam){

                        if ($exam->questions_num == $exam->questions()->count()) {
                                    $exam->update(['active' => ! $exam->active]);
                            }
                                return back();
    }


    public function delete(Exam $exam, Request $request){


                    try{
                        $path = $exam->img;
                        $exam->questions()->delete();
                        $exam->delete();
                        Storage::delete($path);
                        $msg = "row deleted successfully";
                    }catch(Exception $e){
                        $msg = "can't delete this row";
                    }

                    $request->session()->flash('msg', $msg);
                    return back();
    }


    public function editQuestion(Exam $exam, Question $question){

                        $data['exam'] = $exam;
                        $data['ques'] = $question;
                        

                        return view('admin.exams.edit-question')->with($data);
    }


    public function updateQuestion(Exam $exam , Question $question , Request $request){

                    $data = $request->validate([

                            'title' =>     'required|string|max:500',
                            'right_ans' => 'required|integer|in:1,2,3,4',
                            'option_1' =>  'required|string|max:255',
                            'option_2' =>  'required|string|max:255',
                            'option_3' =>  'required|string|max:255',
                            'option_4' =>  'required|string|max:255',
                    ]);

                    $question->update($data);

                return redirect( url("dashboard/exams/show-questions/$exam->id") );
    }

}
