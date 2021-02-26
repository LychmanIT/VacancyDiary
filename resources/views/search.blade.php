@extends('master')

@section('content')

    @auth
        <div class="page-header">
            <h1>Search results <small>(<a href="{{ route('vacancies', Auth::user()->id) }}"> vacancies </a>)</small></h1>
        </div>

            <div class="list" >
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge">{{$vacancies->count()}}</span>
                        Vacancies founded
                    </li>
                </ul>
            </div>

        @if($vacancies->count() != 0)
            <div class="search">
                <form action="{{ route('search') }}" class="navbar-form navbar-left" role="search">
                    <div class="col-md-4">
                        <label class="col-md-4 control-label" for="service_status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="ALL" >All statuses</option>
                            <option value="CONTACTED" >Contacted</option>
                            <option value="GOT_TASK" >Got a test task</option>
                            <option value="WAITING_FOR_FEEDBACK" >Waiting for a feedback</option>
                            <option value="SCREENING" >Screening</option>
                            <option value="TECH_REVIEW" >Technical review</option>
                            <option value="OFFER" >Offer</option>
                            <option value="REFUSED" >Refused</option>
                            <option value="NO_RESPONSE" >No response</option>
                        </select>
                        <input type="text" name="search" class="form-control" placeholder="Search by name">
                        <button type="submit" class="btn btn-default">Search</button>
                    </div>
                </form>
            </div>

            <div class="table">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Link</th>
                        <th scope="col">Contacts</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last status update</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacancies as $vacancy)
                        <tr class="clickable-row" data-href="{{ route('vacancy-show', ['user_id' => Auth::user()->id, 'vacancy_id' => $vacancy->id]) }}">
                            <th scope="row">{{$vacancy->id}}</th>
                            <td>{{$vacancy->name}}</td>
                            <td>{{$vacancy->position}}</td>
                            <td>{{$vacancy->salary}}</td>
                            <td>{{$vacancy->link}}</td>
                            <td>{{$vacancy->contacts}}</td>
                            <td @if($vacancy->status == "Contacted") bgcolor="#DC7633" @endif
                            @if($vacancy->status == "Got a test task") bgcolor="#F4D03F" @endif
                                @if($vacancy->status == "Waiting for a feedback") bgcolor="#99A3A4" @endif
                                @if($vacancy->status == "Screening") bgcolor="#58D68D" @endif
                                @if($vacancy->status == "Technical review") bgcolor="#A569BD" @endif
                                @if($vacancy->status == "Offer") bgcolor="#1E8449" @endif
                                @if($vacancy->status == "Refused") bgcolor="#C0392B" @endif
                                @if($vacancy->status == "No response") bgcolor="#A04000" @endif >{{$vacancy->status}}</td>
                            <td>{{$vacancy->status_last_update}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endauth

@endsection
