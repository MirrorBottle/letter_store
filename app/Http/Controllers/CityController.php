<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getCities()
    {
        $cities = City::all();
        foreach ($cities as $city) {
            $city->total_mails = count(Mail::where('city_id', $city->id)->get());
        }
        return $cities;
    }
    public function index()
    {
        $cities = $this->getCities();
        return view('city.index', compact('cities'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->name;
        $city->slug = Str::slug($request->name);
        $city->save();
        $cities = $this->getCities();
        return view('city.index', compact('cities'))->with('success', 'Kabupaten/Kota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
