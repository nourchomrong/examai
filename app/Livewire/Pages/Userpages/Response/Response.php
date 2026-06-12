<?php

namespace App\Livewire\Pages\Userpages\Response;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Question;

class Response extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $questionSetId;
    public $examId;
    public $selectedAttempt = [];
    public $showDeleteConfirm = false;
    public $attemptToDelete = null;

    public function mount($questionSetId = null)
    {
        $this->questionSetId = $questionSetId ?? request()->query('question_set');
        $this->examId = $this->questionSetId
            ? Exam::where('question_set_id', (int) $this->questionSetId)->value('id')
            : null;
    }

    public function viewAttempt($attemptId)
    {
        if (! $this->examId) {
            $this->selectedAttempt = [];
            return;
        }

        $attempt = ExamAttempt::with('answers.question')
            ->where('exam_id', $this->examId)
            ->find($attemptId);

        if (! $attempt) {
            $this->selectedAttempt = [];
            return;
        }

        $this->selectedAttempt = $attempt->toArray();
    }

    public function closeAttempt()
    {
        $this->selectedAttempt = [];
    }

    public function confirmDeleteAttempt($attemptId)
    {
        $this->showDeleteConfirm = true;
        $this->attemptToDelete = $attemptId;
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirm = false;
        $this->attemptToDelete = null;
    }

    public function deleteAttempt()
    {
        if (! $this->attemptToDelete) {
            return;
        }

        $attempt = ExamAttempt::where('id', $this->attemptToDelete)
            ->when($this->examId, fn($query) => $query->where('exam_id', $this->examId))
            ->first();

        if ($attempt) {
            $attempt->delete();
        }

        if (! empty($this->selectedAttempt) && isset($this->selectedAttempt['id']) && $this->selectedAttempt['id'] === $this->attemptToDelete) {
            $this->selectedAttempt = [];
        }

        $this->showDeleteConfirm = false;
        $this->attemptToDelete = null;
        $this->dispatch('attempt-deleted', ['message' => 'Attempt deleted successfully']);
    }

    public function render()
    {
        $attempts = ExamAttempt::with('user')
            ->where('exam_id', $this->examId)
            ->latest()
            ->paginate(10);

        $allAttempts = ExamAttempt::where('exam_id', $this->examId)->get();

        $stats = [
            'total_students' => $allAttempts->count(),
            'average_score'  => round($allAttempts->avg('percentage') ?? 0, 2),
            'highest_score'  => $allAttempts->max('percentage') ?? 0,
            'lowest_score'   => $allAttempts->min('percentage') ?? 0,
            'avg_time_formatted' => $this->formatTime(
                round($allAttempts->avg('time_used_seconds') ?? 0)
            ),
        ];

        $questionQuery = Question::whereHas(
            'answers.attempt',
            fn($q) => $q->where('exam_id', $this->examId)
        )
        ->with('answers');

        $questionAnalysis = $questionQuery->paginate(10);

        // Transform paginator collection into the analysis array
        $questionAnalysis->setCollection(
            $questionAnalysis->getCollection()->map(function ($question) {
                $total     = $question->answers->count();
                $correct   = $question->answers->where('is_correct', true)->count();
                $incorrect = $question->answers->where('is_correct', false)->count();
                $unanswered = $question->answers->whereNull('answer')->count();

                return [
                    'id'                 => $question->id,
                    'question'           => $question->question,
                    'difficulty'         => ucfirst($question->difficulty),
                    'correct'            => $correct,
                    'incorrect'          => $incorrect,
                    'unanswered'         => $unanswered,
                    'correct_percentage' => $total > 0
                        ? round(($correct / $total) * 100)
                        : 0,
                ];
            })
        );

        return view('livewire.pages.userpages.response.response', [
            'attempts'         => $attempts,
            'stats'            => $stats,
            'questionAnalysis' => $questionAnalysis,
        ]);
    }

    private function formatTime($seconds)
    {
        return sprintf('%02d:%02d', floor($seconds / 60), $seconds % 60);
    }
}