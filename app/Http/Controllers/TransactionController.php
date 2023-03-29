<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends GenericController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($merchant_id)
    {
        $txs = Transaction::where('merchant_code', $merchant_id)->with('merchant')->get();
        if($txs->count()>0){
            return $this->respondJson(200, 'success', true, $txs);
        }
        return $this->respondJson(404, 'not_found', false);
    }

    /**
     * Store the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionStoreRequest $request)
    {
        // store transaction data
        $tx = new Transaction;
        $tx->token = $request->token;
        $tx->transaction_type = $request->transaction_type;
        $tx->transaction_status = $request->transaction_status;
        $tx->merchant_code = $request->merchant_code;
        $tx->amount = $request->amount;
        $tx->transaction_currency = $request->transaction_currency;
        $tx->transaction_amount = $request->transaction_amount;
        $tx->auth_code = $request->auth_code;
        $tx->save();

        // fire webhook event
        $this->triggerWebhookEvent($tx);

        // return response
        return $this->respondJson(200, 'success', true, $tx);
    }
}
