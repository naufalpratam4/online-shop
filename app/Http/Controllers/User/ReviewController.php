<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $user = auth()->user();

        // Menghapus baris ini karena kita tidak perlu mencari review berdasarkan user ID
        // $review = Review::find($user->id);

        foreach ($request->input('product_id') as $productId) {
            // Buat atau perbarui review jika sudah ada
            $review = Review::updateOrCreate(
                ['user_id' => $user->id, 'product_id' => $productId],
                [
                    // 'rating' => $request->input('rating'), // Jika Anda memiliki field rating
                    'comment' => $request->input('comment'),
                    'reviewDate' => now()
                ]
            );
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan review');
    }
}
