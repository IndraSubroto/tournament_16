<?php

namespace App\Http\Controllers;

use App\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProvince()
    {
        $provinces = Province::all()
            ->pluck('name','id');
        return response()->json($provinces);
    }

	public function selectCity($id)
    {		
		$cities = DB::table("cities")
		    ->where("province_id",$id)
            ->pluck('name','id');
        return json_encode($cities);
	}
    
    public function selectDistrict($id)
    {		
		$districts = DB::table("districts")
		    ->where("city_id",$id)
            ->pluck('name','id');
        return json_encode($districts);
	}
}
