<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>测评系统</a>
        <a href="#" class="current">测评列表</a>
        <?php /*<a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>*/ ?>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('check/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >做题数量</label>
                    <div class="controls selectBox" >
                        <select  name="count" id="count"/>
                        <option value="0">全部<option>
                        <option value="1" <?php if( $count==1): ?> selected="selected" <?php endif; ?>>1</option>
                        <option value="2" <?php if($count==2): ?> selected="selected" <?php endif; ?>>2</option>
                        <option value="3" <?php if( $count==3): ?> selected="selected" <?php endif; ?>>3</option>
                        <option value="4" <?php if( $count==4): ?> selected="selected" <?php endif; ?>>4</option>
                        <option value="5" <?php if($count==5): ?> selected="selected" <?php endif; ?>>5</option>
                        <option value="6" <?php if( $count==6): ?> selected="selected" <?php endif; ?>>6</option>
                        <option value="7" <?php if( $count==7): ?> selected="selected" <?php endif; ?>>7</option>
                        <option value="8" <?php if($count==8): ?> selected="selected" <?php endif; ?>>8</option>
                        <option value="9" <?php if( $count==9): ?> selected="selected" <?php endif; ?>>9</option>
                        <option value="10" <?php if( $count==10): ?> selected="selected" <?php endif; ?>>10</option>
                        <option value="11" <?php if($count==11): ?> selected="selected" <?php endif; ?>>11</option>
                        <option value="12" <?php if( $count==12): ?> selected="selected" <?php endif; ?>>12</option>
                        <option value="13" <?php if( $count==13): ?> selected="selected" <?php endif; ?>>13</option>
                        <option value="14" <?php if($count==14): ?> selected="selected" <?php endif; ?>>14</option>
                        <option value="15" <?php if( $count==15): ?> selected="selected" <?php endif; ?>>15</option>
                        <option value="16" <?php if( $count==16): ?> selected="selected" <?php endif; ?>>16</option>
                        <option value="17" <?php if($count==17): ?> selected="selected" <?php endif; ?>>17</option>
                        <option value="18" <?php if( $count==18): ?> selected="selected" <?php endif; ?>>18</option>
                        <option value="19" <?php if( $count==19): ?> selected="selected" <?php endif; ?>>19</option>
                        <option value="20" <?php if($count==20): ?> selected="selected" <?php endif; ?>>20</option>
                        <option value="21" <?php if( $count==21): ?> selected="selected" <?php endif; ?>>21</option>
                        <option value="22" <?php if( $count==22): ?> selected="selected" <?php endif; ?>>22</option>
                        <option value="23" <?php if($count==23): ?> selected="selected" <?php endif; ?>>23</option>
                        <option value="24" <?php if( $count==24): ?> selected="selected" <?php endif; ?>>24</option>
                        <option value="25" <?php if( $count==25): ?> selected="selected" <?php endif; ?>>25</option>
                        </select>
                    </div>
                </div>
            </td>
        </table>
        </form>
    </div>
  <?php /*  <script>
        $(function(){
            var type = $('#typeName').val();
            var province=$("#province").val();
            var state=$("#state").val();
            var phoneNumber=$("#phoneNumber").val();
            var member=$("#member").val();
            var url = 'http://admin.ziyawang.com/check/export?type='+type+"&province="+province+"&state="+state+"&phoneNumber="+phoneNumber+"&member="+member;
            $('#export').attr('href',url);
        });
    </script>*/ ?>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>身份证</th>
                    <th>企业名称</th>
                    <th>金额(单位/万元)</th>
                    <th>地址</th>
                    <th>类型</th>
                    <th>身份</th>
                    <th>分数</th>
                    <th>做题数目</th>
                    <th>测试渠道</th>
                    <th>测试时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->number); ?></td>
                        <td><?php echo e($data->Name); ?></td>
                        <td><?php echo e($data->PhoneNumber); ?></td>
                        <td><?php echo e($data->IDNumber); ?></td>
                        <td><?php echo e($data->CompanyName); ?></td>
                        <td><?php echo e($data->Money); ?></td>
                        <td><?php echo e($data->Area); ?></td>
                        <td><?php echo e($data->AssetType); ?></td>
                        <td><?php echo e($data->Type); ?></td>
                        <td><?php echo e($data->Score); ?></td>
                        <td><?php echo e($data->Count); ?></td>
                        <td><?php echo e($data->Channel); ?></td>
                        <td><?php echo e($data->TestTime); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["count"=>$count])->render(); ?>

        </div>
        <script>
            $(function(){
                $("#count").on("change",function(){
                    var count =$("#count").val();
                    location.href="<?php echo e(asset('test/ajaxChoose')); ?>"+"?count="+count;
                })
            })
        </script>
    </div>
    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>