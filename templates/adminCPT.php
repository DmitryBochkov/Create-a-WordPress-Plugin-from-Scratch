<div class="wrap">
  <h1>CPT Manager</h1>
  <?php settings_errors(); ?>

  <form action="options.php" method="post">
    <?php
      settings_fields( 'mu_plugin_cpt_settings' );
      do_settings_sections( 'mup_cpt' );
      submit_button();
    ?>
  </form>


</div>
