<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Services\Profile as ProfileService;
// tests/Feature/OrderWorkflowTest.php
test('Order Workflow', function () {
    $Profile = new ProfileService();
    $Profile->sumMForAllGroup();

});
