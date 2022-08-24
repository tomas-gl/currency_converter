<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencyPairs;
use App\Models\Currencies;

class CurrencyPairsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency_pairs = CurrencyPairs::all();
        foreach($currency_pairs as $key=>$currency_pair){
            if($currency_pair->first_currency_id)
            $first_currency_id = Currencies::where("id", $currency_pairs->first_currency_id)->first()->iso_code; 
            // $data['products'][$key]['categorie'] = Category::where("id", $product->category_id)->first()->name; 
        }
        return response()->json($first_currency_id);
        //     [
        //         'first_currency_id' => $first_currency_id,
        //         'second_currency_id' => $second_currency_id,
        //         'conversion_rate' => $conversion_rate,
        //         // 'code' => 200
        //     ]
        // );
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
        //
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
