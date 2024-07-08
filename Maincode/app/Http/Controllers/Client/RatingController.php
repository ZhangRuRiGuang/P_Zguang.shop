<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function addRating(Request $request) {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/ratings', $request->image->getClientOriginalName());
                Rating::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'star' => $request->star,
                    'comment' => $request->comment,
                    'image' => '/storage/images/ratings/' . $request->image->getClientOriginalName(),
                ]);
            } else {
                Rating::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'star' => $request->star,
                    'comment' => $request->comment,
                ]);
            }
        } else {
            Rating::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'star' => $request->star,
                'comment' => $request->comment,
            ]);
        }

        return redirect()->back();
    }
}
