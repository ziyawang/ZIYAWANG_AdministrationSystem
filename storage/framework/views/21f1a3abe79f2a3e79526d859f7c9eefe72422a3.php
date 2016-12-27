<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 center" style="text-align: center;">
                <ul class="stat-boxes">
                    <li>
                        <div class="left peity_bar_good"><span><?php echo e($data['TsevenUser']); ?>,<?php echo e($data['TsixUser']); ?>,<?php echo e($data['TfiveUser']); ?>,<?php echo e($data['TfourUser']); ?>,<?php echo e($data['TthreeUser']); ?>,<?php echo e($data['TtwoUser']); ?>,<?php echo e($data['ToneUser']); ?></span><?php echo e($data['change'].'%'); ?></div>
                        <div class="right">
                            <strong><?php echo e($data['users']); ?></strong>
                            注册总数
                        </div>
                    </li>
                    <li>
                        <div class="left peity_bar_neutral"><span><?php echo e($data['sevenUser']); ?>,<?php echo e($data['sixUser']); ?>,<?php echo e($data['fiveUser']); ?>,<?php echo e($data['fourUser']); ?>,<?php echo e($data['threeUser']); ?>,<?php echo e($data['twoUser']); ?>,<?php echo e($data['oneUser']); ?></span><?php echo e($data['changeUser'].'%'); ?></div>
                        <div class="right">
                            <strong><?php echo e($data['lastUser']); ?></strong>
                            上周注册数
                        </div>
                    </li>
                    <li>
                        <div class="left peity_bar_bad"><span><?php echo e($data['TsevenSer']); ?>,<?php echo e($data['TsixSer']); ?>,<?php echo e($data['TfiveSer']); ?>,<?php echo e($data['TfourSer']); ?>,<?php echo e($data['TthreeSer']); ?>,<?php echo e($data['TtwoSer']); ?>,<?php echo e($data['ToneSer']); ?></span><?php echo e($data['changeSer'].'%'); ?></div>
                        <div class="right">
                            <strong><?php echo e($data['services']); ?></strong>
                            服务方总数
                        </div>
                    </li>
                    <li>
                        <div class="left peity_line_good"><span><?php echo e($data['sevenSer']); ?>,<?php echo e($data['sixSer']); ?>,<?php echo e($data['fiveSer']); ?>,<?php echo e($data['fourSer']); ?>,<?php echo e($data['threeSer']); ?>,<?php echo e($data['twoSer']); ?>,<?php echo e($data['oneSer']); ?></span><?php echo e($data['lchangeSer'].'%'); ?></div>
                        <div class="right">
                            <strong><?php echo e($data['lastServices']); ?></strong>
                            过去一周
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>数据展示</h5></div></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span4">
                                <ul class="site-stats">
                                    <li><i class="icon-user"></i> <strong><?php echo e($data['projectinfos']); ?></strong> <small>信息条数</small></li>
                                    <li><i class="icon-arrow-right"></i> <strong><?php echo e($data['lastOrders']); ?></strong> <small>上周发布</small></li>
                                    <li class="divider"></li>
                                    <li><i class="icon-shopping-cart"></i> <strong><?php echo e($data['orders']); ?></strong> <small>总订单数</small></li>
                                    <li><i class="icon-tag"></i> <strong><?php echo e($data['hots']); ?></strong> <small>抢单中</small></li>
                                    <li><i class="icon-repeat"></i> <strong><?php echo e($data['togethers']); ?></strong> <small>已合作</small></li>
                                </ul>
                            </div>
                            <?php foreach($chart as $val): ?>
                                <input type="hidden" value="<?php echo e($val); ?>">
                            <?php endforeach; ?>
                            <?php foreach($times as $key=>$time): ?>

                            <input type="hidden" id="A<?php echo e($key); ?>" value="<?php echo e($time); ?>">
                            <?php endforeach; ?>
                            <input type="hidden" id="max" value="<?php echo e($max); ?>">
                            <input type="hidden" id="min" value="<?php echo e($min); ?>">
                            <div class="span8">
                                <div class="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/excanvas.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.flot.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.flot.resize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.peity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/unicorn.dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>
    <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>