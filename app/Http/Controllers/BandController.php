<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BandController extends Controller
{
    public function getAll()
    {
        $bands = $this->getBands();
        return response()->json($bands);
    }

    public function getById($id)
    {
        $band = null;
        foreach ($this->getBands() as $_band) {
            if ($_band['id'] == $id) {
                $band = $_band;
            }
        }

        return $band ? response()->json($band) : abort(404);
    }
    public function getBands()
    {
        return [
            ['id' => 1, 'name' => 'Dream teather', 'gender' => 'progressive'],
            ['id' => 2, 'name' => 'Link Park', 'gender' => 'pop-rock'],
            ['id' => 3, 'name' => 'dio', 'gender' => 'heavy metal'],
            ['id' => 4, 'name' => 'Dream teather', 'gender' => 'heavy metal'],
        ];
    }

    public function getBandsByGender($gender)
    {
        $bands = [];

        foreach ($this->getBands() as $_band) {
            if ($_band['gender'] == $gender) {
                $bands[] = $_band;
            }
        }
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
        ]);

        // Obter a lista atual de bandas
        $bands = $this->getBands();

        // Gerar um novo ID para a banda
        $newId = count($bands) + 1;

        // Criar a nova banda
        $newBand = [
            'id' => $newId,
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
        ];

        // Adicionar a nova banda à lista
        $bands[] = $newBand;

        // Retornar a nova banda como resposta JSON
        return response()->json($newBand, 201);
    }

}
