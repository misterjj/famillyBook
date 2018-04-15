<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function adminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/all-users/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="allUsers")
     */
    public function allUsersAction(Request $request)
    {
        /** @var $userManager \UserBundle\Service\UsersManager */
        $userManager = $this->container->get('fos_user.user_manager');

        // replace this example code with whatever you need
        return $this->render('admin/all_users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'page' => $request->get('page'),
            'count' => $userManager->getUserCount(),
        ]);
    }

    /**
     * @Route("/user/delete/{user}", defaults={"user" = null}, requirements={"user" = "\d+"}, name="deleteUser")
     */
    public function DeleteUserAction(Request $request)
    {
        /** @var $userManager \UserBundle\Service\UsersManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(['id' => $request->get('user')]);

        if ($user && $user->getRoles() != "ROLE_ADMIN") {
            $userManager->deleteUser($user);
        }

        return $this->redirectToRoute('allUsers');
    }

    /**
     * @param int $limit
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function usersListingAction(int $limit, int $page) {
        /** @var $userManager \UserBundle\Service\UsersManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->FindLastUser($limit,$page);

        // replace this example code with whatever you need
        return $this->render('admin/modules/users_listing.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'users' => $users,
        ]);
    }
}
