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
        foreach($this->getBands() as $_band){
            if($_band['id'] == $id){
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

    public function getBandsByGender($gender){
        $bands = [];

        foreach($this->getBands() as $_band){
            if($_band['gender'] == $gender){
                $bands[] = $_band;
            }
        }
    }

    
}
