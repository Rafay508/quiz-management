<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreQuestionRequest;
use App\Http\Requests\Admin\UpdateQuestionRequest;
use App\Http\Controllers\Admin\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Question::with(['quiz', 'options'])->where('question_type', 'mcq');

        // Quiz filter
        if ($request->has('quiz_id') && $request->quiz_id) {
            $query->where('quiz_id', $request->quiz_id);
        }

        // Difficulty filter
        if ($request->has('difficulty_level') && $request->difficulty_level) {
            $query->where('difficulty_level', $request->difficulty_level);
        }

        // Group by quiz if requested
        if ($request->has('group_by') && $request->group_by == 'quiz') {
            $questions = $query->orderBy('quiz_id')->orderBy('order_position')->get()->groupBy('quiz_id');
        } else {
            $questions = $query->latest('id')->get();
        }

        $quizzes = Quiz::where('status', '!=', 'archived')->orderBy('title')->get();

        return view('admin.questions.index', compact('questions', 'quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::where('status', '!=', 'archived')->orderBy('title')->get();
        return view('admin.questions.form', compact('quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        DB::beginTransaction();
        try {
            // Get the highest order_position for this quiz
            $maxOrder = Question::where('quiz_id', $request->quiz_id)->max('order_position') ?? 0;

            $question = Question::create([
                'quiz_id' => $request->quiz_id,
                'question_text' => $request->question_text,
                'question_type' => 'mcq',
                'difficulty_level' => $request->difficulty_level,
                'marks' => $request->marks,
                'negative_marks' => 0,
                'explanation' => $request->explanation,
                'order_position' => $maxOrder + 1,
            ]);

            // Create options
            if ($request->has('options') && is_array($request->options)) {
                foreach ($request->options as $index => $option) {
                    if (!empty($option['text'])) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $option['text'],
                            'is_correct' => isset($option['is_correct']) && $option['is_correct'] == '1',
                            'order_position' => $index + 1,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.questions.index')
                ->with('success', 'Question has been created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create question: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::with('options')->findOrFail($id);
        $quizzes = Quiz::where('status', '!=', 'archived')->orderBy('title')->get();
        return view('admin.questions.form', compact('question', 'quizzes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $question = Question::findOrFail($id);

            $question->update([
                'quiz_id' => $request->quiz_id,
                'question_text' => $request->question_text,
                'difficulty_level' => $request->difficulty_level,
                'marks' => $request->marks,
                'explanation' => $request->explanation,
            ]);

            // Delete existing options
            $question->options()->delete();

            // Create new options
            if ($request->has('options') && is_array($request->options)) {
                foreach ($request->options as $index => $option) {
                    if (!empty($option['text'])) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $option['text'],
                            'is_correct' => isset($option['is_correct']) && $option['is_correct'] == '1',
                            'order_position' => $index + 1,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.questions.index')
                ->with('success', 'Question has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update question: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()
            ->route('admin.questions.index')
            ->with('success', 'Question has been deleted successfully.');
    }

    /**
     * Quick update question fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quickUpdate(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'sometimes|string',
            'marks' => 'sometimes|integer|min:0',
        ]);

        $question = Question::findOrFail($id);
        $question->update($request->only(['question_text', 'marks']));

        return response()->json(['success' => true, 'message' => 'Question updated successfully.']);
    }

    /**
     * Download import template.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="questions_import_template.csv"',
        ];

        $data = [
            ['Question Text', 'Marks', 'Negative Marks', 'Difficulty Level (easy/medium/hard)', 'Explanation', 'Option 1', 'Option 1 Correct (1/0)', 'Option 2', 'Option 2 Correct (1/0)', 'Option 3', 'Option 3 Correct (1/0)', 'Option 4', 'Option 4 Correct (1/0)', 'Quiz ID'],
            ['What is 2+2?', '5', '1', 'easy', 'Basic addition', '3', '0', '4', '1', '5', '0', '6', '0', '1'],
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Import questions from CSV.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('import_file');
        $data = array_map('str_getcsv', file($file->getRealPath()));
        array_shift($data); // Remove header row

        DB::beginTransaction();
        try {
            $imported = 0;
            foreach ($data as $row) {
                if (count($row) < 14) continue;

                $quizId = $row[13] ?? null;
                if (!$quizId) continue;

                $maxOrder = Question::where('quiz_id', $quizId)->max('order_position') ?? 0;

                $question = Question::create([
                    'quiz_id' => $quizId,
                    'question_text' => $row[0] ?? '',
                    'question_type' => 'mcq',
                    'marks' => $row[1] ?? 1,
                    'negative_marks' => $row[2] ?? 0,
                    'difficulty_level' => in_array($row[3] ?? '', ['easy', 'medium', 'hard']) ? $row[3] : 'medium',
                    'explanation' => $row[4] ?? '',
                    'order_position' => ++$maxOrder,
                ]);

                // Create options
                for ($i = 0; $i < 4; $i++) {
                    $optionIndex = 5 + ($i * 2);
                    if (isset($row[$optionIndex]) && !empty($row[$optionIndex])) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $row[$optionIndex],
                            'is_correct' => isset($row[$optionIndex + 1]) && $row[$optionIndex + 1] == '1',
                            'order_position' => $i + 1,
                        ]);
                    }
                }

                $imported++;
            }

            DB::commit();

            return redirect()
                ->route('admin.questions.index')
                ->with('success', "Successfully imported {$imported} questions.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Failed to import questions: ' . $e->getMessage());
        }
    }
}
