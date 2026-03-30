<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware EnsureCustomer
 *
 * Ce middleware permet de vérifier que l'utilisateur connecté
 * n'est pas un administrateur.
 *
 * Si l'utilisateur est un admin, il est redirigé vers /admin.
 * Sinon, il peut continuer sa requête normalement.
 */
class EnsureCustomer
{
    /**
     * Gère la requête entrante.
     *
     * @param Request $request  La requête HTTP en cours
     * @param Closure $next     La prochaine étape dans le pipeline (middleware suivant ou contrôleur)
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur connecté existe et s'il est admin
        // "?->" permet d'éviter une erreur si aucun utilisateur n'est connecté
        if ($request->user()?->isAdmin()) {
            // Si c'est un admin, on le redirige vers le tableau de bord admin
            return redirect('/admin');
        }

        // Sinon, on laisse passer la requête vers la suite de l'application
        return $next($request);
    }
}
