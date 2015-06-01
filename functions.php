<?php

function display_hello()
{
    echo 'Bonjour les agilistes';
}


function get_id_publish_pages(){
  $pages = get_all_page_ids();
  $publish_pages = array();  
  foreach($pages as $id){
    $pageSpecifique = get_post($id);
    $the_query = new WP_Query( 'page_id='.$id );
    while ( $the_query->have_posts() ) {
      $the_query->the_post(); 
      if($pageSpecifique->post_status  == "publish"){	
	$publish_pages[] = $id;
      }
    }
  wp_reset_postdata();
  }
  return $publish_pages;
}

function display_logo(){
  ?>
  <!--<div id="agile"></div>-->
  
  <a href='<?php echo esc_url( home_url( '/' ) ); ?>'>
  <div id="banniere"><div class="iconeagile"></div>
  <h1 ><?php bloginfo('name'); ?></h1>
  <?php bloginfo('description'); ?>	
  </div>
  </a>
  <?php
}


function get_formating_post_content($id) {
    $content = get_post_field(post_content, $id);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    
    return $content;
}


function display_menu_all_posts($idCSS){
  print "<!-- DEBUT MENU POSTS -->\n";
  
  foreach(get_pages() as $id){
    print "<!-- DEBUT LIEN POST -->\n";
    print "<a id=\"$idCSS\" href=\"#";
    print get_the_title($id);
    print "\"><h4>";
    print get_the_title($id);
    print "</h4></a>\n<!-- FIN LIEN POST -->\n";
  }
  
  print "<!-- FIN MENU POSTS -->\n";
}


function display_pages_menu(){ 
    ?>
    <!-- DEBUT MENU POSTS -->
    <div class="nav-menu">
    <ul>
    <?php
    foreach(get_pages() as $id){ ?>
        <li>
        <!-- DEBUT LIEN POST -->
        <a id="<?php print $idCSS; ?>" href="#<?php print get_the_title($id); ?>"> 
            <?php print get_the_title($id); ?>
        </a>
        <!-- FIN LIEN POST -->
        </li> <?php
    } ?>
    </ul>
    </div>
    <!-- FIN MENU POSTS -->
    <?php
}


function display_navbar_pages_menu(){
    ?>
    <header id="masthead" class="site-header" role="banner">
	<!---<div id="navbar" class="navbar">-->
		<nav id="site-navigation" class="navigation main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></button>
			<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
                <!-- DEBUT MENU POSTS -->
                    <div class="nav-menu">
                        <ul>
                        <?php
                        foreach(get_pages() as $id){ ?>
                            <li>
                            <!-- DEBUT LIEN POST -->
                            <a id="<?php print $idCSS; ?>" href="#<?php print get_the_title($id); ?>"> 
                                <?php print get_the_title($id); ?>
                            </a>
                            <!-- FIN LIEN POST -->
                            </li> <?php
                        } ?>
                        <li>
                            <?php get_search_form(); ?>
                        </li>
                        </ul>
                    </div>
                <!-- FIN MENU POSTS -->
		</nav><!-- #site-navigation -->
	<!--</div><!-- #navbar -->
	</header><!-- #masthead -->
    <?php
}

	
function display_all_posts(){
  ?> <!-- DEBUT ALL POSTS -->
  <div class="entry-content">
  <?php $i = 1;
  
  foreach(get_pages() as $id){
      ?>
      <!-- DEBUT POST -->
            <!-- DEBUT LIEN POST -->
                <a id="titrepost" name="<?php print get_the_title($id); ?>"></a>
            <!-- FIN LIEN POST -->
            <div id="titrelien"><h2>
                <span class="line-abs"></span>
                    &nbsp; <?php print get_the_title($id); ?> &nbsp;
                <span class="line-abs"></span>
            </h2></div>
            <?php print get_formating_post_content($id);  ?>
        <!-- FIN POST -->
    <?php $i++; 
    } ?>
    </div>
  <!-- FIN ALL  POST --> <?php
}



function display_css_and_faticon(){
  print "<link href=\"";
  print str_replace(ABSPATH, "", dirname(__FILE__));
  print "/style.css\" type=\"text/css\" rel=\"stylesheet\" media=\"all\"  />";
  print "<link href=\"";
  print str_replace(ABSPATH, "", dirname(__FILE__));
  print "/images/logoAgileToulouse1000x1000.ico\" rel=\"shortcut icon\" type=\"image/x-icon\" />";
}


function display_posts_menu(){
    ?>
    <div class="menu">
        <?php display_menu_all_posts("lienmenu"); ?>
    </div>
    <?php
}


function display_menu_posts_and_articles(){
    $idCSS = "lienmenu";
    print "<div class=\"menu\">\n";
    display_menu_all_posts($idCSS);
    print "</div>\n";
}
    
