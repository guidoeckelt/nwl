<?php

namespace FrontEndBundle\Controller;

use nwlBundle\Entity\WhiteListRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="whitelist-request.login")
     * @return Response
     * @internal param Request $request
     */
    public function loginAction()
    {
        return $this->render('FrontEndBundle:Default:login.html.twig');
    }

    /**
     * @Route("/whitelist-request/{username}", name="whitelist-request.list")
     * @param string $username
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($username)
    {
        $userService = $this->get('nwl.user');
        $user = $userService->getById($username);

        $params = array('username' => $username);
        $template = $userService->getTemplate($user);
        return $this->render($template, $params);
    }

    /**
     * @Route("/whitelist-request/{username}/create", name="whitelist-request.form")
     * @param Request $request
     * @param $username
     * @return Response
     */
    public function createFormAction(Request $request, $username)
    {
        $givenUrl = $request->request->get('url');
        $givenUser = $request->request->get('user');
        $params = array('username' => $username, 'url' => $givenUrl, 'user'=>$givenUser);
        return $this->render('FrontEndBundle:Default:requestform.html.twig', $params);
    }


}
