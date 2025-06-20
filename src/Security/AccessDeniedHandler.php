<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Session\Session; 

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $urlGenerator;
    private $session;

    public function __construct(UrlGeneratorInterface $urlGenerator, Session  $session)
    {
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $this->session->getFlashBag()->add('danger', 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.');
        
        return new RedirectResponse($this->urlGenerator->generate('app_access_denied'));
    }
}
