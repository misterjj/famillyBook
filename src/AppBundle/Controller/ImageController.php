<?php

namespace AppBundle\Controller;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    const TYPE_USER = 'user';
    const USER_IDBAR_W = 24;
    const USER_IDBAR_H = 24;

    /**
     * @Route("/image/{type}/{id}.w{width}.h{height}.jpg",
     *      name="imageResized",
     *      requirements={"id"="\d+", "height" = "[^\.]+", "width" = "[^\.]+"}
     *     )
     */
    public function imageResizedAction(Request $request)
    {
        return $this->image(
            $request->get('type'),
            $request->get('id'),
            $request->get('width'),
            $request->get('height')
        );
    }

    /**
     * @Route("/image/{type}/{id}.jpg",
     *      name="image",
     *      requirements={"id"="\d+"}
     *     )
     */
    public function imageAction(Request $request)
    {
        return $this->image(
            $request->get('type'),
            $request->get('id')
        );
    }

    /**
     * @param string $type
     * @param int $id
     * @param int|null $width
     * @param int|null $height
     * @return Response
     * @throws \Exception
     */
    private function image(string $type, int $id, ?int $width = null, ?int $height = null)
    {
        $path = $this->container->getParameter('path_to_data') . DIRECTORY_SEPARATOR .
            $this->container->getParameter('picture_folder_name') . DIRECTORY_SEPARATOR;

        switch ($type) {
            case self::TYPE_USER : $path .= $this->container->getParameter('user_picture_folder_name'); break;
            default : throw new \Exception('type "' . $type . '" not implemented');
        }

        $filename = $id;
        if (!is_null($width) && !is_null($height)) {
            $filename .= ".w$width.h$height";
        }
        $filename .= ".jpg";

        $path .= DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            return $this->getResponse($path);
        } else if (
            !is_null($width) &&
            !is_null($height) &&
            file_exists(str_replace(".w$width.h$height", '', $path)) &&
            $this->checkResize($type, $width, $height)
        ) {
            $imagine = new Imagine();

            $image = $imagine->open(str_replace(".w$width.h$height", '', $path));
            $image->resize(new Box($width, $height));
            $image->save($path);
            return $this->getResponse($path);
        }

        return new Response(null, 404);
    }

    /**
     * @param string $filePath
     * @return Response
     */
    private function getResponse(string $filePath)
    {
        $response = new Response();

        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($filePath));
        $response->headers->set('Content-Disposition', 'inline; filename="' . basename($filePath) . '";');
        $response->headers->set('Content-length', filesize($filePath));

        $response->sendHeaders();
        $response->setContent(readfile($filePath));

        return $response;
    }

    private function checkResize(string $type, int $width, int $heigth)
    {
        switch ($type) {
            case self::TYPE_USER :
                return ($width === self::USER_IDBAR_W && $heigth === self::USER_IDBAR_H);
        }

        return false;
    }
}
