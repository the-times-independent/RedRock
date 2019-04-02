<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package RedRock
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'That page cannot be found.', 'redrock' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( "The page you want has moved or does not exist. You might find what you want if you do a search.", 'redrock' ); ?></p>
                <?php
                    $fileName = basename(strtok($_SERVER["REQUEST_URI"], "?"));
                    $searchPrefill = preg_replace('/^article-/', '', $fileName);
                    $searchPrefill = preg_replace('/[^a-zA-Z0-9]+/', ' ', $searchPrefill);
                    $searchPrefill = trim($searchPrefill);
                    include(locate_template('searchform.php', false, false));
                ?>
            </div>
        </section>
    </main>
</div>

<?php get_footer(); ?>
