@extends('master')

@section('content')

    <div class="page-header">
        <h1>Vacancy<small>(<a href="{{ route('vacancies', Auth::user()->id) }}"> vacancies </a>)</small></h1>
    </div>

    <ul class="list-group">
        <li class="list-group-item">
           <span class="badge">{{$vacancy->id}}</span>
            id
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->name}}</span>
            name
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->user_id}}</span>
            user_id
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->position}}</span>
            position
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->salary}}</span>
            salary
        </li>
        <li class="list-group-item">
            <span class="badge"><a href="{{$vacancy->link}}">{{$vacancy->link}}</a></span>
            link
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->contacts}}</span>
            contacts
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->status}}</span>
            status
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->status_last_update}}</span>
            status last update
        </li>
        <li class="list-group-item">
            <span class="badge">{{$vacancy->notes}}</span>
            notes
        </li>
    <ul>

    <form action="{{ route('vacancy-edit', ['user_id' => Auth::user()->id, 'vacancy_id' => $vacancy->id]) }}">
        <button type="submit" class="btn btn-primary" name="Edit">Edit</button>
    </form>

    <form action="{{ route('vacancy-mail', ['user_id' => Auth::user()->id, 'vacancy_id' => $vacancy->id]) }}">
        <button type="submit" class="btn btn-primary" @if(!$vacancy->mailable()) disabled @endif name="SendMail" >Message to ask about your candidacy</button>
    </form>


@endsection