function display_post_comment(){
?>
<ol class="commentlist">
	<?php
		//Gather comments for a specific page/post 
		$comments = get_comments(array(
			'status' => 'approve', //Change this to the type of comments to be displayed
		));

		//Display the list of comments
		wp_list_comments(array(
			'per_page' => 10, //Allow comment pagination
			'reverse_top_level' => false //Show the latest comments at the top of the list
		), $comments);
	?>
</ol>
<?php
}

function display_all_comments(){
    print "<!-- DEBUT COMMENTAIRES -->\n";
    print "<a id=\"titrepost\" name=\"";
    print "Commentaires";
    print "\"></a>\n";
    print "<!-- FIN LIEN POST -->\n";
    print "<div id=\"titrelien\"><h2><span class=\"line-abs\"></span>";
    print "Commentaires";
    print "<span class=\"line-abs\"></span></h2></div>\n";
    display_post_comments();
    $args = array(
    'comment_field' =>  '<p class="comment-form-comment"><b><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label></b><p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">'.
    '</textarea></p></p>',);
    comment_form($args);
    print "<!-- FIN COMMENTAIRES -->\n";

}


function display_articles(){
    $args = array( 'posts_per_page' => 5,);
    $i = 0;
    $posts = get_posts($args);
    print "<!-- DEBUT ARTICLES -->\n";
    print "<div id=\"content\">";
    print "<a id=\"titrepost\" name=\"";
    print "Blog";
    print "\"></a>\n";
    print "<!-- FIN LIEN ARTICLES -->\n";
    print "<div id=\"titrelien\"><h2><span class=\"line-abs\"></span>&nbsp;";
    print "Blog";
    print "&nbsp;<span class=\"line-abs\"></span></h2></div>\n";
    
    
    
    foreach ($posts as $post){
      $i++;
      $id = $post->ID;
      print "<!-- DEBUT ARTICLE -->\n";
      print "<div id=\"titrelien\"><h2>";
      print "<p>Article n°".$i. " : ".get_the_title($id)."</p>";
      print "</h2></div>\n";
      print "<!-- FIN ARTICLE -->\n";
      print "<!-- DEBUT COMMENTAIRES ARTICLE -->\n";
      
      print get_formating_post_content($id);
      
      $comments = get_comments("post_id=$id");
      print "<h3>Commentaires de l'article</h3>";
      foreach( $comments as $comment){
	$d = "j F Y";
	print "<p>commenté par : <b>". get_comment_author($comment->comment_ID)."</b> , le : <b>".get_comment_date($d,$comment->comment_ID). "</b>, </p>";	
	print "<div class=\"corpscommentaires\"><i>";

	print comment_text($comment->comment_ID);
	print "</i></div>";
      }
      print "<!-- FIN COMMENTAIRES ARTICLE -->\n";
      print "<!-- INVITE ECRIRE COMMENTAIRE -->\n";
      the_comment(); //insertion de l'invite de commentaires
      print "<!-- FIN INVITE ECRIRE COMMENTAIRE -->\n";
    }
    print "</div>";
    print "<!-- FIN ARTICLES -->\n";

}

function fonction_shortcode_last_post() {
 return the_widget( 'WP_Widget_Recent_Posts' );
}
add_shortcode('lasts_posts_and_comments', 'fonction_shortcode_last_post');

function headercolor_customize_register($wp_customize) {
    
    // on ajoute une nouvelle section
    $wp_customize->add_section('headercolor_customize', array(
        'title' => 'Header Customize color',
        'description' => 'Customize header background color',
        'priority' => 30
    ));
    
    // on ajoute une nouvelle option
    $wp_customize->add_setting( 'header_backgroundcolor' , array(
        //'default'     => '#59CBD6',
        'default'     => 'lightblue',
        'transport'   => 'refresh',
    ));
    
    // on ajoute l'option dans la section
    $wp_customize->add_control( 'header_backgroundcolor', array(
        'label'        => __( 'Color value', 'headercolor' ),
        'section'    => 'headercolor_customize',
        'settings'   => 'header_backgroundcolor',
    ));
 }

add_action( 'customize_register', 'headercolor_customize_register' );


function bargeo_customize_register($wp_customize) {
    
    // on ajoute une nouvelle section
    $wp_customize->add_section('bargeo_twitter', array(
        'title' => 'Twitter',
        'description' => 'Lien vers le compte Twitter',
        'priority' => 130
    ));
    
    // on ajoute une nouvelle option
    $wp_customize->add_setting( 'twitter' , array(
        'default'     => '@machin',
        'transport'   => 'refresh',
    ));
    
    // on ajoute l'option dans la section
    $wp_customize->add_control( 'twitter', array(
        'label'        => __( 'Pseudo du compte Twitter', 'bargeo' ),
        'section'    => 'bargeo_twitter',
        'settings'   => 'twitter',
    ));
}

add_action( 'customize_register', 'bargeo_customize_register' );

?>