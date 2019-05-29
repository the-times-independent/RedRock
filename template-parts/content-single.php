<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */

ob_start();
the_content();
$thePost = ob_get_clean();

$topElements = '';
if (!get_post_format()) {
    $topElements = redrock_remove_top_elements($thePost);
}

?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class(); ?>
>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<?php echo $topElements; ?>
		<div class="entry-meta">
			<?php redrock_entry_meta(); ?>
		</div>
	</header>

	<div class="entry-content">
<?php
		echo $thePost;
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'redrock'),
            'after'  => '</div>',
        ));
?>
	</div>

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php redrock_entry_footer(); ?>
		</div>
	</footer>
</article>