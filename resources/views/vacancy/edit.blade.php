@extends('master')

@section('content')

    <div class="page-header">
        <h1>Edit vacancy<small>(<a href="{{ route('vacancies', Auth::user()->id) }}"> vacancies </a>)</small></h1>
    </div>

    @if (\Session::has('error'))
        <div class="alert alert-danger" role="alert">Inputed data isn`t correct.</div>
    @endif

    @if (\Session::has('success'))
        <div class="alert alert-success" role="alert">
            Vacancy was successfully updated. Watch the
            <a href="/" class="alert-link">full list</a> of vacancies.
        </div>
    @endif

    <div class="search">
        <form action="{{ route('vacancy-update', ['user_id' => Auth::user()->id, 'vacancy_id' => $vacancy->id]) }}" class="navbar-form navbar-left" method="POST">
        @csrf
            <div class="col-md-4">
                <select id="status" name="status" class="form-control">
                    <option value="CONTACTED" @if($vacancy->status == "Contacted") selected @endif>Contacted</option>
                    <option value="GOT_TASK" @if($vacancy->status == "Got a test task") selected @endif>Got a test task</option>
                    <option value="WAITING_FOR_FEEDBACK" @if($vacancy->status == "Waiting for a feedback") selected @endif>Waiting for a feedback</option>
                    <option value="SCREENING" @if($vacancy->status == "Screening") selected @endif>Screening</option>
                    <option value="TECH_REVIEW" @if($vacancy->status == "Technical review") selected @endif>Technical review</option>
                    <option value="OFFER" @if($vacancy->status == "Offer") selected @endif>Offer</option>
                    <option value="REFUSED" @if($vacancy->status == "Refused") selected @endif>Refused</option>
                    <option value="NO_RESPONSE" @if($vacancy->status == "No response") selected @endif>No response</option>
                </select>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$vacancy->name}}" required>
                    <input type="text" name="position" class="form-control" placeholder="Position" value="{{$vacancy->position}}"  required>
                    <input type="text" name="salary" class="form-control" placeholder="Salary" value="{{$vacancy->salary}}" >
                    <input type="text" name="link" class="form-control" placeholder="Link" value="{{$vacancy->link}}" >
                    <input type="text" name="contacts" class="form-control" placeholder="Contacts" value="{{$vacancy->contacts}}" required>
                    <input type="text" name="notes" class="form-control" placeholder="Additional notes" value="{{$vacancy->notes}}" >
               </div>
                <button type="submit" name="Save" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>

@endsection
