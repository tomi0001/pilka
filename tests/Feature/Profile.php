<?php

use App\Http\Services\Profile as ProfileService;

// tests/Feature/OrderWorkflowTest.php
test('Order Workflow', function () {
    $Profile = new ProfileService;
    $Profile->sumMForAllGroup();

});
