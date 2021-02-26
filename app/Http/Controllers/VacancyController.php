<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\VacancyStatus;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{

    public function create()
    {
        return view('vacancy/create');
    }

    public function store(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'position' => ['required'],
            'status' => ['in:CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
            'contacts' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', '');
        } else {
            $vacancy = new Vacancy();
            $vacancy->user_id = $user_id;
            $vacancy->name = $request->name;
            $vacancy->position = $request->position;
            $vacancy->salary = $request->salary;
            $vacancy->link = $request->link;
            $vacancy->contacts = $request->contacts;
            $vacancy->status = VacancyStatus::statuses[$request->status];
            $vacancy->notes = $request->notes;
            $vacancy->save();
            return back()->with('success', '');
        }
    }

    public function show($user_id, $vacancy_id)
    {
        $vacancy = Vacancy::where(['id' => $vacancy_id, 'user_id' => $user_id])->first();
        if($vacancy)
            return view('vacancy/vacancy', compact('vacancy'));
        else
            return abort(404);
    }

    public function edit($user_id, $vacancy_id)
    {
        $vacancy = Vacancy::where(['id' => $vacancy_id, 'user_id' => $user_id])->first();
        if($vacancy)
            return view('vacancy/edit', compact('vacancy'));
        else
            return abort(404);
    }

    public function update(Request $request, $user_id, $vacancy_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'position' => ['required'],
            'status' => ['in:ALL,CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
            'contacts' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', '');
        } else {
            $vacancy = Vacancy::where(['id' => $vacancy_id, 'user_id' => $user_id])->first();
            $vacancy->user_id = $user_id;
            $vacancy->name = $request->name;
            $vacancy->position = $request->position;
            $vacancy->salary = $request->salary;
            $vacancy->link = $request->link;
            $vacancy->contacts = $request->contacts;
            $vacancy->status = VacancyStatus::statuses[$request->status];
            $vacancy->notes = $request->notes;
            $vacancy->save();
            return back()->with('success', '');
        }
    }

}
