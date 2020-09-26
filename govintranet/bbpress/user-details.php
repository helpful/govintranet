<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

$directorystyle = get_option('options_staff_directory_style'); // 0 = squares, 1 = circles

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<div id="bbp-single-user-details-gi" class="col-lg-2 col-md-2 col-sm-3">
		<div id="bbp-user-avatar">

			<span class='vcard'>
				<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php esc_attr(bbp_displayed_user_field( 'display_name' )); ?>" rel="me">
					<?php
					$user_id = bbp_get_displayed_user_field( 'ID' ); 
					$avstyle=" img-responsive";
					if ( $directorystyle==1 ) $avstyle.= " img-circle";
					$imgsrc = get_avatar($user_id ,150,"",bbp_get_displayed_user_field( 'display_name' ));
					$imgsrc = str_replace(" photo", " photo ".$avstyle, $imgsrc);
					echo $imgsrc;
					?>						
				</a>
			</span>

		</div><!-- #author-avatar -->

		<div id="bbp-user-navigation">
			<ul>
				<li class="<?php if ( bbp_is_single_user_profile() ) :?>current<?php endif; ?>">
					<span class="vcard bbp-user-profile-link">
						<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( esc_attr__("%s's Profile", 'govintranet' ),  bbp_get_displayed_user_field( 'display_name' ) ); ?>" rel="me"><?php _e( 'Profile', 'govintranet' ); ?></a>
					</span>
				</li>

				<?php 
					global $wpdb;
					$uqblog = $wpdb->get_results("select ID from $wpdb->posts where post_author = ".$user_id." and post_type='blog' and post_status='publish' order by post_date DESC limit 1;",ARRAY_A);
					if ( count($uqblog) > 0 ):
						$poduser = get_userdata($user_id);	
						$nicename = $poduser->user_nicename;
						?>
						<li>
							<span class='bbp-user-blogposts-created-link'>
								<a href="<?php echo site_url("/author/").$nicename."/"; ?>" title="<?php printf( esc_attr__( "%s's blog posts", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Blog posts', 'govintranet' ); ?></a>
							</span>
						</li>
						<?php
					endif;
					
					// Show forum links?
					if ( get_option('options_forum_support') ): 
						if ( bbp_get_user_topic_count() ) : ?>
						<li class="<?php if ( bbp_is_single_user_topics() ) :?>current<?php endif; ?>">
							<span class='bbp-user-topics-created-link'>
								<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( esc_attr__( "%s's forum topics", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Forum topics', 'govintranet' ); ?></a>
							</span>
						</li>
						<?php
						endif;
						if ( bbp_get_user_reply_count() ) : ?>						
						<li class="<?php if ( bbp_is_single_user_replies() ) :?>current<?php endif; ?>">
							<span class='bbp-user-replies-created-link'>
								<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's forum replies", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Forum replies', 'govintranet' ); ?></a>
							</span>
						</li>
						<?php
						endif;
						?>						
		
						<?php if ( bbp_is_favorites_active() ) : ?>
							<li class="<?php if ( bbp_is_favorites() ) :?>current<?php endif; ?>">
								<span class="bbp-user-favorites-link">
									<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( esc_attr__( "%s's forum favourites", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Favourites', 'govintranet' ); ?></a>
								</span>
							</li>
					<?php endif; ?>

				<?php endif; ?>

				<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

					<?php if ( bbp_is_subscriptions_active() ) : ?>
						<li class="<?php if ( bbp_is_subscriptions() ) :?>current<?php endif; ?>">
							<span class="bbp-user-subscriptions-link">
								<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( esc_attr__( "%s's forum subscriptions", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Subscriptions', 'govintranet' ); ?></a>
							</span>
						</li>
					<?php endif; ?>

					<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
						<span class="bbp-user-edit-link">
							<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( esc_attr__( "Edit %s's profile", 'govintranet' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Edit profile', 'govintranet' ); ?></a>
						</span>
					</li>

				<?php endif; ?>

			</ul>
		</div><!-- #bbp-user-navigation -->
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
