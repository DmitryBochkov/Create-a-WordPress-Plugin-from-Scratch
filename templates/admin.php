<div class="wrap">
  <h1>My Universal Plugin</h1>
  <?php settings_errors(); ?>

  <form action="options.php" method="post">
    <?php
      settings_fields( 'mup_options_group' );
      do_settings_sections( 'mu_plugin' );
      submit_button();
    ?>
  </form>
</div>
