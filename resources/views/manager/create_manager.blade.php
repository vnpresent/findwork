<form action="{{ route('manager.create-manager') }}" method="post">
    @csrf
    <input type="text" name="name" id="" value="{{ old('name') }}">
    <input type="text" name="email" id="" value="{{ old('email') }}">
    <input type="text" name="password" id="" value="{{ old('password') }}">
    <button type="submit">Thêm tài khoản quản lý</button>
    {{ (session('error')?:'') }}
    {{ (session('success')?:'') }}
</form>
