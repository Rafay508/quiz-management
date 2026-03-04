<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UpdateGradingSchemeRequest;
use App\Models\GradingScheme;
use Illuminate\Http\Request;

class GradingSchemeController extends Controller
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
     * Display a listing of the grading schemes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradingSchemes = GradingScheme::orderBy('min_percentage', 'desc')->get();

        return view('admin.grading-schemes.index', compact('gradingSchemes'));
    }

    /**
     * Show the form for editing the specified grading scheme.
     *
     * @param  int  $grading_scheme
     * @return \Illuminate\Http\Response
     */
    public function edit($grading_scheme)
    {
        $gradingScheme = GradingScheme::findOrFail($grading_scheme);

        return view('admin.grading-schemes.edit', compact('gradingScheme'));
    }

    /**
     * Update the specified grading scheme in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateGradingSchemeRequest  $request
     * @param  int  $grading_scheme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradingSchemeRequest $request, $grading_scheme)
    {
        $gradingScheme = GradingScheme::findOrFail($grading_scheme);

        $data = $request->only([
            'min_percentage',
            'max_percentage',
            'reward_amount',
            'is_active',
        ]);

        // Handle is_active toggle (if not provided, keep current value)
        if (!$request->has('is_active')) {
            $data['is_active'] = $gradingScheme->is_active;
        }

        $gradingScheme->update($data);

        return redirect()
            ->route('admin.grading-schemes.index')
            ->with('success', 'Grading scheme has been updated successfully.');
    }
}
