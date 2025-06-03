<?php

namespace App\Http\Controllers;

use App\Models\CarRequest;
use Illuminate\Http\Request;

class DirectorController extends Controller
{

    public function dashboard()
    {
        return view('director.directordashboard');
    }

    public function directorlist()
    {
        $requests = CarRequest::with(['driver'])->whereIn('status', ['approved', 'pending', 'rejected'])->get();
        return view('director.director_list', compact('requests'));
    }
}
