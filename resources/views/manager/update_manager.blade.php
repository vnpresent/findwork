<form action="{{ route('manager.create-manager') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $manager['id'] }}">
    <input type="text" name="name" id="" value="{{ $manager['name'] }}">
    <input type="text" name="email" id="" value="{{ $manager['email'] }}">
    <button type="submit">Cập nhật khoản quản lý</button>
    {{ (session('error')?:'') }}
    {{ (session('success')?:'') }}
</form>
