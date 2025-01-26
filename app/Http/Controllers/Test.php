<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function Cont(){
        return response()->json(['success'=> true, 'timestamp'=> \Carbon\Carbon::now()]);
    }
}
