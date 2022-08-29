<form action="" method="post">
    @csrf
    <input type="text" name="name" id="">
    <input type="email" name="email" id="">
    <input type="password" name="password" id="">
    <button type="submit">Đăng ký</button>


    {{ session('error')?session('error'):'' }}
    {{ session('success')?session('success'):'' }}
</form>
