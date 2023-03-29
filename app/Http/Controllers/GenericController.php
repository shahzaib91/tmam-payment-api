<?php

namespace App\Http\Controllers;

use App\Transaction;

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
            // ToDo with the webhook logic
        }
    }
}
