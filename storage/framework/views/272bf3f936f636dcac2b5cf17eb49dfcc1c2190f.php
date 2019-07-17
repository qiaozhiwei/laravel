<?php $__env->startSection('body'); ?>
<table class="layui-table">
      <colgroup>
        <col width="150">
        <col width="200">
        <col>
      </colgroup>
      <thead>
        <tr>
          <th>ID</th>
          <th>用户名</th>
          <th>添加时间</th>
          <th>权限</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="<?php echo e($item->id); ?>" field="state">
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->name); ?></td>
            <td>
                <?php echo e(date("Y-m-d H:i:s",$item->reg_time)); ?>

            </td>
            <td>
                <?php if($item->state==2): ?>
                管理员
                <?php else: ?>
                该用户被列入黑名单
                <?php endif; ?>
            </td>
            <td>
                <?php if($item->state==2): ?>
                <button class="yiku" value="1">晋升为root</button>
                <button class="yiku" value="3">拉入黑名单</button>
                <?php else: ?>
                <button class="yiku" value="1">晋升为root</button>
                <button class="yiku" value="2">晋升为管理员</button>
                <?php endif; ?>
            </td>
        </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <tr>
       <h3 align="center"><?php echo e($data->links()); ?></h3>
       </tr>
      </tbody>
    </table>
          
<?php $__env->stopSection(); ?>
<script src="/1.js"></script>
<script>

    $(function(){
        $('.yiku').click(function(){
            var _this=$(this);
            var text=_this.text();
            // alert(text);return false;
            var session=<?php echo e(Session::get('state')); ?>;
            // alert(session);
            if(session!=1){
                alert('不好意思,你没有相关权限');return false;
            }
            var value=_this.attr('value');
            // alert(value);
            var field=_this.parents('tr').attr('field');
            // alert(field);
            var id=_this.parents('tr').attr('id');
            // alert(id);
            $.get(
                "<?php echo e(url('User/state')); ?>",
                {id:id,value:value,field:field},
                function(res){
                    // console.log(res.code);
                    if(res.code==1){
                        if(value==2){
                            _this.attr('value','3');                            
                            _this.text('拉入黑名单');
                            _this.parents('td').prev('td').text('管理员');
                            // console.log(_this.parents('td').prev('td'));

                        }else if(value==3){
                            _this.attr('value','2');                            
                            _this.text('晋升为管理员');
                            _this.parents('td').prev('td').text('该用户被列入黑名单');
                        }else{
                            _this.parents('tr').remove();
                        }
                    }
                },
                'json'

            );
            
        });
    });
</script>
<?php echo $__env->make('layout.goodsparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/admin_index.blade.php ENDPATH**/ ?>