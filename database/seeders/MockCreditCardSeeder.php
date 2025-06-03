<?php
// database/seeders/MockCreditCardSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MockCreditCard;

class MockCreditCardSeeder extends Seeder
{
    public function run()
    {
        $cards = [
            [
                'number' => '4111111111111111',
                'name' => 'Test Success',
                'expiry' => '12/25',
                'cvv' => '123',
                'type' => 'visa',
                'result' => 'success',
                'message' => 'Pagamento completato con successo',
            ],
            [
                'number' => '4000000000000002',
                'name' => 'Test Declined',
                'expiry' => '12/25',
                'cvv' => '123',
                'type' => 'visa',
                'result' => 'declined',
                'message' => 'Carta rifiutata dalla banca',
            ],
            [
                'number' => '4000000000000119',
                'name' => 'Test Insufficient',
                'expiry' => '12/25',
                'cvv' => '123',
                'type' => 'visa',
                'result' => 'insufficient_funds',
                'message' => 'Fondi insufficienti',
            ],
            [
                'number' => '4000000000000069',
                'name' => 'Test Expired',
                'expiry' => '12/20',
                'cvv' => '123',
                'type' => 'visa',
                'result' => 'expired',
                'message' => 'Carta scaduta',
            ],
            [
                'number' => '5555555555554444',
                'name' => 'Test Mastercard',
                'expiry' => '12/25',
                'cvv' => '123',
                'type' => 'mastercard',
                'result' => 'success',
                'message' => 'Pagamento completato con successo',
            ],
            [
                'number' => '378282246310005',
                'name' => 'Test Amex',
                'expiry' => '12/25',
                'cvv' => '1234',
                'type' => 'amex',
                'result' => 'success',
                'message' => 'Pagamento completato con successo',
            ],
        ];

        foreach ($cards as $card) {
            MockCreditCard::create($card);
        }
    }
}