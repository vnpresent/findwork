@extends('layouts.employer')
@push('title')
    Cập nhật bài đăng
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <form action="{{ route('employer.update-post',['id'=>$post['id']]) }}" method="post">
        @csrf
        <div class="container">
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
            <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề *</label>
                <input type="text" class="form-control" name="title"
                       placeholder="Tiêu đề bài đăng,ví dụ:Lập trình viên Php" value="{{ $post['title'] }}">
            </div>

            <div class="form-group">
                <label>Ngành nghề *</label>
                <select class="form-control select2" name="work">
                    <option>chọn ngành nghề</option>
                    @foreach($works as $work)
                        <option value="{{ $work['id'] }}" {{ $work['id']==$post['work_id']?'selected':'' }}>{{ $work['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Cấp bậc *</label>
                <select class="form-control" name="level">
                    <option>chọn cấp bậc</option>
                    @foreach($levels as $level)
                        <option value="{{ $level['id'] }}" {{ $level['id']==$post['level_id']?'selected':'' }}>{{ $level['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kinh nghiệm yêu cầu *</label>
                <select class="form-control" name="experience">
                    @foreach($experiences as $experience)
                        <option value="{{ $experience['id'] }}" {{ $experience['id']==$post['experience_id']?'selected':'' }}>{{ $experience['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kĩ năng yêu cầu</label>
                <select class="form-control select2-tag" name="skills[]" multiple>
                    @foreach($skills as $skill)
                        <option @if( in_array($skill['id'], array_column($post['skills'],'id')) ) selected @endif value="{{ $skill['name'] }}">{{ $skill['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Bằng cấp yêu cầu *</label>
                <select class="form-control" name="degree">
                    @foreach($degrees as $degree)
                        <option value="{{ $degree['id'] }}" {{ $degree['id']==$post['degree_id']?'selected':'' }}>{{ $degree['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Hình thức làm việc *</label>
                <select class="form-control" name="workingForm">
                    <option>Chọn hình thức làm việc</option>
                    @foreach($working_forms as $working_form)
                        <option value="{{ $working_form['id'] }}" {{ $working_form['id']==$post['working_form_id']?'selected':'' }}>{{ $working_form['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Giới tính *</label>
                <select class="form-control" name="sex">
                    <option value="0" {{ 0==$post['sex']?'selected':'' }}>Không yêu cầu</option>
                    <option value="1" {{ 1==$post['sex']?'selected':'' }}>Nam</option>
                    <option value="2" {{ 2==$post['sex']?'selected':'' }}>Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tỉnh/Thành phố *</label>
                <select class="form-control" name="city">
                    <option>Chọn tỉnh/thành phố</option>
                    @foreach($cities as $citie)
                        <option value="{{ $citie['id'] }}" {{ $citie['id']==$post['city_id']?'selected':'' }}>{{ $citie['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ cụ thể *</label>
                <input type="text" class="form-control" name="address" placeholder="Ví dụ:175, Tây Sơn,Đống Đa"  value="{{ $post['address'] }}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mức lương *</label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Từ *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" name="minSalary" value="{{ $post['min_salary'] }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Đến *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" name="maxSalary" value="{{ $post['max_salary'] }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số lượng tuyển dụng *</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="numberApplicants" value="{{ $post['number_applicants'] }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả,yêu cầu công việc *</label>
                <textarea class="form-control" rows="5" name="description"
                          placeholder="Mô tả yêu cầu công việc,thông tin oông việc">{{ $post['description'] }}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Quyền lợi *</label>
                <textarea class="form-control" rows="5" name="benefit"
                          placeholder="Quyền lợi khi được nhận vào làm">{{ $post['benefit'] }}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Hạn nộp *</label>
                <input type="date" class="form-control" name="endDate" placeholder="" value="{{ $post['end_date'] }}">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('employer.show-my-posts-form') }}" type="button" class="btn btn-secondary">Thoát</a>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();
        $('.select2-tag').select2({
            tags: true
        });
    </script>
@endpush
