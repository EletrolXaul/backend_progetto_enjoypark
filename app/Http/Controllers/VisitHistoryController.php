<?php

namespace App\Http\Controllers;

use App\Models\VisitHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;


class VisitHistoryController extends Controller
{
    public function index()
    {
        return response()->json(VisitHistory::all(), 200);
    }

    public function show($id)
    {
        $visitHistory = VisitHistory::find($id);
        if (!$visitHistory) {
            return response()->json(['message' => 'Cronologia visita non trovata'], 404);
        }
        return response()->json($visitHistory);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'attractions' => 'nullable|string', // Cambiato da 'required|array' a 'nullable|string'
            'rating' => 'nullable|numeric|min:1|max:5',
            'notes' => 'nullable|string',
            'duration' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Converti la stringa JSON in array se presente
        $data = $request->all();
        if (!empty($data['attractions'])) {
            try {
                $data['attractions'] = json_decode($data['attractions'], true);
            } catch (\Exception) {
                // Se non è JSON valido, mantieni come stringa
                $data['attractions'] = [$data['attractions']];
            }
        } else {
            $data['attractions'] = [];
        }

        $visitHistory = VisitHistory::create($data);

        return response()->json(['success' => true, 'visitHistory' => $visitHistory]);
    }

    public function update(Request $request, $id)
    {
        $visitHistory = VisitHistory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'visit_date' => 'sometimes|date',
            'attractions' => 'sometimes|array',
            'rating' => 'nullable|numeric|min:1|max:5',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $visitHistory->update($request->all());

        return response()->json(['success' => true, 'visitHistory' => $visitHistory]);
    }

    public function destroy($id)
    {
        $visitHistory = VisitHistory::findOrFail($id);
        $visitHistory->delete();

        return response()->json(['success' => true]);
    }
}