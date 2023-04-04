<?php

namespace App\Http\Controllers;

use App\Transaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GenericController extends Controller
{
    /**
     * Function to respond json
     *
     * @param integer $numericCode Http status code
     * @param string $message Human readable message
     * @param bool $status True or False
     * @param array $nvpArgs (Optional) Additional response arguments
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondJson($numericCode, $message, $status, $nvpArgs = null )
    {
        return response()->json(['status' => $status, 'message' => $message, 'code' => $numericCode, "data" => $nvpArgs]);
    }

    /**
     * Function to sync webhook data with the expense system
     *
     * @param Transaction $payload Transaction data as json payload
     * @return void
     */
    protected function triggerWebhookEvent(Transaction $tx)
    {
        if($tx->merchant->webhook_state === 'e' && $tx->merchant->webhook_url != '') {

            // prepare payload
            $payload = [
                "transaction_id" => $tx->transaction_id,
                "token" => $tx->token,
                "transaction_type" => $tx->transaction_type,
                "transaction_status" => $tx->transaction_status,
                "merchant_code" => $tx->merchant_code,
                "merchant_name" => $tx->merchant->name,
                "merchant_country" =>$tx->merchant->country,
                "merchant_currency" => $tx->merchant->currency,
                "amount" => $tx->amount,
                "transaction_currency" => $tx->transaction_currency,
                "transaction_amount" => $tx->transaction_amount,
                "auth_code" => $tx->auth_code,
                "transaction_datetime" => $tx->created_at,
            ];

            try {

                // make and post to client
                $client = new Client();
                $response = $client->post(
                    $tx->merchant->webhook_url, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                            'X-Signature' => hash_hmac('sha256', json_encode($payload), $tx->merchant->webhook_secret),
                        ],
                        'json' => $payload
                    ]
                );

                // display response
                // For debugging purpose only
                // echo $response->getBody();

                // ToDo with the response here
                // Following ways:
                // 1- Parse and read response and set flag with the record
                // 2- Logging webhook response data

            } catch(RequestException $ex) {
                dd($ex->getMessage());
            }

        }
    }
}
