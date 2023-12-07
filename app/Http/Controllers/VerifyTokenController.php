<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyTokenController extends Controller
{
    public function verifyToken(Request $request)
    {
        try {
            $verificationToken = "GFDA982394UKDFS23RC3983NBCBNLKSNZS98TR4384390TNBSI84Z";
            $requestToken = $request->hub_verify_token;
            $challenge = $request->hub_challenge;

            if ($challenge !== null && $requestToken !== null && $verificationToken === $requestToken) {
                return response($challenge);
            } else {
                return response()->noContent('400');
            }
        } catch (\Exception $e) {
            return response()->noContent('400');
        }
    }
}
