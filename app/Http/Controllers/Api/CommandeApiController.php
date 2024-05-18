<?php

namespace App\Http\Controllers\Api;

use App\Enum\PaiementEnum;
use App\Enum\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommandeResource;
use App\Models\Commande;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class CommandeApiController extends Controller
{


    public function index()
    {
        return CommandeResource::collection(Commande::all());
    }

    public function withStudents()
    {
        return CommandeResource ::collection(Commande::with('student')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statut' => ['required', Rule::enum(StatusEnum::class)],
            'prix' => ['required', 'integer', 'min:5'],
            'paiement' => ['required', Rule::enum(PaiementEnum::class)],
            'date_commande' => ['required'],
            'date_livraison' => ['required'],
            'note' => ['required'],
            'student_id' => 'exists:students,id'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->errors()->first()
            ], 422);
        }

        try {
            $commande = Commande::create($request->all());
        } catch (Throwable $th) {
            return response([
                'data' => [
                    'message' => "Oups, une erreur est survenue!",
                    'cause' => $th->getMessage()
                ]
            ]);
        }

        return new CommandeResource($commande);
    }

    public function show($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }

        return new CommandeResource($commande);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'statut' => ['required', Rule::enum(StatusEnum::class)],
            'prix' => ['required', 'integer', 'min:5'],
            'paiement' => ['required', Rule::enum(PaiementEnum::class)],
            'date_commande' => ['required'],
            'date_livraison' => ['required'],
            'note' => ['required', 'integer', 'max:5'],
            'student_id' => 'exists:students,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()->toArray()
            ], 422);
        }
        $commande = Commande::find($id);

        try {
            $commande->update($request->all());
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => "Oups, une erreur est survenue lors de la mise à jour de la commande!",
                'cause' => $th->getMessage()
            ], 500);
        }

        return new CommandeResource($commande);
    }

    public function destroy($id)
    {
        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json([
                'statut' => 404,
                'message' => 'Commande not found'
            ], 404);
        }

        $commande->delete();
        return response()->json([
            'statut' => 200,
            'message' => 'Commande deleted Successfully'
        ], 200);
    }
}
