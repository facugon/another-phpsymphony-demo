<?php

namespace Clip\MainBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Dashboard controller.
 *
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * Show the Admin Dashboard
     *
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
