<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 15/04/2018
 * Time: 11:37
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ToolsController extends Controller
{

    /**
     * @param int $count
     * @param int $countPerPage
     * @param int $currentPage
     * @param string $routeName
     * @param string $paramUrl
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paginationAction(int $count, int $countPerPage, int $currentPage, string $routeName, string $paramUrl = 'page'): Response
    {
        return $this->render('tools/pagination.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'count' => $count,
            'countPerPage' => $countPerPage,
            'currentPage' => $currentPage,
            'routeName' => $routeName,
            'paramUrl' => $paramUrl,
        ]);
    }
}