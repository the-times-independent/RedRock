<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RedRock
 */
?>

                    <footer id="colophon" class="site-footer" role="contentinfo">
<?php
                        if (has_nav_menu('colophon')) {
?>
                            <nav class="colophon-navigation" role="navigation">
<?php
                                wp_nav_menu(array(
                                    'theme_location'  => 'colophon',
                                    'depth'           => 1,
                                    'container_class' => 'colophon-menu-wrap',
                                    'menu_class'      => 'colophon-menu',
                                    'link_before'     => '<span>',
                                    'link_after'      => '</span>'
                                ));
?>
                            </nav>
<?php
                        }
?>
                    </footer>
                </div>
            </div>
        </div>
<?php
        wp_footer();
?>
    </body>
</html>