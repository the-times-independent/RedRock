<?php

namespace RedRock;

?>

<div id="paywall">
    <div class="content-width">
        <h1>You are out of free articles.</h1>
        <p>
            The good news is that you don't have to stop reading.
            Unlimited access to The-Times Independent starts at just <strong>$1 per week</strong>.
        </p>
<?php
        $subscriptionListView = new SubscriptionListView();
        $subscriptionListView->echo();
?>
    </div>
    <div id="footer-background" />
</div>
