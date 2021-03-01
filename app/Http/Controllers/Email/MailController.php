<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\SendFeedback;
use App\Models\Vacancy;
use App\Models\VacancyStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail($user_id, $vacancy_id)
    {
        $vacancy = Vacancy::where(['id' => $vacancy_id])->first();

        if($vacancy->mailable()) {
            Mail::to($vacancy->contacts)->send(new SendFeedback());
        }

        return redirect()->route('vacancies', ['user_id' => auth()->user()->id]);
    }
}
