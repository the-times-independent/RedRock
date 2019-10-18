<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
            <header id="masthead" class="site-header" role="banner">
                <div id="top-bar">
                    <span class="top-search-wrap">
                        <?php get_search_form(); ?>
                    </span>
                    <span class="user-account">
<?php
                        if (is_user_logged_in()) {
                            $accountURL = memberful_account_url();
                            ?><a class='button' href='<?php $accountURL ?>'>Account</a><?php
                        }
                        else {
                            $signInURL = memberful_sign_in_url();
                            $subscribeURL = "/subscribe";
                            ?><a class='button' href='<?php echo $signInURL; ?>'>Sign in</a> <a class='button' href='<?php echo $subscribeURL; ?>'>Subscribe</a><?php
                        }
?>
                    </span>
                </div>
                <div class="col-width header-wrap">
<?php
                    $header_image = get_header_image();
                    if (!empty($header_image)) { 
?>
                        <a
                            href="<?php echo esc_url(home_url('/')); ?>"
                            class="site-header-image-link"
                            title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
                            rel="home"
                        >
                            <img
                                src="<?php header_image(); ?>"
                                class="site-header-image"
                                width="<?php echo esc_attr(get_custom_header()->width); ?>"
                                height="<?php echo esc_attr(get_custom_header()->height); ?>"
                                alt=""
                            />
                        </a>
<?php
                    }
?>
                    <div class="site-heading">
                        <div class="site-branding">
<?php
                            if (has_custom_logo()) {
                                redrock_site_logo();
                            }
                            elseif (is_front_page() && is_home()) {
?>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
<?php
                            }
                            else {
?>
                                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
<?php
                            }
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) {
?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
<?php
                            }
?>
                        </div>
                    </div>
                </div>
                <div class="col-width sub-header-wrap">
<?php
                    if (has_nav_menu('header')) {
?>
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <button
                                class="menu-toggle"
                                aria-controls="header-menu"
                                aria-expanded="false"
                                data-close-text="<?php esc_attr_e('Close', 'redrock'); ?>"
                            >Menu</button>
<?php
                            wp_nav_menu(array(
                                'theme_location' => 'header',
                                'menu_id'        => 'header-menu'
                            ));
?>
                        </nav>
<?php
                    }
?>
                </div>
            </header>
<?php
                if (advads_can_display_ads()):
                    $theAd = get_ad_placement('before-content');
                    if (!defined("HIDE-THIS-AD")):
?>
                        <div class="paying-wages before-content">
                            <?php echo $theAd; ?>
                        </div>
<?php
                    endif;
                endif;
?>
            <div id="content" class="site-content clear">
                <div class="col-width">
