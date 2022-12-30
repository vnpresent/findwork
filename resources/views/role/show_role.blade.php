@extends('layouts.manager')
@section('content')
    <form>
        <div class="container">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Vai trò*</label>
                <input type="text" class="form-control" name="name" readonly
                       placeholder="Tên vai trò" value="{{ old('name')?old('name'):$role['name'] }}">
            </div>

            @foreach($permissions as $permission)
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ $permission['name'] }}</label>
                    <div class="mb-3">
                        @foreach($permission['childs'] as $child)
                            @if(in_array($child['id'],$role['permissions']))
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="permissions[]" disabled
                                       value="{{ $child['id'] }}" {{ in_array($child['id'],$role['permissions'])?'checked':'' }}>
                                <label class="form-check-label font-weight-bold" for="inlineCheckbox1">{{ $child['name'] }}</label>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div>
                <a href="{{ route('manager.show-all-roles-form') }}" type="button" class="btn btn-secondary">Thoát</a>
            </div>
            <div class="form-group mt-5">
                @if(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
