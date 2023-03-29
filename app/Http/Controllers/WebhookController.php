<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebhookStateRequest;
use App\Http\Requests\WebhookSubscribeRequest;
use App\User;

class WebhookController extends GenericController
{
    /**
     * Function helps in subscribing webhook
     *
     * @param WebhookSubscribeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(WebhookSubscribeRequest $request)
    {
        $user = User::find($request->merchant_id);
        $user->webhook_url = $request->webhook_url;
        $user->webhook_state = 'e'; // always set webhook state enabled when added
        $user->save();

        return $this->respondJson(200, 'success', true, $user);
    }

    /**
     * Function helps in subscribing webhook
     *
     * @param WebhookStateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function state(WebhookStateRequest $request)
    {
        $user = User::find($request->merchant_id);
        $user->webhook_state = $request->webhook_state;
        $user->save();
        return $this->respondJson(200, 'success', true, $user);
    }


}
