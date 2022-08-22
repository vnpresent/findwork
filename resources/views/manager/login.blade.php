<form action="{{ route('manager.login') }}" method="post">

    @csrf

    <input type="email" name="email" id="">

    <input type="password" name="password" id="">

    <button type="submit">Đăng nhập</button>
    {{ session('error')?session('error'):'' }}}
</form>
