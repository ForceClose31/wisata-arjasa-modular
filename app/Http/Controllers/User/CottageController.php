<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cottage;
use Illuminate\Contracts\View\View;

class CottageController extends Controller
{
    public function index(): View
    {
        // $cottages = Cottage::where('is_available', true)
        //     ->select('id', 'name', 'description', 'price', 'capacity', 'images')
        //     ->get();

        return view('user.cottage.cottage', compact('cottages'));
    }
}
