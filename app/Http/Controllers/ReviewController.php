<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(){
        return view('client-review.add');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'client_message' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'=>'required|integer',
        ]);
        $filePath = '';

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = uniqid('img') . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('client_review', $fileName, 'public');
        }
        $Client_Review = Review::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'client_message' => $request->input('client_message'),

            'picture' => $filePath,
            'status' => $request->input('status'),
        ]);

        flashy()->success('✅ Review Created Successfully','#');
        // Redirect or return a response
        return redirect()->route('client.reviewCreate');
    }
    public function list(){
        $reviews = Review::all(); // Fetch all reviews from the database

        return view('client-review.list', compact('reviews'));

    }
    public function delete($id)
    {
        $review = Review::find($id);
        $review->delete();
        flashy()->success('✅ Review Deleted Successfully','#');
        // Redirect or return a response
        return redirect()->route('client.reviewList');

    }
    public function edit($id) {
        $edit = Review::find($id);
        return view('client-review.edit', compact('edit'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'client_message' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|integer',
        ]);

        $review = Review::find($id);

        $review->name = $request->input('name');
        $review->category = $request->input('category');
        $review->client_message = $request->input('client_message');
        $review->status = $request->input('status');

        if ($request->hasFile('picture')) {
            // Handle picture upload if a new picture is provided
            $file = $request->file('picture');
            $fileName = uniqid('img') . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('client_review', $fileName, 'public');

            // Delete the old picture if it exists
            if ($review->picture) {
                \Storage::disk('public')->delete($review->picture);
            }

            $review->picture = $filePath;
        }

        $review->save();

        flashy()->success('✅ Review Updated Successfully', '#');
        return redirect()->route('client.reviewList');
    }
}