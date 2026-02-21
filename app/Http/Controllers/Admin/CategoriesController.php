<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Controllers\Admin\Controller;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
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
    public function index()
    {
        $categories = Category::withCount('quizzes')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $data['created_by'] = auth()->user()->id;

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category has been added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->except([
            '_token',
            '_method'
        ]);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $quizCount = $category->quizzes()->count();

        // If there are quizzes and transfer_category_id is provided, transfer them
        if ($quizCount > 0 && $request->has('transfer_category_id') && $request->transfer_category_id) {
            $transferCategoryId = $request->transfer_category_id;
            
            // Verify the transfer category exists
            $transferCategory = Category::findOrFail($transferCategoryId);
            
            // Transfer quizzes to the new category
            Quiz::where('category_id', $id)->update(['category_id' => $transferCategoryId]);
        } elseif ($quizCount > 0) {
            // If there are quizzes but no transfer category specified, prevent deletion
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Cannot delete category with quizzes. Please transfer quizzes to another category first.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category has been deleted successfully.');
    }

    /**
     * Display category-wise reports.
     *
     * @param  int|null  $id
     * @return \Illuminate\Http\Response
     */
    public function reports($id = null)
    {
        if ($id) {
            // Single category report
            $category = Category::with(['quizzes' => function($query) {
                $query->withCount('quizAttempts');
            }])->findOrFail($id);

            $quizzes = $category->quizzes()->withCount('quizAttempts')->get();
            
            $totalQuizzes = $quizzes->count();
            $totalAttempts = $quizzes->sum('quiz_attempts_count');
            $publishedQuizzes = $quizzes->where('is_published', true)->count();
            $draftQuizzes = $quizzes->where('status', 'draft')->count();

            return view('admin.categories.reports', compact('category', 'quizzes', 'totalQuizzes', 'totalAttempts', 'publishedQuizzes', 'draftQuizzes'));
        } else {
            // All categories report
            $categories = Category::withCount(['quizzes' => function($query) {
                $query->where('is_published', true);
            }])->get();

            $categoryStats = [];
            foreach ($categories as $category) {
                $quizzes = Quiz::where('category_id', $category->id)->get();
                $categoryStats[] = [
                    'category' => $category,
                    'total_quizzes' => $quizzes->count(),
                    'published_quizzes' => $quizzes->where('is_published', true)->count(),
                    'draft_quizzes' => $quizzes->where('status', 'draft')->count(),
                    'total_attempts' => DB::table('quiz_attempts')
                        ->join('quizzes', 'quiz_attempts.quiz_id', '=', 'quizzes.id')
                        ->where('quizzes.category_id', $category->id)
                        ->count(),
                ];
            }

            return view('admin.categories.reports', compact('categoryStats'));
        }
    }
}
