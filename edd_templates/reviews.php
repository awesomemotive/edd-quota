<?php
/**
 * Reviews Template
 *
 * The template used to display the reviews on each download. This template is
 * extendable via filters and hooks but can be completely changed using the EDD
 * templating engine and placing a file called reviews.php in the edd_templates
 * directory in your theme folder.
 *
 * @package EDD_Reviews
 * @subpackage Templates
 * @copyright Copyright (c) 2013, Sunny Ratilal
 * @author Sunny Ratilal
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php if ( comments_open() ) : ?>

	<?php ob_start(); ?>

	<div id="edd_reviews">
		<div id="comments" class="comments-area">
			<?php edd_reviews()->maybe_show_review_breakdown(); ?>

			<?php
			$total_reviews = edd_reviews()->count_reviews();
			$total_ratings = edd_reviews()->count_ratings();

			if ( $total_reviews > 0 ) :
				$average_rating = number_format( $total_ratings / $total_reviews, 2 );
				edd_reviews()->reviews_title( $average_rating, $total_reviews );
			else :
				edd_reviews()->reviews_title();
			endif;
			?>

			<?php if ( have_comments() ) : ?>

				<ol class="commentlist comment-list">
					<?php wp_list_comments( array( 'callback' => 'edd_reviews_callback' ) ); ?>
				</ol>

				<?php if ( 1 > get_comment_pages_count() && get_option( 'page_comments' ) ) : ?>

				<div class="navigation edd-reviews-navigation">
					<div class="nav-previous edd-reviews-nav-prev"><?php previous_comments_link( sprintf( __( '%s&larr;%s Previous', 'edd-reviews' ), '<span class="meta-nav">', '</span>' ) ); ?></div>
					<div class="nav-next edd-reviews-nav-next"><?php next_comments_link( sprintf( __( 'Next %s&rarr;%s', 'edd-reviews' ), '<span class="meta-nav">', '</span>' ) ); ?></div>
				</div>

				<?php endif; ?>

			<?php else : ?>

				<p><?php echo sprintf( apply_filters( 'edd_reviews_no_reviews_message', __( 'No reviews yet! Be the first to review this %s!', 'edd-reviews' ) ), edd_get_label_singular( true ) ); ?></p>

			<?php endif; ?>

			<?php edd_reviews()->reviews_form(); ?>
		</div>
	</div>

	<?php echo ob_get_clean(); ?>

<?php endif; ?>