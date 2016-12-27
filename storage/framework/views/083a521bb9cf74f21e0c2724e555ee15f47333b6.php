<!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css ')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-responsive.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>" />
        <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/unicorn.js')); ?>"></script>
        <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/layer/layer/layer.js')); ?>"></script>

</head>
<body>
    <form method="post" action="" class="form-horizontal" id="formPC"/>
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="memberId" value="<?php echo e($memberId); ?>">
        <input type="hidden" name="serviceId" value="<?php echo e($serviceId); ?>">
        <div class="control-group" style="margin-top: 20px">
            <label class="control-label" >类型</label>
            <div class="controls">
                <select name="Time" id="Time">
                    <option value="0"  >-请选择-</option>
                    <option value="1" >月度会员</option>
                    <option value="3" >季度会员</option>
                    <option value="12"  >年度会员</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">会员费(元)</label>
            <div class="controls">
                <input type="number" name="PayMoney"  id="PayMoney"/>
            </div>
        </div>
        <div class="control-group" id="from" >
            <label class="control-label">开始时间</label>
            <div class="controls">
                <input type="text" name="StartTime" />
            </div>
        </div>
    </form>
    <div style="margin-left: 200px;margin-top: 20px">
        <button type="submit" class="btn btn-primary" id="button" >提交</button>
    </div>
    </body>
<script>
    $(function () {
        /*  $('#longTime').datetimepicker({
         minView: "month", //选择日期后，不会再跳转去选择时分秒
         format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
         language: 'zh-CN', //汉化
         autoclose:true //选择日期后自动关闭
         });*/
        $(function () {
            $("#button").on("click", function () {
                var data = $('#formPC').serialize();
                $.ajax({
                    url: "<?php echo e(asset('members/saveRecharge')); ?>",
                    data: data,
                    dateType: "json",
                    type: "post",
                    success: function (msg) {
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }
                })
            })
        })
    })
</script>
</html>