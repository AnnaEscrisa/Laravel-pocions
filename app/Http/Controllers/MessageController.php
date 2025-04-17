<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMissatges(){
        $missatges =  [
            'Missatge 1',
            'Missatge 2',
            'Missatge 3'
        ];

        return view('messages', $missatges);

    }
}
