<?php

namespace App\Http\Controllers;

use App\Models\PerformanceReview;
use Illuminate\Http\Request;

class PerformanceReviewController extends Controller
{
    public function index()
    {
        return response()->json(PerformanceReview::with(['employee', 'reviewer'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reviewer_id' => 'required|exists:users,id',
            'review_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:10',
            'comments' => 'nullable|string',
        ]);

        $review = PerformanceReview::create($request->all());
        return response()->json($review, 201);
    }

    public function show($id)
    {
        return response()->json(PerformanceReview::with(['employee', 'reviewer'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $review = PerformanceReview::findOrFail($id);
        $review->update($request->all());
        return response()->json($review);
    }

    public function destroy($id)
    {
        PerformanceReview::destroy($id);
        return response()->json(null, 204);
    }
}
