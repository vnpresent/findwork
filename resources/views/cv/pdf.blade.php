<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            page-break-inside: auto;
        }

        * {
            box-sizing: border-box;
        }

        .col-lg-8 {
            width: 66%;
            float: left;
        }

        .col-lg-9 {
            width: 75%;
            /*float: left;*/
        }

    </style>
</head>
<body style="background-color:#fafafa;">
<div>
    <h3 style="text-align:center; margin-bottom: 0px">{{ $cv['name'] }}</h3>
    <h3 style="text-align:center; margin-top: 0px;">{{ $cv['position'] }}</h3>
</div>

<div class="row" style="width: 100%;align-items: center;">
    <div class="col-lg-9" style="display: block;margin: auto;">
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Thông tin cá nhân</h3>
            <ul>
                <li>
                    <div style="margin-bottom:0px;margin-top: 5px;">
                        <p style="margin: 0px;">Tên:{{ $cv['profile']['name'] }}</p>
                    </div>
                </li>
                <li>
                    <div style="margin-bottom:0px;margin-top: 5px;">
                        <p style="margin: 0px;">Ngày Sinh:{{ $cv['profile']['birthday'] }}</p>
                    </div>
                </li>
                <li>
                    <div style="margin-bottom:0px;margin-top: 5px;">
                        <p style="margin: 0px;">Số Điện Thoại:{{ $cv['profile']['phone'] }}</p>
                    </div>
                </li>
                <li>
                    <div style="margin-bottom:0px;margin-top: 5px;">
                        <p style="margin: 0px;">Email:{{ $cv['profile']['email'] }}</p>
                    </div>
                </li>
                <li>
                    <div style="margin-bottom:0px;margin-top: 5px;">
                        <p style="margin: 0px;">Địa Chỉ:{{ $cv['profile']['address'] }}</p>
                    </div>
                </li>

            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Mục Tiêu Nghề Nghiệp</h3>
            <ul>
                <li>
                    <div style="margin-bottom:0px;margin-top: 10px; width: 80%;">
                        <p style="margin: 0px">{{ $cv['objective'] }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Kĩ Năng</h3>
            <ul>
                @foreach((array)$cv['skills'] as $skill)
                    <li>
                        <div style="margin-bottom:0px;margin-top: 10px;">
                            <p style="margin: 0px">{{ $skill['name'] }}</p>
                            <p style="margin: 0px">{{ $skill['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Kinh Nghiệm Làm Việc</h3>
            <ul>
                @foreach((array)$cv['work_experience'] as $work_experience)
                    <li>
                        <div style="margin-bottom:0px;margin-top: 10px;">
                            <p style="margin: 0px">{{ $work_experience['position'] }} {{ $work_experience['from'] }}-{{ $work_experience['end'] }}</p>
                            <p style="margin: 0px">{{ $work_experience['name'] }}</p>
                            <p style="margin: 0px">{{ $work_experience['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Học vấn</h3>
            <ul>
                @foreach((array)$cv['education'] as $education)
                    <li>
                        <div style="margin-bottom:0px;margin-top: 10px;">
                            <p style="margin: 0px">{{ $education['major'] }} {{ $education['from'] }}-{{ $education['end'] }}</p>
                            <p style="margin: 0px">{{ $education['school'] }}</p>
                            <p style="margin: 0px">{{ $education['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Hoạt Động</h3>
            <ul>
                @foreach((array)$cv['activities'] as $activity)
                    <li>
                        <div style="margin-bottom:0px;margin-top: 10px;">
                            <p style="margin: 0px">{{ $activity['position'] }} {{ $activity['from'] }}-{{ $activity['end'] }}</p>
                            <p style="margin: 0px">{{ $activity['name'] }}</p>
                            <p style="margin: 0px">{{ $activity['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Chứng Chỉ</h3>
            <ul>
                @foreach((array)$cv['certifications'] as $certification)
                    <li>
                        <div style="margin-bottom:0px;margin-top: 10px;">
                            <p style="margin: 0px">{{ $certification['time'] }}</p>
                            <p style="margin: 0px">{{ $certification['name'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


{{--<div class="row">--}}
{{--    <div class="column" style=" background-color:red; display:inline-block;">--}}
{{--        <div style="">--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Kinh nghiệm làm việc</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Học vấn</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Hoạt động</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Chứng chỉ</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div class="column" style=" background-color:red; display:inline-block;">--}}
{{--        <div style="">--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Thông tin cá nhân</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Hoạt động</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h3 style="margin-bottom: 0px;border-bottom: 1px solid black;">Chứng chỉ</h3>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập pythonthực tập</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div style="margin-bottom:0px;margin-top: 10px;">--}}
{{--                        <p style="margin: 0px">TTS 2022 2022</p>--}}
{{--                        <p style="margin: 0px">W3 school</p>--}}
{{--                        <p style="margin: 0px">thực tập python</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


</body>
</html>
