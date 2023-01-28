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
    <form action="{{ route('applicant.create-cv') }}" method="post">
        @csrf
        <div class="container">
            <div class="col-10 mx-auto" style="background: #fafafa">
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
                <section class="profile mt-5">
                    <div class="col-3 mx-auto">
                        <input class="form-control-plaintext text-center" type="text" name="name" value="Untitled CV"
                               placeholder="Tên CV">
                    </div>
                </section>

                <div class="form-group col-4 mx-auto">
                    <input class="form-control-plaintext text-center" name="position" type="text"
                           value="Lập trình viên php"
                           placeholder="Vị trí công việc">
                </div>

                <div class="row">
                    <div class="col-6 pl-5">
                        <section class="work_experience">
                            <h3>
                                <div class="font-weight-bold">Kinh nghiệm làm việc
                                </div>
                            </h3>

                            <div class="input-item border border-light pl-2">
                                <div class="type-icon position-absolute justify-content-center ml-5 d-none"
                                     style="z-index: 1;">
                                    <i class="add-work_experience fa fa-plus-circle">Thêm</i>
                                    <i class="delete fa fa-trash">Xóa</i>
                                </div>
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-3" type="text"
                                           name="work_experience[0][position]"
                                           value="" placeholder="Vị trí">
                                    <input class="form-control-plaintext col-3" type="text"
                                           name="work_experience[0][from]"
                                           value="" placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-3" type="text"
                                           name="work_experience[0][end]"
                                           value="" placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text"
                                           name="work_experience[0][name]"
                                           value="" placeholder="Tên công ty">
                                </div>
                                <div class="form-group row">
                                <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                          name="work_experience[0][description]" id=""
                                          placeholder="Mô tả chi tiết công việc"></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="education">
                            <h3>
                                <div class="font-weight-bold">Học vấn
                                </div>
                            </h3>
                            <div class="input-item border border-light pl-2">
                                <div class="type-icon position-absolute justify-content-center ml-5 d-none"
                                     style="z-index: 1;">
                                    <i class="add-education fa fa-plus-circle">Thêm</i>
                                    <i class="delete fa fa-trash">Xóa</i>
                                </div>
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-3" type="text" name="education[0][major]"
                                           value=""
                                           placeholder="Ngành">
                                    <input class="form-control-plaintext col-3" type="text" name="education[0][from]"
                                           value=""
                                           placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-3" type="text" name="education[0][end]"
                                           value=""
                                           placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text" name="education[0][school]"
                                           value=""
                                           placeholder="Trường">
                                </div>
                                <div class="form-group row">
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                      name="education[0][description]" id=""
                                      placeholder="Mô tả"></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="activities">
                            <h3>
                                <div class="font-weight-bold">Hoạt động
                                </div>
                            </h3>
                            <div class="input-item border border-light pl-2">
                                <div class="type-icon position-absolute justify-content-center ml-5 d-none"
                                     style="z-index: 1;">
                                    <i class="add-activities fa fa-plus-circle">Thêm</i>
                                    <i class="delete fa fa-trash">Xóa</i>
                                </div>
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-3" type="text"
                                           name="activities[0][position]"
                                           value="" placeholder="Vị trí">
                                    <input class="form-control-plaintext col-3" type="text" name="activities[0][from]"
                                           value=""
                                           placeholder="Bắt đầu">
                                    <input class="form-control-plaintext col-3" type="text" name="activities[0][end]"
                                           value=""
                                           placeholder="Kết thúc">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text" name="activities[0][name]"
                                           value=""
                                           placeholder="Tên tổ chức">
                                </div>
                                <div class="form-group row">
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"
                                      name="activities[0][description]" id=""
                                      placeholder="Mô tả chi tiết hoạt động"></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="certifications">
                            <h3>
                                <div class="font-weight-bold">Chứng chỉ
                                </div>
                            </h3>
                            <div class="input-item border border-light pl-2">
                                <div class="type-icon position-absolute justify-content-center ml-5 d-none"
                                     style="z-index: 1;">
                                    <i class="add-certifications fa fa-plus-circle">Thêm</i>
                                    <i class="delete fa fa-trash">Xóa</i>
                                </div>
                                <div class="form-group row mt-3">
                                    <input class="form-control-plaintext col-3" type="text"
                                           name="certifications[0][time]"
                                           value="" placeholder="Thời gian">
                                </div>
                                <div class="form-group row">
                                    <input class="form-control-plaintext col-5" type="text"
                                           name="certifications[0][name]"
                                           value=""
                                           placeholder="Tên chứng chỉ">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-6 pl-5">
                        <section class="profile">
                            <h3>
                                <div class="font-weight-bold">Thông tin cá nhân
                                </div>
                            </h3>
                            <div class="input-item border border-light pl-2">
                                <div class="input-group col-7">
                                    <div class="input-group-prepend mr-2">
                                        <span class="form-control-plaintext"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control-plaintext" name="profile[name]" type="text"
                                           value="{{ auth('applicant')->user()->name }}" placeholder="Tên">
                                </div>
                                <div class="input-group col-7">
                                    <div class="input-group-prepend mr-2">
                                        <span class="form-control-plaintext"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control-plaintext" name="profile[birthday]"
                                           value="{{ auth('applicant')->user()->birthday }}">
                                </div>

                                <div class="input-group col-7">
                                    <div class="input-group-prepend mr-2">
                                        <span class="form-control-plaintext"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control-plaintext" value="{{ auth('applicant')->user()->phone }}"
                                           placeholder="Số điện thoại"
                                           name="profile[phone]">
                                </div>

                                <div class="input-group col-7">
                                    <div class="input-group-prepend mr-2">
                                        <span class="form-control-plaintext"><i class="fa fa-mail-bulk"></i></span>
                                    </div>
                                    <input type="text" class="form-control-plaintext" value="{{ auth('applicant')->user()->Email }}"
                                           placeholder="Email"
                                           name="profile[email]">
                                </div>

                                <div class="input-group col-7">
                                    <div class="input-group-prepend mr-2">
                                        <span class="form-control-plaintext"><i class="fa fa-map-marked-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control-plaintext" value="{{ auth('applicant')->user()->address }}"
                                           placeholder="Địa chỉ"
                                           name="profile[address]">
                                </div>
                            </div>
                        </section>

                        <section class="objective">
                            <h3>
                                <div class="font-weight-bold">Mục tiêu nghề nghiệp
                                </div>
                            </h3>
                            <div class="input-item border border-light form-group col-7">
                        <textarea class="textarea-autosize form-control-plaintext" name="objective" id="" rows="3"
                                  placeholder="Mục tiêu nghề nghiệp của bản thân là gì"></textarea>
                            </div>
                        </section>

                        <section class="skills icon-add">
                            <h3>
                                <div class="font-weight-bold">Kỹ năng
                                </div>
                            </h3>
                            <div class="input-item border border-light skill col-8 pb-2 mt-2 pl-2">
                                <div class="type-icon position-absolute justify-content-center ml-5 d-none"
                                     style="z-index: 1;">
                                    <i class="add-skill fa fa-plus-circle">Thêm</i>
                                    <i class="delete fa fa-trash">Xóa</i>
                                </div>
                                <div class="input-group col-12 skill-input mt-3">
                                    <input type="text" class="form-control-plaintext font-weight-bold" value=""
                                           name="skills[0][name]"
                                           placeholder="Kỹ năng">
                                    <ul class="col-12 list-group position-absolute justify-content-center"
                                        id="search_value" style="top: 100%;z-index: 1;">
                                    </ul>
                                </div>
                                <div class="form-group col-12">
                                <textarea class="textarea-autosize form-control-plaintext" name="skills[0][description]"
                                          rows="1" id=""
                                          placeholder="Mô tả kỹ năng"></textarea>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="form-group col-4 mx-auto text-center">
                    <button type="submit" class="btn btn-primary">Tạo Cv</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        window.skill_index = 1;
        window.work_experience_index = 1;
        window.education_index = 1;
        window.activities_index = 1;
        window.certifications_index = 1;
        var json_skill = @json($skills);
        $(document).ready(function () {
            $('form input').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            $(document).on("keyup", ".skill input", function () {
                $(this).parent().children('#search_value').children('li').remove();
                var value = $(this).val();
                if (value !== '') {
                    for (var i = 0; i < json_skill.length; i++) {
                        if (json_skill[i].toLowerCase().includes(value.toLowerCase())) {
                            $(this).parent().children('#search_value').append("<li  class='skill-value col-12 list-group-item list-group-item-action'>" + json_skill[i] + "</li>");
                        }
                    }
                }
            });
            $(document).on("click", "li", function () {
                $(this).parent().parent().children('input').val($(this).html());
                $(this).parent().children("li").remove();
            });
            $(document).click(function (e) {
                var li = $("#search_value li");
                if (!li.is(event.target) && !li.has(event.target).length) {
                    li.remove();
                }
            });
            $(document).on("mouseenter mouseleave", ".input-item", function (e) {
                if (e.type == "mouseenter") {
                    $(this).children('.type-icon').removeClass('d-none');
                    $(this).removeClass('border border-light');
                    $(this).addClass('border border-dark');
                } else {
                    $(this).children('.type-icon').addClass('d-none');
                    $(this).removeClass('border border-dark');
                    $(this).addClass('border border-light');
                }
            });
            $(document).on("click", ".add-activities", function () {
                $(this).parent().parent().after('<div class="input-item border border-light pl-2">\
                    <div class="type-icon position-absolute justify-content-center ml-5 d-none" style="z-index: 1;">\
                    <i class="add-activities fa fa-plus-circle">Thêm</i>\
                <i class="delete fa fa-trash">Xóa</i>\
            </div>\
                <div class="form-group row mt-3">\
                    <input class="form-control-plaintext col-3" type="text" name="activities[' + window.activities_index + '][position]"\
                           value="" placeholder="Vị trí">\
                        <input class="form-control-plaintext col-3" type="text" name="activities[' + window.activities_index + '][from]"\
                               value=""\
                               placeholder="Bắt đầu">\
                            <input class="form-control-plaintext col-3" type="text" name="activities[' + window.activities_index + '][end]"\
                                   value=""\
                                   placeholder="Kết thúc">\
                </div>\
                <div class="form-group row">\
                    <input class="form-control-plaintext col-5" type="text" name="activities[0' + window.activities_index + '[namne]"\
                           value=""\
                           placeholder="Tên tổ chức">\
                </div>\
                <div class="form-group row">\
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"\
                                      name="activities[' + window.activities_index + '][description]" id=""\
                                      placeholder="Mô tả chi tiết hoạt động"></textarea>\
                </div>\
            </div>');
                window.skill_index = window.activities_index + 1;
            });
            $(document).on("click", ".add-certifications", function () {
                $(this).parent().parent().after('<div class="input-item border border-light pl-2">\
                    <div class="type-icon position-absolute justify-content-center ml-5 d-none" style="z-index: 1;">\
                    <i class="add-certifications fa fa-plus-circle">Thêm</i>\
                <i class="delete fa fa-trash">Xóa</i>\
            </div>\
                <div class="form-group row mt-3">\
                    <input class="form-control-plaintext col-3" type="text" name="certifications[' + window.certifications_index + '][time]"\
                           value="" placeholder="Thời gian">\
                </div>\
                <div class="form-group row">\
                    <input class="form-control-plaintext col-5" type="text" name="certifications[' + window.certifications_index + '][name]"\
                           value=""\
                           placeholder="Tên chứng chỉ">\
                </div>\
            </div>');
                window.skill_index = window.certifications_index + 1;
            });
            $(document).on("click", ".add-education", function () {
                $(this).parent().parent().after('<div class="input-item border border-light pl-2">\
                    <div class="type-icon position-absolute justify-content-center ml-5 d-none" style="z-index: 1;">\
                        <i class="add-education fa fa-plus-circle">Thêm</i>\
                        <i class="delete fa fa-trash">Xóa</i>\
                    </div>\
                    <div class="form-group row mt-3">\
                        <input class="form-control-plaintext col-3" type="text" name="education[' + window.education_index + '][major]"\
                               value=""\
                               placeholder="Ngành">\
                            <input class="form-control-plaintext col-3" type="text" name="education[' + window.education_index + '][from]"\
                                   value=""\
                                   placeholder="Bắt đầu">\
                                <input class="form-control-plaintext col-3" type="text" name="education[' + window.education_index + '][end]"\
                                       value=""\
                                       placeholder="Kết thúc">\
                    </div>\
                    <div class="form-group row">\
                        <input class="form-control-plaintext col-5" type="text" name="education[' + window.education_index + '][school]"\
                               value=""\
                               placeholder="Trường">\
                    </div>\
                    <div class="form-group row">\
                            <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"\
                                      name="education[' + window.education_index + '][description]" id=""\
                                      placeholder="Mô tả"></textarea>\
                    </div>\
                </div>');
                window.skill_index = window.education_index + 1;
            });
            $(document).on("click", ".add-work_experience", function () {
                $(this).parent().parent().after('<div class="input-item border border-light pl-2">\
                    <div class="type-icon position-absolute justify-content-center ml-5 d-none" style="z-index: 1;">\
                    <i class="add-work_experience fa fa-plus-circle">Thêm</i>\
                <i class="delete fa fa-trash">Xóa</i>\
            </div>\
                <div class="form-group row mt-3">\
                    <input class="form-control-plaintext col-3" type="text"\
                           name="work_experience[' + window.work_experience_index + '][position]"\
                           value="" placeholder="Vị trí">\
                        <input class="form-control-plaintext col-3" type="text" name="work_experience[' + window.work_experience_index + '][from]"\
                               value="" placeholder="Bắt đầu">\
                            <input class="form-control-plaintext col-3" type="text" name="work_experience[' + window.work_experience_index + '][end]"\
                                   value="" placeholder="Kết thúc">\
                </div>\
                <div class="form-group row">\
                    <input class="form-control-plaintext col-5" type="text" name="work_experience[' + window.work_experience_index + '][name]"\
                           value="" placeholder="Tên công ty">\
                </div>\
                <div class="form-group row">\
                                <textarea class="textarea-autosize form-control-plaintext col-7" rows="1"\
                                          name="work_experience[' + window.work_experience_index + '][description]" id=""\
                                          placeholder="Mô tả chi tiết công việc"></textarea>\
                </div>\
            </div>');
                window.skill_index = window.work_experience_index + 1;
            });
            $(document).on("click", ".add-skill", function () {
                $(this).parent().parent().after('\
                <div class="input-item border border-light skill col-6 pb-2 mt-2">\
                    <div class="type-icon position-absolute justify-content-center ml-5 d-none" style="z-index: 1;">\
                    <i class="add-skill fa fa-plus-circle">Thêm</i>\
                    <i class="delete fa fa-trash">Xóa</i>\
                </div>\
                    <div class="input-group col-12 skill-input mt-3">\
                        <input type="text" class="form-control-plaintext font-weight-bold" value=""\
                               name="skills[' + window.skill_index + '][name]"\
                               placeholder="Kỹ năng">\
                            <ul class="col-12 list-group position-absolute justify-content-center"\
                                id="search_value" style="top: 100%;z-index: 1;">\
                            </ul>\
                    </div>\
                    <div class="form-group col-12">\
                                    <textarea class="textarea-autosize form-control-plaintext" name="skills[' + window.skill_index + '][description]"\
                                              rows="1" id=""\
                                              placeholder="Mô tả kỹ năng"></textarea>\
                    </div>\
                </div>');
                window.skill_index = window.skill_index + 1;
            });
            $(document).on("click", ".delete", function () {
                $(this).parent().parent().remove();
            });
        });

        $('.select2').select2();
        $('.textarea-autosize').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // $(".icon-trash").hover(function () {
        //     $(this).append("<div class='col-1'><i class='d-flex fa fa-trash'></i></div>")
        // }, function () {
        //     $(this).children("div.col-1").remove();
        // })

        // $(".icon-add").hover(function () {
        //     $(this).prepend("<span class='plaintext' onclick='addSkill()'><i class='fa fa-pen'></i></span>")
        // }, function () {
        //     $(this).children("span").remove();
        // })
        //
        // function addSkill() {
        //     $(this).parent().parent().before('hello'+window.skill_index);
        //     window.skill_index = window.skill_index + 1;
        // }

    </script>
@endpush
