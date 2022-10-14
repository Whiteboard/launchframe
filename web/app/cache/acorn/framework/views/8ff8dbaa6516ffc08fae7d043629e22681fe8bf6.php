<?php $__env->startSection('content'); ?>
    <?php while(have_posts()): ?> <?php (the_post()); ?>
        <?php echo $__env->make('partials.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo e(get_field('hero')); ?>

        <?php echo $__env->first(['partials.content-page', 'partials.content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/brettbash/Dev/Launchframe/Site/web/app/themes/launchframe/resources/views/page.blade.php ENDPATH**/ ?>