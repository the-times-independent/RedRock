<?php
/**
 * The RedRock header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RedRock
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'redrock' ); ?></a>
        <header id="masthead" class="site-header" role="banner">
            <div class="top-bar">
                <div class="top-search-wrap">
                    <?php get_search_form(); ?>
                </div>
            </div>
            <div class="col-width header-wrap">
                <?php $header_image = get_header_image();
                    if ( ! empty( $header_image ) ) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header-image-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php header_image(); ?>" class="site-header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="" />
                    </a>
                <?php } ?>
                <div class="site-heading">
                    <div class="site-branding">
                        <?php
                            if ( has_custom_logo() ) :
                                redrock_site_logo();
                            elseif ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php
                            else: ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                            endif;
                        ?>
                        
                        <?php $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
                </div><!-- .site-heading -->
            </div>
            <div class="col-width sub-header-wrap">
                <?php if ( has_nav_menu( 'header' ) ) : ?>
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="menu-toggle" aria-controls="header-menu" aria-expanded="false" data-close-text="<?php esc_attr_e( 'Close', 'redrock' ); ?>"><?php esc_html_e( 'Menu', 'redrock' ); ?></button>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'header',
                        'menu_id'        => 'header-menu'
                    ) ); ?>
                </nav><!-- #site-navigation -->
                <?php endif; ?>

            </div><!-- .col-width -->
        </header><!-- #masthead -->
        
        <div class="paying-wages before-content">
            <?php
                if( function_exists('the_ad_placement') ) { the_ad_placement('before-content'); }
            ?>
        </div>

        <div id="content" class="site-content clear">
            <div class="col-width">
