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
        $whitelistRequest = new WhiteListRequest();
        $domain = $request->request->get('domain');
        $reason = $request->request->get('reason');
        $givenUrl = $request->request->get('url');
        $requestExists = null;

        if ($domain != null && $reason != null) {
            $userService = $this->get('nwl.user');
            $whitelistService = $this->get('nwl.whitelist');

            $user = $userService->getById($username);
            $target = $whitelistService->getOrCreateTargetByDomain($domain);

            $whitelistRequest->setUser($user);
            $whitelistRequest->setWhitelistTarget($target);
            $whitelistRequest->setReason($reason);
            $whitelistRequest->setCreated(new \DateTime());


            $allUserRequests = $whitelistService->findWhiteListRequestsByUsername($username);

            foreach ($allUserRequests as $curWhitelistRequest) {
                if($whitelistRequest->getWhitelistTarget() == $curWhitelistRequest->getWhitelistTarget()) {
                    $requestExists = "true";
                }
            }

            if($requestExists != "true"){
                $whitelistService->createWhiteListRequest($whitelistRequest);
            }

            $params = array('username' => $username);
            $template = $userService->getTemplate($user);
            return $this->render($template, $params);
        }

        return $this->render('FrontEndBundle:Default:requestform.html.twig', array('username' => $username, 'url' => $givenUrl));
    }


}
