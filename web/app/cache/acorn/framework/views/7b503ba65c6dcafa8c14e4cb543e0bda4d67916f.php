<header class="banner">
  <a class="brand" href="<?php echo e(home_url('/')); ?>">
    <?php echo $siteName; ?>

  </a>

  <?php if(has_nav_menu('primary_navigation')): ?>
    <nav class="nav-primary" aria-label="<?php echo e(wp_get_nav_menu_name('primary_navigation')); ?>">
      <?php echo wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]); ?>

    </nav>
  <?php endif; ?>
</header>
<?php /**PATH /Users/brettbash/Dev/Launchframe/Site/web/app/themes/launchframe/resources/views/sections/header.blade.php ENDPATH**/ ?>