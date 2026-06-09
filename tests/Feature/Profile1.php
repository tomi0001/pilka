<?php

// tests/Feature/OrderWorkflowTest.php
test('Order Workflow', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create(['price' => 100.00]);
    });

    it('kończy pełny proces zamówienia', function () {
        // Dodaj do koszyka
        $this->actingAs($this->user)
            ->post('/cart/add', [
                'product_id' => $this->product->id,
                'quantity' => 2,
            ])
            ->assertStatus(200);

        // Weryfikuj zawartość koszyka
        $cart = Cart::where('user_id', $this->user->id)->first();
        expect($cart->items)->toHaveCount(1);
        expect($cart->total)->toBe(200.00);

        // Przejdź do checkout
        $orderData = [
            'shipping_address' => '123 Testowa St',
            'billing_address' => '123 Testowa St',
            'payment_method' => 'credit_card',
            'card_token' => 'test_token_123',
        ];

        $response = $this->actingAs($this->user)
            ->post('/checkout', $orderData);

        $response->assertRedirect('/orders/confirmation');

        // Weryfikuj utworzenie zamówienia
        $order = Order::where('user_id', $this->user->id)->latest()->first();
        expect($order)->not->toBeNull();
        expect($order->total)->toBe(200.00);
        expect($order->status)->toBe('pending');

        // Weryfikuj zmniejszenie zapasów
        $this->product->refresh();
        expect($this->product->inventory)->toBe($this->product->inventory - 2);

        // Weryfikuj wyczyszczenie koszyka
        expect(Cart::where('user_id', $this->user->id)->count())->toBe(0);
    });
});
