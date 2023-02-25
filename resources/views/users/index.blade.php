@extends('layouts.dashboard')


@section('content')
@include('layouts.msg')

<div>
    @if (request()->routeIs('users.index'))
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create</a>
    @endif
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Password</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    @php
        $no = 0;
    @endphp
    @forelse ($users as $user)
        <tr>
            <th scope="row">{{ ++ $no }}</th>
            <td>{{ Str::limit($user->name, 50) }}</td>
            <td>{{ $user->email}}</td>
            <td>{{ $user->role}}</td>
            <td>{{ $user->password}}</td>
            <td>
                @if (request()->routeIs('users.index'))
                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                @else
                    <form method="post" action="{{ route('users.restore', $user->id) }}" >
                        @csrf
                        <Button type="submit" class="btn btn-success">Restore</Button>
                    </form>
                @endif
                <form id="delete-form-{{ $user->id }}" method="post" action="{{ request()->routeIs('users.index') ? route('users.destroy', $user->id) : route('users.delete', $user->id) }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <Button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? you want to delete this?')){
                        event.preventDefault(); document.getElementById('delete-form-{{$user->id}}').submit();
                        }else { event.preventDefault(); }"><i class="material-icons">delete</i></Button>
            </td>
        </tr>    
    @empty
        <tr>
            <td colspan="5" class="text-center">
                <div class="alert alert-danger" role="alert">
                    No users found!
                </div>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script>
@endpush