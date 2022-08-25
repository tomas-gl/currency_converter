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
        $currencyPairs = CurrencyPair::all();
        foreach($currencyPairs as $key=>$currencyPair){
            if($currencyPair->first_currency_id && $currencyPair->second_currency_id)
            $currencyPair['first_currency_iso_code'] = Currency::where("id", $currencyPair->first_currency_id)->first()->iso_code; 
            $currencyPair['second_currency_iso_code'] = Currency::where("id", $currencyPair->second_currency_id)->first()->iso_code; 
            // $data['products'][$key]['categorie'] = Category::where("id", $product->category_id)->first()->name; 
        }
        return response()->json($currencyPairs);
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
        $currencyPair = new CurrencyPair();
        $currencyPair->first_currency_id = $request->firstCurrencyId;
        $currencyPair->second_currency_id = $request->secondCurrencyId;
        $currencyPair->conversion_rate = $request->conversionRate;
        $currencyPair->save();
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
    public function getCurrencyPair($id)
    {
        $currencyPair = CurrencyPair::find($id); 
        return response()->json($currencyPair);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCurrencyPair(Request $request, $id)
    {
        $currencyPair = CurrencyPair::where('id', $id)->first();
        $currencyPair->first_currency_id = $request->firstCurrencyId;
        $currencyPair->second_currency_id = $request->secondCurrencyId;
        $currencyPair->conversion_rate = $request->conversionRate;
        $currencyPair->save();
        return response()->json([
            'message' => 'Paire de devises mise à jour !',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCurrencyPair($id)
    {
        $currencyPair = CurrencyPair::find($id);
        if($currencyPair){
            $currencyPair->delete();
            return response()->json([
                'message' => 'Paire de devises supprimée !',
                'code' => 200
            ]);
        } else{
            return response()->json([
                'message' => "Paire de devises de l'$id n'existe pas",
            ]);
        }
    }
}
