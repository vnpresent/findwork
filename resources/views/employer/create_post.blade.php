<form action="" method="post">
    @csrf
    <label for="title">Tiêu đề</label>
    <input type="text" name="title" id="">

    <label for="content">Nội dung</label>
    <textarea name="description" id="" cols="30" rows="10"></textarea>

    <label for="number_of_applications">Số lượng tuyển </label>
    <input type="number" name="number_of_applications" id="">

    <label for="min_salary">Lương tối thiểu</label>
    <input type="number" name="min_salary" id="">

    <label for="max_salary">Lương tối đa</label>
    <input type="number" name="max_salary" id="">

    <label for="start_date">Ngày bắt đầu tuyển</label>
    <input type="date" name="start_date" id="">

    <label for="end_date">Ngày kết thúc tuyển</label>
    <input type="date" name="end_date" id="">

    <button type="submit">Xác nhận tạo</button>
</form>
