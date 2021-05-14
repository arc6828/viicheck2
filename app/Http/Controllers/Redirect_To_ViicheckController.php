<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Redirect_To_ViicheckController extends Controller
{
    public function modal()
    {
        return redirect('https://www.viicheck.com/modal');
    }
}
