<?php

namespace App\Http\Controllers;

use App\Models\CurrencySetupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencySetupController extends Controller
{
    //
    public function setupCurrencyRates()
    {
        try {

            $currency_api_url = env("CURRENCY_API_URL");
            $currency_rate_apiKey = env("CURRENCY_API_KEY");
            $base_currency = env("BASE_CURRENCY");

            $response = Http::get("$currency_api_url?app_id=$currency_rate_apiKey&base=$base_currency");

            if ($response->ok()) {

                $result = json_decode($response->body());

                // $result->rates->$$currency;
                // return $result->rates->$currency;
                $currency_setup = CurrencySetupModel::find(1);
                $currency_setup->currency_rates = json_encode($result->rates);
                $currency_setup->base_currency = $base_currency;

                if ($currency_setup->save()) {
                    return response()->json([
                        'code' => '000',
                        'message' => 'Database currency rates updated successfully',
                        'data' => [
                            'base_currency' => $base_currency,
                            'rate' => $result->rates
                        ]
                    ], 200);
                } else {
                    return response()->json([
                        'code' => '500',
                        'message' => 'Failed to update database currency rates',
                        'data' => [
                            'defaultCurrency' => 'GHS',
                            'rate' => $result->rates
                        ]
                    ], 200);
                }
            } else {
                return response()->json([
                    'code' => (string) $response->status(),
                    'message' => 'Failed to update database currency rates',
                    'data' => NULL
                ], $response->status());
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }
}