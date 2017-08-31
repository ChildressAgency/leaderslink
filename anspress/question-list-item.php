<?php
/**
 * Template for question list item.
 *
 * @link    https://anspress.io
 * @since   0.1
 * @license GPL 2+
 * @package AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

$clearfix_class = array( 'ap-questions-item clearfix' );

?>
<div id="question-<?php the_ID(); ?>" <?php post_class( $clearfix_class ); ?>>
	<div class="ap-questions-inner">
		<span class="ap-questions-title" itemprop="title">
			<?php the_title(); ?>
		</span>
		<div class="ap-display-question-meta">
			<?php echo ap_question_metas() ?>
		</div>
		<div class="ap-avatar ap-pull-left">
			<a href="<?php ap_profile_link(); ?>"<?php ap_hover_card_attr(); ?>>
				<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>

		<div class="ap-questions-summery">
			<div class="questions-desc">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="read-more">more...</a>
			</div>
		</div>
	</div>
</div><!-- list item -->
