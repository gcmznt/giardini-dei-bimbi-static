<?php
define("ADMIN_MENU", "admin-menu");
define("LOGGED_MENU", "logged-in");
define("PUBLIC_MENU", "logged-out");
define("LOGOUT_MENU_NAME", "Logout");

define("ROLE_PARENT", "parent");
define("ROLE_TEACHER", "teacher");
define("ROLE_OWNER", "owner");

define("POST_TYPE_CHILDREN", "children");
define("POST_TYPE_MENU", "menu");
define("POST_TYPE_ACTIVITY", "activity");
define("POST_TYPE_TEACHER", "teacher");

include_once("custom-fields.php");

function main_menu() {
  $user = wp_get_current_user();
  $allowed_roles = array(ROLE_OWNER, ROLE_TEACHER);
  $menu = PUBLIC_MENU;
  if (is_user_logged_in()) {
    $menu = (array_intersect($allowed_roles, $user->roles)) ? ADMIN_MENU : LOGGED_MENU;
  }
  return wp_nav_menu(array(
    "theme_location"  => $menu,
    "menu"            => "",
    "container"       => "nav",
    "container_class" => "menu",
    "container_id"    => "menu",
    "menu_class"      => "menu",
    "menu_id"         => "",
    "echo"            => true,
    "fallback_cb"     => "wp_page_menu",
    "before"          => "",
    "after"           => "",
    "link_before"     => "",
    "link_after"      => "",
    "items_wrap"      => '<ul>%3$s</ul>',
    "depth"           => 0,
    "walker"          => ""
  ));
}

function is_parent($user) {
  return isset($user->roles) && is_array($user->roles) && in_array(ROLE_PARENT, $user->roles);
}

