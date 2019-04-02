<?php
    if (!isset($searchPrefill)) {
        $searchPrefill = get_search_query();
    }
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
            value="<?php echo $searchPrefill ?>" name="s" />
    </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Go', 'submit search button' ) ?>" />
</form>