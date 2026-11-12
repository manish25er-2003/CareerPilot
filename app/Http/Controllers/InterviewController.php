<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewRequest;
use App\Models\InterviewQuestion;
use App\Services\Ai\InterviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InterviewController extends Controller
{
    public function index(): View
    {
        $sessions = Auth::user()->interviewSessions()->with('questions.answer')->latest()->get();

        return view('interviews.index', compact('sessions'));
    }

    public function store(InterviewRequest $request, InterviewService $interviewService): RedirectResponse
    {
        $session = Auth::user()->interviewSessions()->create([
            'role' => $request->input('role'),
            'difficulty' => $request->input('difficulty'),
            'category' => $request->input('category'),
            'status' => 'active',
        ]);

        foreach ($interviewService->generateQuestions($request->input('role'), $request->input('category'), $request->input('difficulty')) as $questionData) {
            $session->questions()->create($questionData);
        }

        return redirect()->route('interviews.index')->with('success', 'Interview session started.');
    }

    public function show(int $id)
    {
        $session = Auth::user()->interviewSessions()->with('questions.answer')->findOrFail($id);

        return view('interviews.show', compact('session'));
    }

    public function answer(InterviewRequest $request, int $id, InterviewService $interviewService): RedirectResponse
    {
        $question = InterviewQuestion::findOrFail($request->input('question_id'));

        if ($question->session->user_id !== Auth::id()) {
            abort(403);
        }

        $evaluation = $interviewService->evaluateAnswer($request->input('answer'));

        $question->answer()->updateOrCreate([], [
            'answer_text' => $request->input('answer'),
            'score' => $evaluation['score'],
            'feedback' => json_encode($evaluation['weaknesses']),
            'strengths' => json_encode($evaluation['strengths']),
            'weaknesses' => json_encode($evaluation['weaknesses']),
            'suggested_answer' => $evaluation['suggested_answer'],
        ]);

        $session = $question->session;
        $average = (int) round($session->questions()->with('answer')->get()->avg(fn ($question) => $question->answer?->score ?? 0));
        $session->update(['total_score' => $average, 'summary' => 'Interview evaluated.']);

        return redirect()->route('interviews.show', $session->id)->with('success', 'Your answer was evaluated successfully.');
    }
}
