@extends('master')

@section('content')

        <div class="page-header">
            <h1>Users activity <small>(<a href="{{ url('/') }}"> home </a>)</small></h1>
        </div>
        @if($users->count() != 0)
            <div class="list" >
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge">{{$users->count()}}</span>
                        Users count
                    </li>
                </ul>
            </div>

            <div class="form-group">
            </div>

            <div class="table">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Vacancies</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->vacancies->count()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

@endsection
