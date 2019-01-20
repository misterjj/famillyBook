<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use AppBundle\Repository\ProfileRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/profile",)
 */
class ProfileController extends Controller
{
    /**
     * @Route("/create", name="profileCreate")
     */
    public function createAction(Request $request)
    {
        return $this->render('profile/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/search", name="profileSearch")
     */
    public function searchAction(Request $request)
    {
        /** @var ProfileRepository $profileRepository */
        $profileRepository = $this->getDoctrine()
            ->getRepository(Profile::class);

        $profiles = $profileRepository->findAllNotAssign();

        return $this->render('profile/search.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'profiles' => $profiles
        ]);
    }

    /**
     * @Route("/save", name="profileSave")
     */
    public function SaveAction(Request $request)
    {
        $profile = new Profile();

        $profile->setName($request->get('name'));
        $profile->setNickname($request->get('nickname'));
        if ($birthday = $request->get('birthday')) {
            $profile->setBirthday(\DateTime::createFromFormat('d/m/Y', $birthday));
            if (!empty($request->get('birthdayCity'))) {
                $profile->setBirthdayCity($request->get('birthdayCity'));
                $profile->setBirthdayLat($request->get('birthdayLat') ?: null);
                $profile->setBirthdayLong($request->get('birthdayLong') ?: null);
            }
        }
        if ($deathday = $request->get('deathday')) {
            $profile->setDeathday(\DateTime::createFromFormat('d/m/Y', $deathday));
            if (!empty($request->get('deathdayCity'))) {
                $profile->setDeathdayCity($request->get('deathdayCity'));
                $profile->setDeathdayLat($request->get('deathdayLat'));
                $profile->setDeathdayLong($request->get('deathdayLong'));
            }
        }
        if ($baptismday = $request->get('baptismday')) {
            $profile->setBaptismday(\DateTime::createFromFormat('d/m/Y', $baptismday));
            if (!empty($request->get('baptismdayCity'))) {
                $profile->setBaptismdayCity($request->get('baptismdayCity'));
                $profile->setBaptismdayLat($request->get('baptismdayLat'));
                $profile->setBaptismdayLong($request->get('baptismdayLong'));
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($profile);
        $em->flush();

        if ($profile->getId() && $picture = $request->get('picture')) {
            $folderPath = $this->container->getParameter('path_to_data') . DIRECTORY_SEPARATOR .
                $this->container->getParameter('picture_folder_name') . DIRECTORY_SEPARATOR .
                $this->container->getParameter('user_picture_folder_name');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            $image_parts = explode(";base64,", $picture);
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . DIRECTORY_SEPARATOR . $profile-> getId() . '.jpg';
            file_put_contents($file, $image_base64);
        }

        // replace this example code with whatever you need
        return $this->render('profile/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/link/{profileid}", name="profileLink", requirements={"profileid"="\d+"})
     */
    public function linkAction(Request $request)
    {
        /** @var ProfileRepository $profileRepository */
        $profileRepository = $this->getDoctrine()
            ->getRepository(Profile::class);

        $profileId = $request->get('profileid');
        /** @var Profile $profile */
        $profile = $profileRepository->find($profileId);

        /** @var User $user */
        $user = $this->getUser();
        if (is_null($user->getProfile())) {
            $user->setProfile($profile);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }
}
