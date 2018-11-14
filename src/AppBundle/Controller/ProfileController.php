<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profile;
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
        // replace this example code with whatever you need
        return $this->render('profile/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
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
                $profile->setBirthdayLat($request->get('birthdayLat'));
                $profile->setBirthdayLong($request->get('birthdayLong'));
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

        if ($picture = $request->get('picture')) {
            $folderPath = $this->container->getParameter('path_to_data') . DIRECTORY_SEPARATOR . $this->container->getParameter('picture_folder_name');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            $image_parts = explode(";base64,", $picture);
            dump($image_parts);
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . DIRECTORY_SEPARATOR . $profile-> getId() . '.png';
            file_put_contents($file, $image_base64);
        }

        // replace this example code with whatever you need
        return $this->render('profile/create.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
