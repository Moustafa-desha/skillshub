<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class StudentController extends Controller
{
    public function index(){

            // هنا بنجيب من جدول الرول الطالب ونحفظه ف متغير وبعد كدا بنروح لجدول اليوزر نجيب اليوزر اللى ايدى بتاعه بيساوى المتغير
            $studentRole = Role::where('name','student')->first();
            $data['students'] = User::where('role_id', $studentRole->id)
            ->orderBy('id','DESC')
            ->paginate(10);

            return view('admin.students.index')->with($data);
    }


    public function showScores($id){

            $student = User::findOrFail($id);
            if ($student->role->name !== 'student') {
                Return back();
            }

            $data['student'] = $student;
            $data['exams'] = $student->exams;

            return view('admin.students.show-scores')->with($data);
    }


    public function openExam($studentId, $examId) {


            $student = User::findOrFail($studentId);

            $student->exams()->updateExistingPivot($examId, [
                'status' => 'opened',
            ]);
            return back();
    }

    public function closeExam($studentId, $examId) {


        $student = User::findOrFail($studentId);

        $student->exams()->updateExistingPivot($examId, [
            'status' => 'closed',
        ]);
        return back();

    }
}
