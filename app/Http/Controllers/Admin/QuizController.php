<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreQuizRequest;
use App\Http\Requests\Admin\UpdateQuizRequest;
use App\Http\Controllers\Admin\Controller;
use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;

class QuizController extends Controller
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
        $query = Quiz::with('category')->latest('id');

        // Search filter
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->has('status') && $request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $quizzes = $query->get();
        $categories = Category::where('status', 'active')->orderBy('name')->get();

        return view('admin.quizzes.index', compact('quizzes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        return view('admin.quizzes.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        // Set created_by to logged-in admin
        $data['created_by'] = auth()->user()->id;

        // Enforce status and is_published mapping
        if ($data['status'] == 'published') {
            $data['is_published'] = true;
        } else {
            $data['is_published'] = false;
        }

        Quiz::create($data);

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Quiz has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        return view('admin.quizzes.form', compact('quiz', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizRequest $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $data = $request->except([
            '_token',
            '_method'
        ]);

        // Enforce status and is_published mapping
        if ($data['status'] == 'published') {
            $data['is_published'] = true;
        } else {
            $data['is_published'] = false;
        }

        $quiz->update($data);

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Quiz has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Quiz has been deleted successfully.');
    }

    /**
     * Handle bulk actions (delete, publish, archive).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,archive',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:quizzes,id',
        ]);

        $action = $request->action;
        $selectedIds = $request->selected_ids;

        switch ($action) {
            case 'delete':
                Quiz::whereIn('id', $selectedIds)->delete();
                $message = count($selectedIds) . ' quiz(es) have been deleted successfully.';
                break;

            case 'publish':
                Quiz::whereIn('id', $selectedIds)->update([
                    'status' => 'published',
                    'is_published' => true
                ]);
                $message = count($selectedIds) . ' quiz(es) have been published successfully.';
                break;

            case 'archive':
                Quiz::whereIn('id', $selectedIds)->update([
                    'status' => 'archived',
                    'is_published' => false
                ]);
                $message = count($selectedIds) . ' quiz(es) have been archived successfully.';
                break;

            default:
                return redirect()
                    ->route('admin.quizzes.index')
                    ->with('error', 'Invalid action.');
        }

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', $message);
    }

    /**
     * Publish a quiz.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'status' => 'published',
            'is_published' => true
        ]);

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Quiz has been published successfully.');
    }

    /**
     * Archive a quiz.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'status' => 'archived',
            'is_published' => false
        ]);

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Quiz has been archived successfully.');
    }
}
