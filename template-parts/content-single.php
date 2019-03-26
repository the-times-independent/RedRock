<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php redrock_entry_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( redrock_has_post_thumbnail() ) { ?>
	<div class="post-hero-image clear-fix">
		<figure class="entry-image">
			<?php the_post_thumbnail( 'full' ); ?>
		</figure>
	</div><!-- .post-hero-image -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'redrock' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php redrock_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->