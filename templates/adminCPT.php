<div class="wrap">
  <h1>CPT Manager</h1>
  <?php settings_errors(); ?>



  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-1">Your Custom Post Types</a></li>
    <li><a href="#tab-2">Add Custom Post Type</a></li>
    <li><a href="#tab-3">Export</a></li>
  </ul>

  <div class="tab-content">
    <div id="tab-1" class="tab-pane active">
      <h3>Manage Your Custom Post Types</h3>
      <?php
        // $options = ! get_option( 'mu_plugin_cpt' ) ? array() : get_option( 'mu_plugin_cpt' );
        $options = get_option( 'mu_plugin_cpt' ) ?: array();

        echo '<table class="cpt-table"><tr><th>ID</th><th>Singular Name</th><th>Plural Name</th><th>Public</th><th>Has Archive</th><th>Actions</th></tr>';
        foreach ($options as $option) {
          // if (empty($option["post_type"])) {
          //   continue; // Temp solution
          // }
          $public = isset($option['public']) ? 'true' : 'false';
          $has_archive = isset($option['has_archive']) ? 'true' : 'false';

          echo '<tr><td>' . $option['post_type'] . '</td><td>' . $option['singular_name'] . '</td><td>' . $option['plural_name'] . '</td><td>' . $public . '</td><td>' . $has_archive . '</td><td><a href="#">EDIT</a> - <a href="#">DELETE</a></td></tr>';
        }
        echo '</table>';
      ?>
    </div>

    <div id="tab-2" class="tab-pane">
      <!-- <h3>Create Custom Post Type</h3> -->
      <form action="options.php" method="post">
        <?php
          settings_fields( 'mu_plugin_cpt_settings' );
          do_settings_sections( 'mup_cpt' );
          submit_button();
        ?>
      </form>
    </div>

    <div id="tab-3" class="tab-pane">
      <h3>Export Custom Post Types</h3>
    </div>
  </div>


</div>
