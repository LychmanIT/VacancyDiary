@extends('master')

@section('content')

    <div class="page-header">
        <h1>Create vacancy<small>(<a href="{{ route('vacancies', Auth::user()->id) }}"> vacancies </a>)</small></h1>
    </div>

    @if (\Session::has('error'))
        <div class="alert alert-danger" role="alert">Inputed data isn`t correct.</div>
    @endif

    @if (\Session::has('success'))
    <div class="alert alert-success" role="alert">
        Vacancy was successfully added. Watch the
        <a href="/" class="alert-link">full list</a> of vacancies.
    </div>
    @endif

    <div class="search">
        <form action="{{ route('vacancy-store', Auth::user()->id) }}" class="navbar-form navbar-left" method="POST">
            @csrf
            <div class="col-md-4">
                <select id="status" name="status" class="form-control">
                    <option value="CONTACTED" >Contacted</option>
                    <option value="GOT_TASK" >Got a test task</option>
                    <option value="WAITING_FOR_FEEDBACK" >Waiting for a feedback</option>
                    <option value="SCREENING" >Screening</option>
                    <option value="TECH_REVIEW" >Technical review</option>
                    <option value="OFFER" >Offer</option>
                    <option value="REFUSED" >Refused</option>
                    <option value="NO_RESPONSE" >No response</option>
                </select>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    <input type="text" name="position" class="form-control" placeholder="Position" required>
                    <input type="text" name="salary" class="form-control" placeholder="Salary">
                    <input type="text" name="link" class="form-control" placeholder="Link">
                    <input type="text" name="contacts" class="form-control" placeholder="Contacts">
                    <input type="text" name="notes" class="form-control" placeholder="Additional notes">
                </div>
                <button type="submit" name="Create" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>

@endsection
