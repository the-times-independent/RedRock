<?php
if (!isset($searchPrefill)) {
    $searchPrefill = get_search_query();
}
?>

<form
    role="search"
    method="get"
    class="search-form"
    action="<?php echo home_url( '/' ); ?>"
>
    <label>
        <span class="screen-reader-text">Search</span>
        <input
            placeholder="Search"
            type="search"
            class="search-field"
            value="<?php echo $searchPrefill ?>"
            name="s"
        />
    </label>
    <input
        value="Go"
        type="submit"
        class="search-submit"
    />
</form>