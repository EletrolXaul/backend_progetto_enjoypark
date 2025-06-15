<?php

namespace App\Http\Controllers;

use App\Models\MockCreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MockCreditCardController extends Controller
{
    public function adminIndex()
    {
        try {
            $creditCards = MockCreditCard::orderBy('created_at', 'desc')
                ->get()
                ->map(function ($card) {
                    return [
                        'id' => $card->id,
                        'user_name' => $card->name,
                        'user_email' => 'user@example.com', // Placeholder
                        'card_last_four' => substr($card->number, -4),
                        'card_brand' => $card->type,
                        'card_type' => 'credit',
                        'expiry_month' => (int)substr($card->expiry, 0, 2),
                        'expiry_year' => (int)("20" . substr($card->expiry, 3, 2)),
                        'status' => $card->result === 'success' ? 'active' : 'blocked',
                        'is_default' => false,
                        'total_transactions' => 0,
                        'total_amount' => 0,
                        'last_used' => null,
                        'created_at' => $card->created_at,
                    ];
                });
            return response()->json([
                'success' => true,
                'data' => $creditCards
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel caricamento delle carte di credito'
            ], 500);
        }
    }

    public function show($id)
    {
        $mockCreditCard = MockCreditCard::find($id);
        if (!$mockCreditCard) {
            return response()->json(['message' => 'Carta di credito mock non trovata'], 404);
        }
        return response()->json($mockCreditCard);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|string|max:19|unique:mock_credit_cards',
            'name' => 'required|string|max:255',
            'expiry' => 'required|string|max:5',
            'cvv' => 'required|string|max:4',
            'type' => 'required|string|in:visa,mastercard,amex,discover',
            'result' => 'required|string|in:success,declined,insufficient_funds,invalid_card',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mockCreditCard = MockCreditCard::create($request->all());

        return response()->json(['success' => true, 'mockCreditCard' => $mockCreditCard]);
    }

    public function update(Request $request, $id)
    {
        $mockCreditCard = MockCreditCard::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'number' => 'sometimes|string|max:19|unique:mock_credit_cards,number,' . $id,
            'name' => 'sometimes|string|max:255',
            'expiry' => 'sometimes|string|max:5',
            'cvv' => 'sometimes|string|max:4',
            'type' => 'sometimes|string|in:visa,mastercard,amex,discover',
            'result' => 'sometimes|string|in:success,declined,insufficient_funds,invalid_card',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mockCreditCard->update($request->all());

        return response()->json(['success' => true, 'mockCreditCard' => $mockCreditCard]);
    }

    public function destroy($id)
    {
        $mockCreditCard = MockCreditCard::findOrFail($id);
        $mockCreditCard->delete();

        return response()->json(['success' => true]);
    }
}