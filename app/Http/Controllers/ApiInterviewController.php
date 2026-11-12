<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewRequest;
use App\Models\InterviewQuestion;
use App\Services\Ai\InterviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiInterviewController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => $request->user()->interviewSessions()->with('questions')->latest()->get()]);
    }

    public function store(InterviewRequest $request, InterviewService $service): JsonResponse
    {
        $session = $request->user()->interviewSessions()->create([
            'role' => $request->input('role'),
            'difficulty' => $request->input('difficulty'),
            'category' => $request->input('category'),
            'status' => 'active',
        ]);

        foreach ($service->generateQuestions($request->input('role'), $request->input('category'), $request->input('difficulty')) as $questionData) {
            $session->questions()->create($questionData);
        }

        return response()->json(['message' => 'Interview session created', 'data' => $session], 201);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $session = $request->user()->interviewSessions()->with('questions.answer')->findOrFail($id);

        return response()->json(['data' => $session]);
    }

    public function answer(InterviewRequest $request, int $id): JsonResponse
    {
        $question = InterviewQuestion::findOrFail($request->input('question_id'));
        $evaluation = (new InterviewService)->evaluateAnswer($request->input('answer'));

        $question->answer()->updateOrCreate([], [
            'answer_text' => $request->input('answer'),
            'score' => $evaluation['score'],
            'feedback' => json_encode($evaluation['weaknesses']),
            'strengths' => json_encode($evaluation['strengths']),
            'weaknesses' => json_encode($evaluation['weaknesses']),
            'suggested_answer' => $evaluation['suggested_answer'],
        ]);

        return response()->json(['message' => 'Answer evaluated', 'data' => $evaluation]);
    }
}
