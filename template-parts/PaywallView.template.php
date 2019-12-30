<?php

namespace RedRock;

?>

<div id="paywall" class="paywall">
    <div class="content-width">
        <h1>You are out of free articles for this month.</h1>
        <p>
            The good news is that you don't have to stop reading.
            Unlimited access to The-Times Independent starts at just <strong>$1 per week</strong>.
            <br />
            The T-I is proudly owned and operated in Moab, Utah.
            A subscription to The Times-Independent supports the area's oldest, most historied journalism institution.
        </p>
<?php
        $subscriptionListView = new SubscriptionListView();
        $subscriptionListView->echo();
?>
    </div>
    <div id="footer-background" />
</div>
