@extends('layouts.applicant')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link
        rel="stylesheet"
        href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <style>
        /*.list-group {*/
        /*    max-height: 300px;*/
        /*    !*overflow: scroll;*!*/
        /*    -webkit-overflow-scrolling: touch;*/
        /*}*/
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="col-10 mx-auto" style="background: #fafafa">
            <section class="profile mt-5">
                <div class="col-3 mx-auto">
                    <input class="form-control-plaintext text-center" disabled type="text" name="name"
                           value="{{ $cv['name'] }}"
                           placeholder="Tên CV">
                </div>
            </section>

            <div class="form-group col-4 mx-auto">
                <input class="form-control-plaintext text-center" disabled name="position" type="text"
                       value="{{ $cv['position'] }}"
                       placeholder="Vị trí công việc">
            </div>
            <div class="row">
                <div class="col-6 ">
                    <section class="work_experience">
                        <h3>
                            Kinh nghiệm làm việc
                        </h3>
                        @foreach((array)$cv['work_experience'] as $work_experience)
                            <div class="input-item border border-light pl-2">
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-2" type="text"
                                           name="work_experience[0][position]" disabled
                                           value="" placeholder="Vị trí">
                                    <input class="form-control-plaintext col-2" type="text"
                                           name="work_experience[0][from]"
                                           disabled
                                           value="{{ $work_experience['from'] }}" placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-2" type="text"
                                           name="work_experience[0][end]"
                                           disabled
                                           value="{{ $work_experience['end'] }}" placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text"
                                           name="work_experience[0][name]"
                                           disabled
                                           value="{{ $work_experience['name'] }}" placeholder="Tên công ty">
                                </div>
                                <div class="form-group row">
                                <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                          name="work_experience[0][description]" id="" disabled
                                          placeholder="Mô tả chi tiết công việc">{{ $work_experience['description'] }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </section>

                    <section class="education">
                        <h3>
                            <div>Học vấn
                            </div>
                        </h3>
                        @foreach((array)$cv['education'] as $education)
                            <div class="input-item border border-light pl-2">
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-2" type="text" name="education[0][major]"
                                           disabled
                                           value="{{ $education['major'] }}"
                                           placeholder="Ngành">
                                    <input class="form-control-plaintext col-2" type="text" name="education[0][from]"
                                           disabled
                                           value="{{ $education['from'] }}"
                                           placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-2" type="text" name="education[0][end]"
                                           disabled
                                           value={{ $education['end'] }}""
                                           placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text" name="education[0][school]"
                                           disabled
                                           value="{{ $education['school'] }}"
                                           placeholder="Trường">
                                </div>
                                <div class="form-group row">
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                      name="education[0][description]" id="" disabled
                                      placeholder="Mô tả">{{ $education['description'] }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </section>

                    <section class="activities">
                        <h3>
                            <div>Hoạt động
                            </div>
                        </h3>
                        @foreach((array)$cv['activities'] as $activitie)
                            <div class="input-item border border-light pl-2">
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-2" type="text"
                                           name="activities[0][position]"
                                           disabled
                                           value="{{ $activitie['position'] }}" placeholder="Vị trí">
                                    <input class="form-control-plaintext col-2" type="text" name="activities[0][from]"
                                           disabled
                                           value="{{ $activitie['from'] }}"
                                           placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-2" type="text" name="activities[0][end]"
                                           disabled
                                           value="{{ $activitie['end'] }}"
                                           placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text" name="activities[0][name]"
                                           disabled
                                           value="{{ $activitie['name'] }}"
                                           placeholder="Tên tổ chức">
                                </div>
                                <div class="form-group row">
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                      name="activities[0][description]" id="" disabled
                                      placeholder="Mô tả chi tiết hoạt động">{{ $activitie['description'] }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </section>

                    <section class="certifications">
                        <h3>
                            <div>Chứng chỉ
                            </div>
                        </h3>
                        @foreach((array)$cv['certifications'] as $certification)
                            <div class="input-item border border-light pl-2">
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-2" type="text"
                                           name="certifications[0][time]"
                                           disabled
                                           value="{{ $certification['time'] }}" placeholder="Thời gian">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text"
                                           name="certifications[0][name]"
                                           disabled
                                           value="{{ $certification['name'] }}"
                                           placeholder="Tên chứng chỉ">
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
                <div class="col-6">
                    <section class="profile">
                        <h3>
                            <div>Thông tin cá nhân
                            </div>
                        </h3>
                        <div class="input-item border border-light pl-2">
                            <div class="input-group col-5">
                                <div class="input-group-prepend mr-2">
                                    <span class="form-control-plaintext"><i class="fa fa-user"></i></span>
                                </div>
                                <input class="form-control-plaintext" name="profile[name]" type="text" disabled
                                       value="{{ $cv['profile']['name'] }}" placeholder="Tên">
                            </div>
                            <div class="input-group col-5">
                                <div class="input-group-prepend mr-2">
                                    <span class="form-control-plaintext"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" class="form-control-plaintext" name="profile[birthday]" disabled
                                       value="{{ $cv['profile']['birthday'] }}">
                            </div>

                            <div class="input-group col-5">
                                <div class="input-group-prepend mr-2">
                                    <span class="form-control-plaintext"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control-plaintext" value="{{ $cv['profile']['phone'] }}"
                                       disabled
                                       placeholder="Số điện thoại"
                                       name="profile[phone]">
                            </div>

                            <div class="input-group col-5">
                                <div class="input-group-prepend mr-2">
                                    <span class="form-control-plaintext"><i class="fa fa-mail-bulk"></i></span>
                                </div>
                                <input type="text" class="form-control-plaintext" value="{{ $cv['profile']['email'] }}"
                                       disabled
                                       placeholder="Email"
                                       name="profile[email]">
                            </div>

                            <div class="input-group col-5">
                                <div class="input-group-prepend mr-2">
                                    <span class="form-control-plaintext"><i class="fa fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" class="form-control-plaintext"
                                       value="{{ $cv['profile']['address'] }}"
                                       disabled
                                       placeholder="Địa chỉ"
                                       name="profile[address]">
                            </div>
                        </div>
                    </section>

                    <section class="objective">
                        <h3>
                            <div>Mục tiêu nghề nghiệp
                            </div>
                        </h3>
                        <div class="input-item border border-light form-group col-7">
                        <textarea class="textarea-autosize form-control-plaintext" name="objective" id="" rows="3"
                                  disabled
                                  placeholder="Mục tiêu nghề nghiệp của bản thân là gì">{{ $cv['objective'] }}</textarea>
                        </div>
                    </section>

                    <section class="skills">
                        <h3>
                            <div>Các kỹ năng
                            </div>
                        </h3>
                        @foreach((array)$cv['skills'] as $skill)
                            <div class="input-item border border-light skill col-6 p-0 m-0 pl-2">
                                <div class="input-group col-12 skill-input mt-0">
                                    <input type="text" class="form-control-plaintext font-weight-bold"
                                           value="{{ $skill['name'] }}" disabled
                                           name="skills[0][name]"
                                           placeholder="Kỹ năng">
                                    <ul class="col-12 list-group position-absolute justify-content-center"
                                        id="search_value" style="top: 100%;z-index: 1;">
                                    </ul>
                                </div>
                                <div class="form-group col-12">
                                <textarea class="textarea-autosize form-control-plaintext" name="skills[0][description]"
                                          disabled
                                          rows="1" id=""
                                          placeholder="Mô tả kỹ năng">{{ $skill['description'] }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>$('.textarea-autosize').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });</script>
@endpush
