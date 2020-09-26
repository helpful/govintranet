<?php
/**
 * The template for displaying user profile pages. 
 *
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

get_header(); 

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="col-lg-12 white ">
	<div class="row">
		<div class='breadcrumbs'>
		<?php 
		if ( bbp_is_single_user() ):
			if (function_exists('bcn_display')) {
				bcn_display();
			} else {
				echo "<a href='" . get_home_url() . "'>" . __('Home', 'govintranet') . "</a>";
			}
			$sd = get_option('options_module_staff_directory_page');
			$sd = $sd[0];
			$directory = "<a href='" . get_permalink($sd) . "'>" . get_the_title($sd) . "</a>";
			if ( function_exists('bcn_display') ){
				$bcn = get_option('bcn_options');
				$sep = $bcn['hseparator'];
			} else {
				$sep = " > ";
			}
			echo $sep;
			echo $directory;
			echo $sep; 
			the_title(); 
		elseif (function_exists('bcn_display') && !is_front_page()) :
			bcn_display();
		endif; ?>
		</div>
	</div>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>