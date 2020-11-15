@extends('layouts.dashboards', ['menu' => 'users'])


@section('content')
    
    @if(session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif
                
    <div class="card">
        <div class="card-body" style="padding: 5%;">
            <div class="row">
                
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>Instagram</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->birthday }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->instagram_id }}</td>
                                    <td>{{ $user->sign_date }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm btn-flat">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="" onclick="event.preventDefault();
                                             document.getElementById('delete-form-{{$user->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        <form id="delete-form-{{$user->id}}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                              <input type="hidden" name="_method" value="delete">
                                              @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop