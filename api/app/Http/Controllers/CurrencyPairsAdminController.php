<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencyPair;
use App\Models\Currency;

class CurrencyPairsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyPairsList()
    {
        $currency_pairs = CurrencyPair::all();
        foreach($currency_pairs as $key=>$currency_pair){
            if($currency_pair->first_currency_id && $currency_pair->second_currency_id)
            $currency_pair['first_currency_iso_code'] = Currency::where("id", $currency_pair->first_currency_id)->first()->iso_code; 
            $currency_pair['second_currency_iso_code'] = Currency::where("id", $currency_pair->second_currency_id)->first()->iso_code; 
            // $data['products'][$key]['categorie'] = Category::where("id", $product->category_id)->first()->name; 
        }
        return response()->json($currency_pairs);
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
    public function getCurrencies()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCurrencyPair(Request $request)
    {
        $currency_pair = new CurrencyPair();
        $currency_pair->first_currency_id = $request->first_currency_id;
        $currency_pair->second_currency_id = $request->second_currency_id;
        $currency_pair->conversion_rate = $request->conversion_rate;
        $currency_pair->save();
        return response()->json([
            'message' => 'Paire de devises créé !',
            'code' => 200
        ]);
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
