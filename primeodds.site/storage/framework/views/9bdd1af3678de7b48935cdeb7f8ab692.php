<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH /home/dindinbet123456/htdocs/dindinbet.pro/vendor/filament/forms/resources/views/components/group.blade.php ENDPATH**/ ?>