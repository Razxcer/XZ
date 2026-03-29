<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function kubiki() {
        return Inertia::render('components/gameKubiki/GameKubiki');
    }
}
