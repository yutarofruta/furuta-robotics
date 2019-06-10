<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->complete($id);
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        \Auth::user()->incomplete($id);
        return back();
    }
}
