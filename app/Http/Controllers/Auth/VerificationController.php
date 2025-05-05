<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /**
     * Redirection après vérification.
     */
    protected string $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Affiche la page demandant la vérification.
     */
    public function notice(): View
    {
        return view('auth.verify');
    }

    /**
     * Vérifie l'email de l'utilisateur via le lien signé.
     */
    public function verify(Request $request, int $id, string $hash): RedirectResponse
    {
        $user = Auth::user();

        if (! hash_equals((string) $id, (string) $user->getKey()) ||
            ! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect($this->redirectTo)->with('verified', true);
    }

    /**
     * Renvoie l'email de vérification.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectTo);
        }

        $user->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
