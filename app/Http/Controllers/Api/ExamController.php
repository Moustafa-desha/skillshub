<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id) {

        $exam = Exam::findOrFail($id);

        return new ExamResource($exam);
    }

    public function showQuestions($id) {

        $exam = Exam::with('questions')->findOrFail($id);

        return new ExamResource($exam);
    }


    public function start($examId, Request $request) {
        // $request->user(); دى ميزه ف لارافيل بتجيب اليوزر سوا داخل ب توكن او سسيشن 
        //  هنحتاجها هنا علشان نربط الامتحان بالشخص ونحسب درجاته
        $request->user()->exams()->attach($examId);

        return response()->json([

            'message' => 'you started exam'
        ]);

    }


    public function submit($examId, Request $request){


                 $validator = Validator::make($request->all(), [
                    'answers' => 'required|array',
                    'answers.*' => 'required|in:1,2,3,4'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

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

                // $request->user(); دى من لارافيل علشان تجيب ايدى اليورز اللى دخل الامتحان
                $user = $request->user();

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

                  return response()->json([
                      "message" => "you finish exam and your Score is $score"
                  ]);

    }
}