<?php

namespace App\Services\Ai;

class InterviewService
{
    public function generateQuestions(string $role, string $category, string $difficulty): array
    {
        $questionsByRole = [
            'Software Engineer' => [
                'Describe a project where you improved performance and explain your approach.',
                'How do you handle debugging a production issue under pressure?',
                'What is the difference between REST and GraphQL?',
                'How do you ensure code quality in a team environment?',
            ],
            'Product Manager' => [
                'How do you prioritize features when stakeholders disagree?',
                'Describe how you measure product success.',
                'How do you handle ambiguous requirements?',
                'Tell us about a time you pushed back on a bad decision.',
            ],
            'Data Analyst' => [
                'How do you clean messy business data?',
                'Describe how you validate a dashboard before presenting it to stakeholders.',
                'What metrics would you use to judge campaign performance?',
                'How do you explain technical findings to non-technical users?',
            ],
        ];

        $base = $questionsByRole[$role] ?? [
            'Tell me about a time you solved a difficult challenge.',
            'What would you do if priorities changed mid-project?',
            'Why do you want this role?',
            'How do you measure success in your work?',
        ];

        $selected = array_slice($base, 0, 3);

        return array_map(fn($question) => [
            'question' => $question,
            'category' => $category,
            'difficulty' => $difficulty,
        ], $selected);
    }

    public function evaluateAnswer(string $answer): array
    {
        $wordCount = str_word_count(strip_tags($answer));
        $score = min(100, max(50, 50 + ($wordCount / 10)));

        $strengths = [
            'Clear explanation of the situation and decision-making process.',
            'Good use of examples and structured reasoning.',
        ];

        $weaknesses = [
            'Add more concrete outcomes and measurable impact.',
            'Include a stronger example of how you collaborated with teammates.',
        ];

        $suggestedAnswer = 'Start by describing the challenge, explain the steps you took, mention the metrics or business impact, and finish with what you learned and how it improved the result.';

        return [
            'score' => (int) round($score),
            'strengths' => $strengths,
            'weaknesses' => $weaknesses,
            'suggested_answer' => $suggestedAnswer,
            'topics_to_revise' => ['Behavioral examples', 'Impact measurement', 'Communication structure'],
        ];
    }
}
