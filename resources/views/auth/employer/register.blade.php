<form action="{{ route('employer.register') }}" method="post">
    @csrf
    <label for="name">Tên công ty</label>
    <input type="text" name="name" id="">
    <input type="email" name="email" id="">
    <input type="password" name="password" id="">
    <button type="submit">Đăng ký</button>
    {{ session('error')?session('error'):'' }}
    {{ session('success')?session('success'):'' }}
</form>
