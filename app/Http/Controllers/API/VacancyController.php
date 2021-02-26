<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use App\Models\VacancyStatus;
use \Validator;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        if($request->route('id') == $request->user()->id) {
            $vacancies = $request->user()->vacancies;
            return response(['vacancy' => VacancyResource::collection($vacancies), 'message' => 'Retrieved successfully'], 200);
        }
        else
            return abort(404);
    }

    public function store(Request $request)
    {
        if($request->route('id') == $request->user()->id) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => ['required'],
                'position' => ['required'],
                'status' => ['in:CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
                'contacts' => ['required'],
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors(), 'Validation Error']);
            }

            $vacancy = new Vacancy();
            $vacancy->user_id = $request->user()->id;
            $vacancy->name = $request->name;
            $vacancy->position = $request->position;
            $vacancy->salary = $request->salary;
            $vacancy->link = $request->link;
            $vacancy->contacts = $request->contacts;
            $vacancy->status = VacancyStatus::statuses[$request->status];
            $vacancy->notes = $request->notes;
            $vacancy->save();

            return response(['vacancy' => new VacancyResource($vacancy), 'message' => 'Created successfully'], 200);
        }
        else
            return abort(404);

    }

    public function show(Request $request, $user_id, $vacancy_id)
    {
        if($user_id == $request->user()->id) {
            $vacancy = Vacancy::where(['id' => $vacancy_id, 'user_id' => $user_id])->first();
            return response(['vacancy' => new VacancyResource($vacancy), 'message' => 'Retrieved successfully'], 200);
        }
        else
            return abort(404);
    }

    public function update(Request $request, $user_id, $vacancy_id)
    {
        if($user_id == $request->user()->id) {
            $data = $request->all();

            $vacancy = Vacancy::where(['id' => $vacancy_id, 'user_id' => $user_id])->first();
            $validator = Validator::make($data, [
                'name' => ['required'],
                'position' => ['required'],
                'status' => ['in:CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
                'contacts' => ['required'],
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors(), 'Validation Error']);
            }

            $vacancy->user_id = $request->user()->id;
            $vacancy->name = $request->name;
            $vacancy->position = $request->position;
            $vacancy->salary = $request->salary;
            $vacancy->link = $request->link;
            $vacancy->contacts = $request->contacts;
            $vacancy->status = VacancyStatus::statuses[$request->status];
            $vacancy->notes = $request->notes;
            $vacancy->save();

            return response(['vacancy' => new VacancyResource($vacancy), 'message' => 'Updated successfully'], 200);
        }
        else
            return abort(404);
    }

    public function search(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        $validator = Validator::make($data, [
            'search' => ['required'],
            'status' => ['in:ALL,CONTACTED,GOT_TASK,WAITING_FOR_FEEDBACK,SCREENING,TECH_REVIEW,OFFER,REFUSED,NO_RESPONSE'],
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $vacancies = $user->vacancies;

        if(array_key_exists($request->status, VacancyStatus::statuses))
            $vacancies = $vacancies->toQuery()->where('status', VacancyStatus::statuses[$request->status])->get();

        if ($vacancies->count() > 0)
        {
            $vacancies = $vacancies->toQuery()->where('name', 'LIKE', "%{$request->search}%")->get();
            if($vacancies->count() > 0)
                return response(['vacancy' => new VacancyResource($vacancies), 'message' => 'Vacancies founded successfully'], 200);
            else
                return response(['error' => 'No vacancies', 404]);
        }
    }
}
