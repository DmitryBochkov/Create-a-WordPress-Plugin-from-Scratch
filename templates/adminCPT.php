<div class="wrap">
  <h1>CPT Manager</h1>
  <?php settings_errors(); ?>


  <ul class="nav nav-tabs">
    <li class="<?php echo !isset( $_POST['edit_post'] ) ? 'active' : ''; ?>"><a href="#tab-1">Your Custom Post Types</a></li>
    <li class="<?php echo isset( $_POST['edit_post'] ) ? 'active' : ''; ?>">
      <a href="#tab-2"><?php echo isset( $_POST['edit_post'] ) ? 'Edit ' : 'Add '; ?> Add Custom Post Type</a>
    </li>
    <li><a href="#tab-3">Export</a></li>
  </ul>

  <div class="tab-content">
    <div id="tab-1" class="tab-pane <?php echo !isset( $_POST['edit_post'] ) ? 'active' : ''; ?>">
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

          echo '<tr><td>' . $option['post_type'] . '</td><td>' . $option['singular_name'] . '</td><td>' . $option['plural_name'] . '</td><td>' . $public . '</td><td>' . $has_archive . '</td><td> ';

          echo '<form action="" method="post" class="inline-block">';
          echo '<input type="hidden" name="edit_post" value="'. $option['post_type'] . '">';
          submit_button( 'Edit', 'primary small', 'submit', false );
          echo '</form> ';

          echo '<form action="options.php" method="post" class="inline-block">';
          settings_fields( 'mu_plugin_cpt_settings' );
          echo '<input type="hidden" name="remove" value="'. $option['post_type'] . '">';
          submit_button( 'Delete', 'delete small', 'submit', false, array(
            'onclick' => 'return confirm("Are you sure you want to delete this Custom Posе Type? The data associated with it will not be deleted.");'
          ) );
          echo '</form></td></tr>';
        }
        echo '</table>';
      ?>
    </div>

    <div id="tab-2" class="tab-pane <?php echo isset( $_POST['edit_post'] ) ? 'active' : ''; ?>">
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

      <?php foreach ($options as $option) { ?>
        <h4><?php echo $option['singular_name']; ?></h4>
      <pre class="prettyprint">
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( '<?php echo $option['plural_name']; ?>', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( '<?php echo $option['singular_name']; ?>', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( '<?php echo $option['plural_name']; ?>', 'text_domain' ),
		'name_admin_bar'        => __( '<?php echo $option['singular_name']; ?>', 'text_domain' ),
		'archives'              => __( '<?php echo $option['singular_name']; ?> Archives', 'text_domain' ),
		'attributes'            => __( '<?php echo $option['singular_name']; ?> Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent <?php echo $option['singular_name']; ?>:', 'text_domain' ),
		'all_items'             => __( 'All <?php echo $option['plural_name']; ?>', 'text_domain' ),
		'add_new_item'          => __( 'Add New <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'edit_item'             => __( 'Edit <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'update_item'           => __( 'Update <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'view_item'             => __( 'View <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'view_items'            => __( 'View <?php echo $option['plural_name']; ?>', 'text_domain' ),
		'search_items'          => __( 'Search <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this <?php echo $option['singular_name']; ?>', 'text_domain' ),
		'items_list'            => __( '<?php echo $option['plural_name']; ?> list', 'text_domain' ),
		'items_list_navigation' => __( '<?php echo $option['plural_name']; ?> list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter <?php echo $option['plural_name']; ?> list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( '<?php echo $option['singular_name']; ?>', 'text_domain' ),
		'description'           => __( '<?php echo $option['singular_name']; ?> Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => <?php echo isset($option['public']) ? 'true' : 'false'; ?>,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => <?php echo isset($option['has_archive']) ? 'true' : 'false'; ?>,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( '<?php echo $option['post_type']; ?>', $args );

}
add_action( 'init', 'custom_post_type', 0 );
    </pre>
    <?php } ?>
    </div>
  </div>


</div>
