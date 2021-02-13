<?php

namespace App\Http\Controllers\web;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($examId){

                            $data['exam'] = Exam::findOrFail($examId);

                            // هنا هنتحقق من المستخدم انه مدخلش الامتحان قبل كدا ونمنعه من دخول الامتحان اكتر من مره عن طريق الstatus
                            $user = Auth::user();
                            $data['canViewStartBtn'] = true;

                            if ($user !== null) {
                                $pivotRow = $user->exams()->where('exam_id', $examId)->first();

                                if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                                $data['canViewStartBtn'] = false;
                                }
                            }

                            return view('web.exams.show')->with($data);

    }

    public function start($examId , Request $request){

                            $user = Auth::user();
                            if (! $user->exams->contains($userId)){
                            $user->exams()->attach($examId);
                            }else{
                                $user->exam()->updateExistingPivot($examId, [
                                    'status' =>'closed' ,
                                ]);
                            }

                                        // will save privous pag in session to make security for our url
                                $request->session()->flash('prev', "start/$examId");
                                
                            return redirect( url("exams/questions/$examId") );
    }

    public function questions($examId , Request $request){
                                //afer we use session we checik if he use right way or return back if he use url
                            if (session('prev')!== "start/$examId") {
                                return redirect( url("exams/show/$examId") );
                            }

                            $data['exam'] = Exam::findOrFail($examId);

                            // will save privous pag in session to make security for our url
                            $request->session()->flash('prev', "questions/$examId");

                            return view('web.exams.questions')->with($data);
    }


    public function submit($examId, Request $request){

                                //afer we use session we checik if he use right way or return back if he use url
                                if (session('prev')!== "questions/$examId") {
                                    return redirect( url("exams/show/$examId") );
                                }


                            $request->validate([
                                'answers' => 'required|array',
                                'answers.*' => 'required|in:1,2,3,4'
                            ]);

                            // calculation score
                            $exam = Exam::findOrFail($examId);

                            // point will be = 0 for default and will sum user right answer
                            $points = 0;

                            // count total questions by method count() , users answer to can count dgree 
                            $totalQuesNum = $exam->questions->count();


                            //then will make foreach in exam question and compear it with right answer 
                            foreach($exam->questions as $question) {
                                // نتحقق من الاجابه المختاره التابعه للسؤال عن طريق اى دى السؤال
                                if (isset ($request->answers[$question->id] )) {
                                    //هنحط الاجابه المختاره فوق فى متغير علشان نقارنها مع الاجابه الصحيحه
                                    $userAns = $request->answers[$question->id];
                                    // هنا هجيب الاجابه الصحيحه ونحطها فى متغير علشان نقدر نقارنها باجابة المستخدم 
                                    $rightAns = $question->right_ans;

                                    // نعمل if للمقانه بينهم وحساب النقاط
                                    if ($userAns == $rightAns)
                                    $points += 1;
                                }
                            }
                        //  لحساب المجموع الكلى نقوم باستخدام عدد الاجابات قسمه على عدد الاسئلة مضروب فى100 
                        $score = ($points / $totalQuesNum) * 100;

                        // calculating time in minuts by Carbon class
                        $user = Auth::user();

                        // هنجيب رقم الايدى بتاع الامتحان اللى دخلة اليورز
                        $pivotRow = $user->exams()->where('exam_id',$examId)->first();

                        // بعدين هنجيب وقت بداء الامتحان من جدول الرابط اليوزر بالامتحان
                        $startTime = $pivotRow->pivot->created_at;

                        // نستخدم كلاس الكابرون علشان نحسب الوقت اللى ضغط فيه على سابمت ونجيب الفرق بين وقت البدء والانتهاء
                        $submitTime = Carbon::now();

                            //  هنا استخدمنا ميسود ديفرنت ان مينتس لسحاب فرق الوقت اللى استغرقة ف الامتحان وتصفير الدرجات لو لعب ف الوقت
                        $timeMins = $submitTime->diffInMinutes($startTime);
                        if ($timeMins > $pivotRow->duration_mins){
                            $score = 0;
                        }



                        // update Pivot row with new data input score and time my method (updateExistingPivot)
                        $user->exams()->updateExistingPivot($examId, [
                            'score' => $score,
                            'time_mins' => $timeMins,
                        ]);

                            $request->session()->flash("success", "you finished exam successfully. your score $score%");
                            return redirect( url("exams/show/$examId") );

    }
}
