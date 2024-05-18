<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentsResource;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class StudentApiController extends Controller
{
    public array  $rules = [
        'name' => ['required', 'string', 'max:191'],
        'course' => ['required', 'string', 'max:191'],
        'email' => ['required', 'email', 'max:191'],
        'phone' => ['required'],
    ];

    public function index()
    {
        return StudentsResource::collection(Student::all());
    }

    public function withCommandes()
    {
        return StudentsResource::collection(Student::with('commandes')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()->toArray()
            ], 422);
        }

        try {
            $student = Student::query()->create($request->all());
        } catch (Throwable $th) {
            return response([
                'data' => [
                    'message' => "Oups, une erreur est survenue!",
                    'cause' => $th->getMessage()
                ]
            ]);
        }

        return new StudentsResource($student);
    }

    public function show($id)
    {
        $student = Student::query()->firstWhere('slug', $id);

        if (!$student) {
            return response([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }

        return new StudentsResource($student);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()->toArray()
            ], 422);
        }

        $student = Student::query()->firstWhere('slug', $id);
        try {
            $student->update($request->all());
        } catch (Exception) {
            return response()->json([
                'status' => 500,
                'error' => 'An error occurred while updating the student'
            ], 500);
        }
        return new StudentsResource($student);
    }

    public function destroy($id)
    {
        $students = Student::query()->firstWhere('slug', $id);
        if ($students) {
            $students->delete();
            return response()->json([
                'statut' => 200,
                'message' => 'Student deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'statut' => 404,
                'message' => 'Not such student found'
            ], 404);
        }
    }
}
