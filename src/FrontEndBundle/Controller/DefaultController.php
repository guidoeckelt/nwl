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
    public function listAction($username){
        $params = array('username'=>$username);
        $template = null ;
        if($username != null){ //check if user or admin
            $template = 'FrontEndBundle:Default:adminList.html.twig';
        }else{
            $template = 'FrontEndBundle:Default:userList.html.twig';
        }

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
        $whitelistRequest = new WhiteListRequest();
        $apikey = $request->request->get('apikey');
        $domain = $request->request->get('domain');
        $reason = $request->request->get('reason');

        var_dump($apikey);

        if ($apikey != null) {
            $userService = $this->get('nwl.user');
            $whitelistService = $this->get('nwl.whitelist');

            $currentUser = $userService->getUser($apikey);

            $target = $whitelistService->getOrCreateTargetByDomain($domain);

            $whitelistRequest->setUser($currentUser);
            $whitelistRequest->setWhitelistTarget($target);
            $whitelistRequest->setReason($reason);
            $whitelistRequest->setCreated(new \DateTime());
            $whitelistService->createWhiteListRequest($whitelistRequest);
            return $this->render('FrontEndBundle:Default:userList.html.twig', array('username' => $username));
        }

        return $this->render('FrontEndBundle:Default:requestform.html.twig', array('username' => $username));
    }


}
