@extends('layouts.employer')
@push('title')
    Thêm mới bài đăng
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

@endpush
@section('content')
    <form action="{{ route('employer.create-post') }}" method="post">
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
                       placeholder="Tiêu đề bài đăng,ví dụ:Lập trình viên Php">
            </div>

            <div class="form-group">
                <label>Ngành nghề *</label>
                <select class="form-control select2" name="work">
                    <option>chọn ngành nghề</option>
                    @foreach($works as $work)
                        <option value="{{ $work['id'] }}">{{ $work['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Cấp bậc *</label>
                <select class="form-control" name="level">
                    <option>chọn cấp bậc</option>
                    @foreach($levels as $level)
                        <option value="{{ $level['id'] }}">{{ $level['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kinh nghiệm yêu cầu *</label>
                <select class="form-control" name="experience">
                    @foreach($experiences as $experience)
                        <option value="{{ $experience['id'] }}">{{ $experience['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kĩ năng yêu cầu</label>
                <select class="form-control select2-tag" name="skills[]" multiple>
                    @foreach($skills as $skill)
                        <option value="{{ $skill['name'] }}">{{ $skill['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Bằng cấp yêu cầu *</label>
                <select class="form-control" name="degree">
                    @foreach($degrees as $degree)
                        <option value="{{ $degree['id'] }}">{{ $degree['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Hình thức làm việc *</label>
                <select class="form-control" name="workingForm">
                    <option>Chọn hình thức làm việc</option>
                    @foreach($workingForms as $workingForm)
                        <option value="{{ $workingForm['id'] }}">{{ $workingForm['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Giới tính *</label>
                <select class="form-control" name="sex">
                    <option value="0">Không yêu cầu</option>
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tỉnh/Thành phố *</label>
                <select class="form-control" name="city">
                    <option>Chọn tỉnh/thành phố</option>
                    @foreach($cities as $citie)
                        <option value="{{ $citie['id'] }}">{{ $citie['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ cụ thể *</label>
                <input type="text" class="form-control" name="address" placeholder="Ví dụ:175, Tây Sơn,Đống Đa">
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
                                <input type="number" class="form-control" name="minSalary">
                                <div class="input-group-append">
                                    <span class="input-group-text">tr</span>
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
                                <input type="number" class="form-control" name="maxSalary">
                                <div class="input-group-append">
                                    <span class="input-group-text">tr</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số lượng tuyển dụng *</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="numberApplicants">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả,yêu cầu công việc *</label>
                <textarea class="form-control" rows="5" name="description"
                          placeholder="Mô tả yêu cầu công việc,thông tin oông việc"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Quyền lợi *</label>
                <textarea class="form-control" rows="5" name="benefit"
                          placeholder="Quyền lợi khi được nhận vào làm"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Hạn nộp *</label>
                <input type="date" class="form-control" name="endDate" placeholder="">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Tạo</button>
                <a href="{{ route('employer.dashboard') }}" type="button" class="btn btn-secondary">Thoát</a>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            placeholder: "Chọn",
            allowClear: false
        });
        $('.select2-tag').select2({
            tags: true
        });
    </script>
@endpush
