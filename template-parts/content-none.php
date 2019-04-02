<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'redrock' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		    if ( is_search() ) :
		?>
                <p>
                    <?php esc_html_e( 'Nothing matched your search. You can try again with different keywords.', 'redrock' ); ?>
                </p>
                <?php get_search_form(); ?>
		<?php
		    else :
		?>
                <p>
                    <?php esc_html_e( 'The page you want has moved or does not exist. You might find what you want if you do a search.', 'redrock' ); ?>
                </p>
                <?php get_search_form(); ?>
		<?php
		    endif;
		?>
	</div>
</section>
