<form action="{{ route('employer.create-post') }}" method="post">
    @csrf
    <label for="title">Tiêu đề</label>
    <input type="text" name="title" id="" value="{{ old('title') }}">

    <label for="content">Nội dung</label>
    <textarea name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>

    <label for="number_applicants" >Số lượng tuyển </label>
    <input type="number" name="number_applicants" id="" value="{{ old('number_applicants') }}">

    <label for="min_salary">Lương tối thiểu</label>
    <input type="number" name="min_salary" id=""  value="{{ old('min_salary') }}">

    <label for="max_salary">Lương tối đa</label>
    <input type="number" name="max_salary" id="" value="{{ old('max_salary') }}">

    <label for="start_date">Ngày bắt đầu tuyển</label>
    <input type="date" name="start_date" id="" value="{{ old('start_date') }}">

    <label for="end_date">Ngày kết thúc tuyển</label>
    <input type="date" name="end_date" id="" value="{{ old('end_date') }}">

    <button type="submit">Xác nhận tạo</button>


    @if(session('error'))
        {{ session('error') }}}
    @endif
    @if(session('success'))
        {{ session('success') }}}
    @endif
</form>
