@extends('layouts.manager')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <form action="{{ route('manager.create-manager') }}" method="post">
        @csrf
        <div class="container">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên *</label>
                <input type="text" class="form-control" name="name"
                       placeholder="Tên của Quản Lý" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email *</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="Email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Password *</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                       placeholder="password">
            </div>

            <div class="form-group">
                <label>Vai trò </label>
                <select class="form-control select2" name="roles[]" multiple="multiple" data-placeholder="chọn vai trò" style="width: 100%;">
                    @foreach($roles as $role)
                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <button type="submit" class="btn btn-primary">Tạo</button>
                <a href="{{ route('manager.dashboard') }}" type="button" class="btn btn-secondary">Thoát</a>
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
            </div>s
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();
    </script>
@endpush
