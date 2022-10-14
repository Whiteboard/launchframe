<form role="search" method="get" class="search-form" action="<?php echo e(home_url('/')); ?>">
  <label>
    <span class="sr-only">
      <?php echo e(_x('Search for:', 'label', 'sage')); ?>

    </span>

    <input
      type="search"
      placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'sage'); ?>"
      value="<?php echo e(get_search_query()); ?>"
      name="s"
    >
  </label>

  <button><?php echo e(_x('Search', 'submit button', 'sage')); ?></button>
</form>
<?php /**PATH /Users/brettbash/Dev/Launchframe/Site/web/app/themes/launchframe/resources/views/forms/search.blade.php ENDPATH**/ ?>