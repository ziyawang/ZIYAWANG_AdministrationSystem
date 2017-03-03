<!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css ')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" />
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/unicorn.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('assets/layer/layer/layer.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.zh-CN.js')}}"></script>

</head>
<body>
<form method="post" action="" class="form-horizontal" id="formPC"/>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="control-group" style="margin-top: 10px">
    <label class="control-label">关键人姓名</label>
    <div class="controls">
        <input type="text" name="KeyName" id="KeyName" value=""   />
    </div>
</div>
<div class="control-group">
    <label class="control-label">关键人年龄</label>
    <div class="controls">
        <input type="text" name="KeyAge" id="KeyAge" value=""   />
    </div>
</div>
<div class="control-group">
    <label class="control-label">关键人性别</label>
    <div class="controls">
        <input type="text" name="KeySex" id="KeySex" value=""   />
    </div>
</div>
<div class="control-group">
    <label class="control-label">关键人职位</label>
    <div class="controls">
        <input type="text" name="KeyWork" id="KeyWork" value=""   />
    </div>
</div>
<div class="control-group ">
    <label class="control-label">关键人生日</label>
    <div class="controls" >
        <input type="text" name="Birthday"  id="Birthday" value=""  style="width:100px" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">联系电话</label>
    <div class="controls">
        <input type="text" name="PhoneNumber" id="PhoneNumber" value=""   />
    </div>
</div>
<div class="control-group">
    <label class="control-label">邮箱</label>
    <div class="controls">
        <input type="text" name="Email" id="Email" value=""   />
    </div>
</div>
<div class="control-group">
    <label class="control-label">微信号</label>
    <div class="controls">
        <input type="text" name="Chart" id="Chart" value=""   />
    </div>
</div>
<div style="margin-left: 200px;margin-top: 20px">
    <button type="submit" class="btn btn-primary" id="button" >提交</button>
</div>
</body>
<script>
    $(function () {
        $('#Birthday').datetimepicker({
            minView: "month", //选择日期后，不会再跳转去选择时分秒
            format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
            language: 'zh-CN', //汉化
            autoclose:true //选择日期后自动关闭
        });
        $(function () {
            $('#button').on('click', function(){
                var index = parent.layer.getFrameIndex(window.name);
                var addperson = parent.$('#addperson');
                var name = $('#KeyName').val();
                var age = $('#KeyAge').val();
                var sex = $('#KeySex').val();
                var work = $('#KeyWork').val();
                var birth = $('#Birthday').val();
                var phone = $('#PhoneNumber').val();
                var email = $('#Email').val();
                var chart = $('#Chart').val();
                var html = "KeyName:"+name+",KeyAge:"+age+",KeySex:"+sex+",KeyWork:"+work+",Birthday:"+birth+",PhoneNumber:"+phone+",Email:"+email+",Chart:"+chart;
                addperson.append("<input type='text' name='addperson[]' value='"+html+"'>");
                parent.layer.close(index);
            });


           /* $("#button").on("click", function () {
                var data = $('#formPC').serialize();
                $.ajax({
                    url: "",
                    data: data,
                    dateType: "json",
                    type: "Post",
                    success: function (msg) {
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }
                })
            })*/
        })
    })
</script>
</html>