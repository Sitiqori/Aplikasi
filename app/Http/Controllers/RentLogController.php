<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        return view('rentlog.rent_log', compact('rentlogs'));
    }

    public function cetak()
    {
        $rent = RentLogs::get();
        $datacetak = $rent; // Jika Anda ingin mengirimkan data lain ke view, Anda bisa menambahkannya di sini

        return view('rentlog.cetak', compact('rent', 'datacetak'));
    }
}
