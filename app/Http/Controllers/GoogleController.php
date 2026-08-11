<?php

namespace App\Http\Controllers;

use Google\Client;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    private function getGoogleClient(): Client
    {
        $client = new Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $client->addScope(\Google\Service\Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }

    public function connect()
    {
        $client = $this->getGoogleClient();

        return redirect()->away(
            $client->createAuthUrl()
        );
    }

    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()
                ->route('booking.create')
                ->withErrors([
                    'google' => 'Google authentication was cancelled or failed.'
                ]);
        }

        $client = $this->getGoogleClient();

        $token = $client->fetchAccessTokenWithAuthCode(
            $request->code
        );

        if (isset($token['error'])) {
            return redirect()
                ->route('booking.create')
                ->withErrors([
                    'google' => 'Google authentication failed.'
                ]);
        }

        session([
            'google_token' => $token,
        ]);

        return redirect()
            ->route('booking.create')
            ->with('status', 'Google Calendar connected successfully.');
    }
}