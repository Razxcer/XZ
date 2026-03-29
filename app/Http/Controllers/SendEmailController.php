<?php

namespace App\Http\Controllers;

use App\Mail\YouBuyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request) {
        // Валидация данных
        $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ]);

        // Отправка письма
        Mail::to($request->email)->send(new YouBuyMail($request->name));

        // Возврат ответа для Inertia
        return back();
    }
}
