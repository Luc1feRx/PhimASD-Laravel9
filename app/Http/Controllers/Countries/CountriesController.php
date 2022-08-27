<?php

namespace App\Http\Controllers\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Repositories\Eloquent\CountryRepository;
use Illuminate\Http\Request;

class CountriesController extends Controller
{

    protected $countryRepository;
    public function __construct(CountryRepository $CountryRepository)
    {
        $this->middleware('auth');
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $list = $this->countryRepository->getPaginated(10);
        return view('pages.countries.index',[
            'title' => 'Countries List',
            'countries' => $list
        ]);
    }

    public function getAllCountries(){
        $countries = $this->countryRepository->getPaginated(10);
        return CountryResource::collection($countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:countries|max:255|min:2',
            'slug' => 'required|max:255|min:2',
        ]);

        if($validatedData){
            $this->countryRepository->store($request->all());
            return response()->json([
                'message' => 'Your country has been added successfully',
                'code' => 200
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        if($country){
            return response()->json([
                'country' => new CountryResource($country),
            ]);
        }else{
            return response()->json([
                'message' => 'Country does not exist',
                'code' => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:countries|max:255|min:2',
            'slug' => 'required|max:255|min:2',
        ]);

        if($validatedData){
            $country_update = $this->countryRepository->update($country->id, $request->all());
            if($country_update){
                return response()->json([
                    'message' => 'Your country has been updated successfully',
                    'code' => 200
                ]);
            }
            return response()->json([
                'message' => 'Your country has been updated failed',
                'code' => 400
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $result = $this->countryRepository->delete($country->id);
        if($result){
            return response()->json([
                'message' => 'Your country has been deleted successfully'
            ]);
        }else{
            return response()->json([
                'message' => 'Your country has been deleted failed'
            ]);
        }
    }
}
