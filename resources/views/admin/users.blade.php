@extends('layouts.main_app')

@section('pageTitle')
{{ __('dashboard.users') }}
@endsection

@section('content')
<div class="container">
    <a href="{{route('admin.register')}}" class="btn btn-orange my-2">{{__('dashboard.add_admin')}}</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark text-grey">
                <tr>
                    <th>#</th>
                    <th>{{__('dashboard.name')}}</th>
                    <th>{{__('dashboard.username')}}</th>
                    <th>{{__('dashboard.email')}}</th>
                    <th>{{__('dashboard.joined_date')}}</th>
                    <th>{{__('dashboard.ban')}}</th>
                    <th>{{__('dashboard.role')}}</th>
                    <th>{{__('dashboard.actions')}}</th>
                </tr>
            </thead>
            <tbody class="text-grey">
                @foreach($users as $user)
                
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <form action="{{ route('admin.updateBanUser', $user->id) }}" method="POST" onsubmit="return confirm('{{__('dashboard.confirm_message_ban')}}');">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-{{$user->is_ban == 'no' ? 'success' : 'danger'}} btn-sm w-100" type="submit">{{$user->is_ban == 'yes' ? __('dashboard.yes') : __('dashboard.no')}}</button>
                        </form>
                    </td>
                    <td>
                        <!-- نموذج لتحديث الصلاحية -->
                        <form action="{{ route('admin.updateUserRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="input-group">
                                <select name="role" class="form-control form-control-sm border-0 bg-info bg-opacity-10" onchange="this.form.submit();">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('dashboard.role_user') }}</option>
                                    <option value="supervisor" {{ $user->role === 'supervisor' ? 'selected' : '' }}>{{ __('dashboard.role_supervisor') }}</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('dashboard.role_admin') }}</option>
                                </select>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('{{__('dashboard.confirm_message_delete')}}');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" type="submit">{{__('dashboard.delete')}}</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- روابط التقسيم -->
        <div class="d-flex justify-content-center mt-4" style="direction: ltr;">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('java_scripts')
    @auth
    <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
    @endauth
@endsection