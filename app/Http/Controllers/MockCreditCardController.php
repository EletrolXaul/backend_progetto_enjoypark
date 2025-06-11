<?php

namespace App\Http\Controllers;

use App\Models\MockCreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MockCreditCardController extends Controller
{
    public function index()
    {
        return response()->json(MockCreditCard::all(), 200);
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