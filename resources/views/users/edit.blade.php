@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h6 class="card-title">Edit User</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('users.update', $users->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $users->name }}">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" id="email" name="email" placeholder="Email" value="{{ $users->email }}" disabled>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <select class="form-control" id="role" name="role">
                                    <option 'selected'>GUEST</option>
                                    <option>ADMIN</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection