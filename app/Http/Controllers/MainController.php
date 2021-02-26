<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacancy;
use App\Models\VacancyStatus;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class MainController extends Controller
{
    public function index()
    {
        if(Auth::check())
            return redirect()->route('vacancies', Auth::user()->id);
        else
            return view('index');
    }

    public function vacancies($user_id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if($user_id == $user->id) {
            $vacancies = Vacancy::where('user_id', $user_id)->paginate(5);
            return view('home', compact(['user', 'vacancies']));
        }
        else
            return abort(404);
    }

    public function search(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $validatedData = $request->validate([
            'search' => ['required'],
            'status' => ['in:ALL,CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
        ]);

        $vacancies = $user->vacancies;

        if(array_key_exists($validatedData['status'], VacancyStatus::statuses))
            $vacancies = $vacancies->toQuery()->where('status', VacancyStatus::statuses[$validatedData['status']])->get();

        if ($vacancies->count() > 0)
        {
            $vacancies = $vacancies->toQuery()->where('name', 'LIKE', "%{$validatedData['search']}%")->get();
        }
        return view('search', compact(['user', 'vacancies']));
    }
}
