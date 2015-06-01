<?php
/*
 * The footer for displaying site-info.
 */
?>


<div class="entry-content">
	<?php the_widget( 'WP_Widget_Search' ); ?> 
	<?php the_widget( 'WP_Widget_Recent_Posts' ); ?> 
	<?php the_widget( 'WP_Widget_Recent_Comments' ); ?>
	<?php the_widget( 'WP_Widget_Meta' ); ?> 
	<?php the_widget( 'WP_Widget_Archives' ); ?> 
	<?php dynamic_sidebar( 'homepage-right' ); ?>

    <?php
       /* Always have wp_footer() just before the closing </body>
        * tag of your theme, or you will break many plugins, which
        * generally use this hook to reference JavaScript files.
        */
        wp_footer();
    ?>
</div>
</body>
</html>