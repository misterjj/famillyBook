<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function idbarAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $redirect = "";
        $id = "";
        $name = "";
        if (is_null($user->getProfile()) && !in_array($request->get("_route"), ["profileSearch", "profileCreate"])) {
            $redirect = $this->generateUrl("profileSearch");
        } else if(!is_null($user->getProfile())) {
            $id = $user->getProfile()->getId();
            $name = $user->getProfile()->getNickname() ?: $user->getProfile()->getName();
        }

        return $this->render('modules/idbar.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'redirect' => $redirect,
            'name'  => $name,
            'id'  => $id,
        ]);
    }
}
