@extends('admin.master')
@section('content')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"style="margin-left:360px">
        Create User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                          <label for="name" class="col-md-4">Name</label>
                          <div class="col-md-8">
                              <input type="text" name="name" class="form-control">
                          </div>
                      </div>
                      <div class="row mt-3">
                          <label for="name" class="col-md-4">Email</label>
                          <div class="col-md-8">
                              <input type="email" name="email" class="form-control">
                          </div>
                      </div>
                      <div class="row mt-3">
                          <label for="name" class="col-md-4">Password</label>
                          <div class="col-md-8">
                              <input type="password" name="password" class="form-control">
                          </div>
                      </div>
                      <div class="row mt-3">
                          <label for="user_type" class="col-md-4">User Type</label>
                          <div class="col-md-8">
                             <select name="user_type" class="form-control">
                                 <option selected disabled><--Select User--></option>
                                @if(Auth()->user()->user_type == 0)
                                     <option value="1">Merchant</option>
                                @endif

                                 @if(Auth()->user()->user_type == 1)
                                     <option value="2">Officer</option>
                                     <option value="3">user</option>
                                 @endif
                                 @if(Auth()->user()->user_type == 2)
                                     <option value="3">user</option>
                                 @endif


                             </select>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--//Show data table--}}
    <table class="table mt-3">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->user_type == 0)
                    {{ 'Admin' }}
                @endif

                @if($user->user_type == 1)
                    {{ 'Merchant' }}
                @endif

                @if($user->user_type == 2)
                    {{ 'Officer' }}
                @endif

                @if($user->user_type == 3)
                    {{ 'User' }}
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
