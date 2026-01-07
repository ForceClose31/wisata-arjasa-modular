<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transportation;
use Illuminate\Contracts\View\View;

class TransportController extends Controller
{
    public function index(): View
    {
        // $transportations = Transportation::select(
        //     'id',
        //     'name',
        //     'description',
        //     'image',
        //     'phone',
        //     'price',
        //     'duration'
        // )
        //     ->get();

        return view('user.transport.transport', compact('transportations'));
    }
}