function create_post_types() {
  register_post_type(POST_TYPE_ACTIVITY, array(
    'labels' => array(
      'name' => 'Giornaliero', /* nome, al plurale, dell'etichetta del post type. */
      'singular_name' => 'Giornaliero', /* nome, al singolare, dell'etichetta del post type. */
      'all_items' => 'Tutte le schede', /* testo nei menu che indica tutti i contenuti del post type */
      'add_new' => 'Aggiungi nuova', /*testo del pulsante Aggiungi. */
      'add_new_item' => 'Aggiungi nuova scheda', /* testo per il pulsante Aggiungi nuovo post type */
      'edit_item' => 'Modifica scheda', /*  testo modifica */
      'new_item' => 'Nuova scheda', /* testo nuovo oggetto */
      'view_item' => 'Visualizza scheda', /* testo per visualizzare */
      'search_items' => 'Cerca scheda', /* testo per la ricerca*/
      'not_found' =>  'Nessuna scheda trovata', /* testo se non trova nulla */
      'not_found_in_trash' => 'Nessuna scheda trovata nel cestino', /* testo se non trova nulla nel cestino */
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('revision'),
    'show_in_rest' => true,
    'menu_position' => 2
  ));
  register_post_type(POST_TYPE_CHILDREN, array(
    'labels' => array(
      'name' => 'Bambini', /* nome, al plurale, dell'etichetta del post type. */
      'singular_name' => 'Bambino', /* nome, al singolare, dell'etichetta del post type. */
      'all_items' => 'Tutti i bambini', /* testo nei menu che indica tutti i contenuti del post type */
      'add_new' => 'Aggiungi nuovo', /*testo del pulsante Aggiungi. */
      'add_new_item' => 'Aggiungi nuovo bambino', /* testo per il pulsante Aggiungi nuovo post type */
      'edit_item' => 'Modifica bambino', /*  testo modifica */
      'new_item' => 'Nuovo bambino', /* testo nuovo oggetto */
      'view_item' => 'Visualizza bambino', /* testo per visualizzare */
      'search_items' => 'Cerca bambino', /* testo per la ricerca*/
      'not_found' =>  'Nessun bambino trovato', /* testo se non trova nulla */
      'not_found_in_trash' => 'Nessun bambino trovato nel cestino', /* testo se non trova nulla nel cestino */
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('revision'),
    'show_in_rest' => true,
    'menu_position' => 2
  ));
  register_post_type(POST_TYPE_MENU, array(
    'labels' => array(
      'name' => 'Menu', /* nome, al plurale, dell'etichetta del post type. */
      'singular_name' => 'Menu', /* nome, al singolare, dell'etichetta del post type. */
      'all_items' => 'Tutti i menu', /* testo nei menu che indica tutti i contenuti del post type */
      'add_new' => 'Aggiungi nuovo', /*testo del pulsante Aggiungi. */
      'add_new_item' => 'Aggiungi nuovo menu', /* testo per il pulsante Aggiungi nuovo post type */
      'edit_item' => 'Modifica menu', /*  testo modifica */
      'new_item' => 'Nuovo menu', /* testo nuovo oggetto */
      'view_item' => 'Visualizza menu', /* testo per visualizzare */
      'search_items' => 'Cerca menu', /* testo per la ricerca*/
      'not_found' =>  'Nessun menu trovato', /* testo se non trova nulla */
      'not_found_in_trash' => 'Nessun menu trovato nel cestino', /* testo se non trova nulla nel cestino */
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('revision'),
    'show_in_rest' => true,
    'menu_position' => 2
  ));
  register_post_type(POST_TYPE_TEACHER, array(
    'labels' => array(
      'name' => 'Maestre', /* nome, al plurale, dell'etichetta del post type. */
      'singular_name' => 'Maestra', /* nome, al singolare, dell'etichetta del post type. */
      'all_items' => 'Tutte le maestre', /* testo nei menu che indica tutti i contenuti del post type */
      'add_new' => 'Aggiungi nuova', /*testo del pulsante Aggiungi. */
      'add_new_item' => 'Aggiungi nuova maestra', /* testo per il pulsante Aggiungi nuovo post type */
      'edit_item' => 'Modifica maestra', /*  testo modifica */
      'new_item' => 'Nuova maestra', /* testo nuovo oggetto */
      'view_item' => 'Visualizza maestra', /* testo per visualizzare */
      'search_items' => 'Cerca maestra', /* testo per la ricerca*/
      'not_found' =>  'Nessuna maestra trovata', /* testo se non trova nulla */
      'not_found_in_trash' => 'Nessuna maestra trovata nel cestino', /* testo se non trova nulla nel cestino */
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('revision'),
    'show_in_rest' => true,
    'menu_position' => 2
  ));

  $labels = get_post_type_object('post')->labels;
  $labels->name = 'Avvisi';
  $labels->singular_name = 'Avviso';
  $labels->add_new = 'Aggiungi avviso';
  $labels->add_new_item = 'Aggiungi avviso';
  $labels->edit_item = 'Modifica avviso';
  $labels->new_item = 'Avviso';
  $labels->view_item = 'Visualizza avviso';
  $labels->search_items = 'Cerca avviso';
  $labels->not_found = 'Nessun avviso trovato';
  $labels->not_found_in_trash = 'Nessun avviso trovato nel cestino';
  $labels->all_items = 'Tutti gli avvisi';
  $labels->menu_name = 'Avvisi';
  $labels->name_admin_bar = 'Avvisi';
}

function change_title($post_id) {
  remove_action("save_post", "change_title");
  switch (get_post_type($post_id)) {
    case POST_TYPE_MENU:
    case POST_TYPE_TEACHER:
      wp_update_post(array("ID" => $post_id, "post_title" => get_field("nome") . ""));
      break;
    case POST_TYPE_CHILDREN:
      wp_update_post(array("ID" => $post_id, "post_title" => get_field("nome") . " " . get_field("cognome")));
      break;
    case POST_TYPE_ACTIVITY:
      wp_update_post(array("ID" => $post_id, "post_title" => get_field("data") . " - " . get_field("bambino")->post_title));
      break;
  }
  add_action("save_post", "change_title");
}

add_action('init', function () {
  create_post_types();
  register_nav_menus(array(
    ADMIN_MENU => "Menu per amministratori",
    LOGGED_MENU => "Menu per utenti loggati",
    PUBLIC_MENU => "Menu pubblico"
  ));
  remove_post_type_support("post", "comments");
  remove_post_type_support("page", "comments");
});

add_filter("login_redirect", function ($redirect_to, $request, $user) {
  return is_parent($user) ? "/children/" : admin_url("edit.php?post_type=" . POST_TYPE_ACTIVITY);
}, 10, 3 );

add_action("wp_logout", function () {
  wp_redirect(home_url());
  exit();
});

add_filter("wp_nav_menu_objects", function ($items) {
  foreach ($items as $item){
    if ($item->title === LOGOUT_MENU_NAME) {
      $item->url = $item->url . "&_wpnonce=" . wp_create_nonce("log-out");
    }
  }
  return $items;
});

// if (get_role(ROLE_TEACHER)){
//   remove_role(ROLE_TEACHER);
// }
add_role(ROLE_TEACHER,
  __("Maestra"),
  array(
    "read" => true,
    "upload_files" => false,
    "edit_post" => true,
    "edit_posts" => true,
    "delete_post" => false,
    "delete_posts" => false,
    "edit_others_posts" => true,
    "delete_others_posts" => false,
    "delete_others_post" => false,
    "edit_published_posts" => true,
    "delete_published_posts" => false,
    "delete_published_post" => false
  )
);

add_role(ROLE_PARENT,
  __("Genitore"),
  array(
    "read" => true,
    "edit_posts" => false,
    "delete_posts" => false,
    "moderate_comments" => false,
  )
);

add_role(ROLE_OWNER,
  __("Titolare"),
  array(
    "read" => true,
    "upload_files" => true,
    "edit_posts" => true,
    "delete_posts" => true,
    "publish_posts" => true,
    "edit_others_posts" => true,
    "delete_others_posts" => true,
    "edit_published_posts" => true,
    "delete_published_posts" => true,
    "edit_pages" => true,
    "delete_pages" => true,
    "publish_pages" => true,
    "edit_others_pages" => true,
    "delete_others_pages" => true,
    "edit_published_pages" => true,
    "delete_published_pages" => true,
    "list_users" => true,
    "edit_users" => true,
    "create_users" => true,
    "delete_users" => true,
    "moderate_comments" => false,
  )
);

add_action("editable_roles", function ($roles) {
  if (isset($roles["subscriber"])) { unset($roles["subscriber"]); }
  if (isset($roles["contributor"])) { unset($roles["contributor"]); }
  if (isset($roles["author"])) { unset($roles["author"]); }
  if (isset($roles["editor"])) { unset($roles["editor"]); }
  return $roles;
});

add_action("login_head", function () {
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login.css" />';
});

add_action("admin_menu", function () {
  remove_menu_page("edit-comments.php");
});

add_action("wp_before_admin_bar_render", function () {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu("comments");
});

add_action("pre_get_posts", function ($query) {
  if (is_admin() || defined('DOING_CRON')) { return $query; }

  if (isset($query->query_vars["post_type"]) && $query->query_vars["post_type"] === POST_TYPE_CHILDREN) {
    // if (current_user_can("administrator")) {
    //   $query->set("posts_per_page", 20);
    // } else {
      $query->set("meta_query", array(
        array(
          "key"     => "genitore",
          "value"   => '"' . get_current_user_id() . '"',
          "compare" => "LIKE"
        ),
      ));
    // }
  }

  return $query;
});

add_action("save_post", "change_title");

add_action("login_head", function () {
  remove_action("login_head", "wp_shake_js", 12);
});

add_filter("login_footer", function () {
  echo "<script>document.getElementById('rememberme').checked = true;</script>";
});

add_filter("manage_users_columns", function ($column) {
  return array(
    "cb" => $columns["cb"],
    "username" => __("Username"),
    "name" => __("Nome"),
    "email" => __("Email"),
    "role" => __("Ruolo"),
    "figli" => __("Figli"),
    "telefono" => __("Telefono"),
    "codice_fiscale" => __("Codice Fiscale"),
  );
});

add_filter("manage_users_custom_column", function ($val, $column, $user_id) {
  switch ($column) {
    case "telefono":
      return get_field("telefono", "user_" . $user_id);
      break;
    case "figli":
      $query = new WP_Query(array(
        "post_type" => POST_TYPE_CHILDREN,
        "meta_query" => array(
          array(
            "key"     => "genitore",
            "value"   => '"' . $user_id . '"',
            "compare" => "LIKE"
          ),
        )
      ));

      $figli = "";
      if ($query->have_posts()) {
        while ( $query->have_posts() ) {
          $query->the_post();
          $figli .= get_field('nome', get_the_ID()) . ' ' . get_field('cognome', get_the_ID()) . '<br>';
        }
      }
      wp_reset_postdata();
      return $figli;
      break;
    case "codice_fiscale":
      return get_field("codice_fiscale", "user_" . $user_id);
      break;
  }
  return $val;
}, 10, 3);

add_filter("manage_" . POST_TYPE_CHILDREN . "_posts_columns", function ($columns) {
  return array(
    "cb" => $columns["cb"],
    "title" => __("Nome"),
    "genere" => __(""),
    "data_di_nascita" => __("Data di nascita"),
    "genitore" => __("Genitore"),
    "maestra" => __("Maestra"),
  );
});

add_action("manage_" . POST_TYPE_CHILDREN . "_posts_custom_column", function ($column, $post_id) {
  switch ($column) {
    case "genere":
    case "data_di_nascita":
      echo get_field($column, $post_id);
      break;
    case "genitore":
      foreach(get_field("genitore", $post_id) as $value => $label ):
        echo $label["user_firstname"] . " " . $label["user_lastname"] . ": " . get_field("telefono", "user_" . $label["ID"] ) . "<br>";
      endforeach;
      break;
    case "maestra":
      echo get_field("maestra", $post_id)->post_title;
      break;
  }
}, 10, 2);

add_filter("manage_" . POST_TYPE_MENU . "_posts_columns", function ($columns) {
  return array(
    "cb" => $columns["cb"],
    "title" => __("Nome"),
    "data_di_inizio" => __("Data di inizio"),
  );
});

add_action("manage_" . POST_TYPE_MENU . "_posts_custom_column", function ($column, $post_id) {
  switch ($column) {
    case "data_di_inizio":
      echo get_field("data_di_inizio", $post_id);
      break;
  }
}, 10, 2);

add_filter("manage_" . POST_TYPE_TEACHER . "_posts_columns", function ($columns) {
  return array(
    "cb" => $columns["cb"],
    "title" => __("Nome"),
    "bambini" => __("Bambini"),
  );
});

add_action("manage_" . POST_TYPE_TEACHER . "_posts_custom_column", function ($column, $post_id) {
  switch ($column) {
    case "bambini":
      $query = new WP_Query(array(
        "post_type" => POST_TYPE_CHILDREN,
        "meta_query" => array(
          array(
            "key"     => "maestra",
            "value"   => $post_id,
            "compare" => "="
          ),
        )
      ));

      echo $query->post_count;
      
      if ($query->have_posts()) {
        echo ': ';
        while ( $query->have_posts() ) {
          $query->the_post();
          echo get_field('nome', get_the_ID()) . ' ' . get_field('cognome', get_the_ID()) . ', ';
        }
      }
      wp_reset_postdata();
      break;
  }
}, 10, 2);

add_filter("manage_" . POST_TYPE_ACTIVITY . "_posts_columns", function ($columns) {
  return array(
    "cb" => $columns["cb"],
    "scheda" => __("Scheda"),
    "mangiato" => __("Ha mangiato?"),
    "dormito" => __("Ha dormito?"),
    "merenda" => __("Ha fatto merenda?"),
    "attivita" => __("Attivitá"),
    "scaricato" => __("Ha scaricato?"),
    "febbre" => __("Febbre"),
    "patelli" => __("Patelli"),
    "maestra" => __("Maestra"),
  );
});

add_action("manage_" . POST_TYPE_ACTIVITY . "_posts_custom_column", function ($column, $post_id) {
  switch ($column) {
    case "scheda":
      echo edit_post_link(get_field("data", $post_id) . ' - ' . get_field("bambino", $post_id)->nome . ' ' . get_field("bambino", $post_id)->cognome, '<strong>', '</strong>');
      break;
    case "mangiato":
      echo get_field("menu", $post_id)['primo']['mangiato'] ? '✅' : '';
      break;
    case "dormito":
      echo get_field("nanna", $post_id)['alle'] ? '✅' : (get_field("nanna", $post_id)['dalle'] ? '😴' : '');
      echo get_field("secondo_pisolino", $post_id)['alle'] ? '✅' : (get_field("secondo_pisolino", $post_id)['dalle'] ? '😴' : '');
      echo get_field("terzo_pisolino", $post_id)['alle'] ? '✅' : (get_field("terzo_pisolino", $post_id)['dalle'] ? '😴' : '');
      break;
    case "scaricato":
      echo get_field("scarica_1", $post_id)['ora'] ? '💩' : '';
      echo get_field("scarica_2", $post_id)['ora'] ? '💩' : '';
      echo get_field("scarica_3", $post_id)['ora'] ? '💩' : '';
      break;
    case "merenda":
      echo get_field("merenda", $post_id) ? '✅' : '';
      break;
    case "attivita":
      echo get_field("attivita", $post_id) ? '✅' : '';
      break;
    case "febbre":
      echo get_field("febbre", $post_id)['ora'] ? '🌡' : '';
      break;
    case "patelli":
      echo get_field("patelli", $post_id) ? '✅' : '';
      break;
    case "maestra":
      echo get_field("maestra", $post_id)->post_title;
      break;
  }
}, 10, 2);

function get_today_menu() {
  $now = time();
  $today = date("Ymd");

  $query = new WP_Query(array(
    "post_type" => POST_TYPE_MENU,
    "posts_per_page" => 1,
    "post_status" => "publish",
    "meta_query" => array(
      array(
        "key" => "data_di_inizio",
        "value" => $today,
        "type" => "DATE",
        "compare" => "<="
      )
    ),
    "meta_key" => "data_di_inizio",
    "orderby" => "meta_value",
    "order" => "DESC",
  ));

  $day_map = array(
    0 => "domenica",
    1 => "lunedi",
    2 => "martedi",
    3 => "mercoledi",
    4 => "giovedi",
    5 => "venerdi",
    6 => "sabato"
  );

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();

      $start = strtotime(str_replace('/', '-', get_field("data_di_inizio")));
      $difference = $now - $start;
      $days = floor($difference / (60 * 60 * 24));

      wp_reset_postdata();
      return get_field("settimana_" . (floor($days / 7) % 4 + 1))[$day_map[date("w", $now)]];
    }
  }
}

add_action("create_activity_hook", function () {
  $now = time();
  if (0 < date("w", $now) && date("w", $now) < 6) {
    $menu = get_today_menu();

    $query = new WP_Query(array(
      "post_type" => POST_TYPE_CHILDREN,
      "posts_per_page" => -1,
      "orderby" => "title",
      "order" => "DESC",
    ));

    if ($query->have_posts()) {
      while ( $query->have_posts() ) {
        $query->the_post();

        $post_id = wp_insert_post(array(
          "post_title"	=> date("Y-m-d") . " - " . get_the_title(),
          "post_type"		=> POST_TYPE_ACTIVITY,
          "post_status"	=> "publish"
        ));

        update_field("data", date("Y-m-d"), $post_id);
        update_field("bambino", get_the_ID(), $post_id);
        update_field("maestra", get_field("maestra", get_the_ID())->ID, $post_id);
        update_field("menu", array(
          "primo" => array(
            "piatto" => $menu["primo"]
          ),
          "secondo" => array(
            "piatto" => $menu["secondo"]
          ),
          "contorno" => array(
            "piatto" => $menu["contorno"]
          ),
          "frutta" => array(
            "piatto" => $menu["frutta"]
          ),
        ), $post_id);
      }
      wp_reset_postdata();
    }
  }
});

if (!wp_next_scheduled("create_activity_hook")) {
  wp_schedule_event(strtotime("today midnight"), "daily", "create_activity_hook");
}

add_action("init", function () {
  if (!session_id()) {
    session_start();
  }
}, 1);

add_action("restrict_manage_posts", function () {
  $type = isset($_GET["post_type"]) ? $_GET["post_type"] : "post";

  if (POST_TYPE_ACTIVITY == $type) {
    $query = new WP_Query(array(
      "post_type" => POST_TYPE_TEACHER
    ));

    if ($query->have_posts()) {
?>
    <select name="teacher_id">
      <option value=""><?php _e("Tutte le maestre"); ?></option>
<?php
      while ( $query->have_posts() ) {
        $query->the_post();
        $_SESSION["teacher_id"] = isset($_GET["teacher_id"]) ? $_GET["teacher_id"] : "";
        printf(
          '<option value="%s"%s>%s</option>',
          get_the_ID(),
          get_the_ID() == $_SESSION["teacher_id"] ? ' selected="selected"' : "",
          get_field("nome", get_the_ID())
        );
      }
?>
    </select>
<?php
    }
  }
});

add_filter("parse_query", function ($query) {
  global $pagenow;
  $type = isset($_GET["post_type"]) ? $_GET["post_type"] : "post";

  if (
    POST_TYPE_ACTIVITY == $type
    && is_admin()
    && $pagenow == "edit.php"
    && isset($_GET["teacher_id"])
    && $_GET["teacher_id"] != ""
    && $query->is_main_query()
  ) {
    $query->query_vars["meta_query"] = array(
      array(
        "key" => "maestra",
        "value" => $_GET["teacher_id"],
        "compare" => "="
      )
    );
  }
});

function hide_field( $field ) {
  return false;
}

function show_title( $field ) {
  // echo '<h1 class="acf-field">' . get_the_title() . '</h1>';
  echo '<h1 class="acf-field">' . get_field('field_5ca4c96dc706b') . ' - ' . get_field('field_5ca4c98dc706c')->post_title . '</h1>';
}

add_filter( 'acf/prepare_field/key=field_5ca4c96dc706b', 'show_title' );
add_filter( 'acf/prepare_field/key=field_5ca4c96dc706b', 'hide_field' );
add_filter( 'acf/prepare_field/key=field_5ca4c98dc706c', 'hide_field' );
add_filter( 'acf/prepare_field/key=field_5ca757e756fe5', 'hide_field' );

add_filter("redirect_post_location", function ($location) {
  return ((isset($_POST["save"]) || isset($_POST["publish"])) && isset($_POST["post_type"]) && $_POST["post_type"] == POST_TYPE_ACTIVITY)
    ? admin_url("edit.php?post_type=" . POST_TYPE_ACTIVITY . "&teacher_id=" . $_SESSION["teacher_id"])
    : $location;
});

add_action("admin_menu", function () {
  if (!current_user_can("administrator")):
    remove_menu_page("edit.php?post_type=" . POST_TYPE_CHILDREN);
    remove_menu_page("edit.php?post_type=" . POST_TYPE_MENU);
    remove_menu_page("edit.php?post_type=" . POST_TYPE_TEACHER);
    remove_menu_page("edit.php"); // Posts
    remove_menu_page("upload.php"); // Media
    remove_menu_page("link-manager.php"); // Links
    remove_menu_page("edit-comments.php"); // Comments
    remove_menu_page("edit.php?post_type=page"); // Pages
    remove_menu_page("plugins.php"); // Plugins
    remove_menu_page("themes.php"); // Appearance
    remove_menu_page("users.php"); // Users
    remove_menu_page("tools.php"); // Tools
    remove_menu_page("options-general.php"); // Settings
  endif;
});

is_admin() && add_action("pre_get_posts", function ($query) {
  if ($query->is_main_query() && POST_TYPE_ACTIVITY == $query->get("post_type")) {
    $query->set("orderby", "ID");
  }
});    

add_filter("post_row_actions", function ($actions) {
  if (get_post_type() === POST_TYPE_ACTIVITY) {
    unset($actions["edit"]);
    unset($actions["view"]);
    unset($actions["trash"]);
    unset($actions["inline hide-if-no-js"]);
  }

  return $actions;
}, 10, 1);

add_action("admin_enqueue_scripts", function () {
  wp_enqueue_style("admin-styles", get_template_directory_uri() . "/admin.css");
});


add_action('admin_menu', 'awesome_page_create');
function awesome_page_create() {
  $page_title = 'Modifica menu';
  $menu_title = 'Modifica menu';
  $capability = 'edit_posts';
  $menu_slug = 'edit_menu';
  $function = 'my_awesome_page_display';
  $icon_url = '';
  $position = 24;

  add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}

function my_awesome_page_display() {
  if (!current_user_can('manage_options')) {
    wp_die('Unauthorized user');
  }

  // check_admin_referrer( 'wpshout_option_page_example_action' );

  if (isset($_POST['primo'])) {
    $today = date("Ymd");
    $query = new WP_Query(array(
      "post_type" => "activity",
      "posts_per_page" => -1,
      "meta_query" => array(
        array(
          "key" => "data",
          "value" => $today,
          "type" => "DATE",
          "compare" => "="
        )
      ),
      "meta_key" => "data"
    ));

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();

        update_field("menu", array(
          "primo" => array(
            "piatto" => $_POST['primo']
          ),
          "secondo" => array(
            "piatto" => $_POST['secondo']
          ),
          "contorno" => array(
            "piatto" => $_POST['contorno']
          ),
          "frutta" => array(
            "piatto" => $_POST['frutta']
          ),
        ), get_the_ID());
      }
      wp_reset_postdata();
    }
    
    echo '<div class="updated notice">
    <p>Menu aggiornato</p>
</div>';
  } 

  $menu = get_today_menu();

  $value = get_option('awesome_text', 'hey-ho');

  include 'edit-menu.php';
}
