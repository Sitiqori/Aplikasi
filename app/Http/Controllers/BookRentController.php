<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('books.book-rent', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request['tanggal_peminjaman'] = Carbon::now()->toDateString();
        $request['tanggal_harus_dikembalikan'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');
        if ($book['status'] != 'in stock') {
            Session::flash('message', 'Cannot rent, the book is not available');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/book-rent');
        } else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('message', 'Cannot Rent, user has reach limit of book');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/book-rent');
            } else {
                try {
                    DB::beginTransaction();
                    RentLogs::create($request->all());
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', 'Rent book success');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/book-rent');
                } catch (\Throwable $th) {
                    DB::rollback();
                    dd($th);
                }
            }
        }

        
    }













    public function pinjam(Request $request)
    {
        // Validasi request
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Dapatkan informasi buku
        $book = Book::findOrFail($request->book_id);

        // Cek apakah buku tersedia
        if ($book->status == 'in stock') {
            // Lakukan peminjaman
            $rentLog = new RentLogs;
            $rentLog->book_id = $book->id;
            $rentLog->user_id = auth()->user()->id;
            $rentLog->tanggal_peminjaman = now();
            $rentLog->tanggal_harus_dikembalikan = now()->addDays(3); // Tanggal harus dikembalikan 3 hari ke depan
            $rentLog->status_peminjaman = 'dipinjam';
            $rentLog->save();

            // Update status buku menjadi dipinjam
            $book->status = 'dipinjam';
            $book->save();

            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'error', 'error' => 'Buku tidak tersedia'], 422);
        }
    }


    public function kembali(Request $request)
    {
        // Temukan log peminjaman berdasarkan ID
        $rentLog = RentLogs::findOrFail($request->id);

        // Update status peminjaman dan tanggal pengembalian aktual
        $rentLog->status_peminjaman = 'dikembalikan';
        $rentLog->tanggal_pengembalian = now();
        $rentLog->save();

        // Dapatkan informasi buku
        $book = Book::findOrFail($rentLog->book_id);

        // Update status buku menjadi tersedia
        $book->status = 'in stock';
        $book->save();

        return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan.');
    }



    public function review(Request $request)
{
    // Validasi request
    $request->validate([
        'rent_log_id' => 'required|exists:rent_logs,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string',
    ]);
    
    // Dapatkan book_id dari rent_log_id
    $bookId = RentLogs::findOrFail($request->rent_log_id)->book_id;

    // Simpan review ke database
    $review = new UlasanBuku;
    $review->user_id = auth()->user()->id;
    $review->rent_log_id = $request->rent_log_id;
    $review->rating = $request->rating;
    $review->ulasan = $request->review;
    $review->books_id = $bookId; // Mengisi 'books_id' dengan ID buku yang sesuai
    $review->save();

    return redirect()->back()->with('success', 'Review telah berhasil disimpan.');
}


}
