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
		<h1 class="page-title">Nothing found</h1>
	</header>
	<div class="page-content">
<?php
        if (is_search()) {
?>
            <p>Nothing matched your search. You can try again with different keywords.</p>
<?php
            get_search_form();
        }
        else {
?>
            <p>The page you want has moved or does not exist. You might find what you want if you do a search.</p>
<?php
            get_search_form();
        }
?>
	</div>
</section>
