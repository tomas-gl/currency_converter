<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\CurrencyPair;
use App\Models\Currency;
use App\Models\User;

class CurrencyConverterController extends Controller
{

    /**
     * Login a user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json(['auth_user' => Auth::user(), 200]);
        }

        throw ValidationException::withMessages([
            'email' => ['L\'adresse mail ou le mot de passe sont incorrects']
        ]);
    }

    /**
     * Ping to server.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServerStatus()
    {
        $status = "Service en marche";
        return response()->json($status);
    }

    /**
     * Display a listing of the currency pairs.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrencyPairsList()
    {
        $currencyPairs = CurrencyPair::all();
        foreach($currencyPairs as $key=>$currencyPair){
            if($currencyPair->first_currency_id && $currencyPair->second_currency_id)
            $currencyPair['first_currency_iso_code'] = Currency::where("id", $currencyPair->first_currency_id)->first()->iso_code; 
            $currencyPair['second_currency_iso_code'] = Currency::where("id", $currencyPair->second_currency_id)->first()->iso_code; 
            $currencyPair['first_currency_name'] = Currency::where("id", $currencyPair->first_currency_id)->first()->currency_name; 
            $currencyPair['second_currency_name'] = Currency::where("id", $currencyPair->second_currency_id)->first()->currency_name; 
        }
        return response()->json($currencyPairs);
    }

    /**
     * Display a listing of the currencies.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrencies()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    /**
     * Store a newly created currencies pair in storage.
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
        $currencyPair->conversion_request = 0;
        $currencyPair->save();
        return response()->json([
            'message' => 'Paire de devises cr???? !',
            'code' => 200
        ]);
    }

    /**
     * Store a newly created currency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCurrency(Request $request)
    {
        $currency = new Currency();
        $currency->currency_name = $request->currencyName;
        $currency->iso_code = $request->isoCode;
        $currency->save();
        return response()->json([
            'message' => 'Devise cr???? !',
            'code' => 200
        ]);
    }

    /**
     * Display a currencies pair.
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
     * Update the specified currencies pair in storage.
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
            'message' => 'Paire de devises mise ?? jour !',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified currencies pair from storage.
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
                'message' => 'Paire de devises supprim??e !',
                'code' => 200
            ]);
        } else{
            return response()->json([
                'message' => "Paire de devises de l'$id n'existe pas",
            ]);
        }
    }

        /**
     * Update the specified currencies pair conversion request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCurrencyPairCount(Request $request, $id)
    {
        $currencyPair = CurrencyPair::where('id', $id)->first();
        $currencyPair->conversion_request = $request->conversionRequest;
        $currencyPair->save();
        return response()->json([
            'message' => 'Nombre de requ??te pour la paire de devises mise ?? jour !',
            'code' => 200
        ]);
    }
}
