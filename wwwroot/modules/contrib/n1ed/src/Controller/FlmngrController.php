<?php

namespace Drupal\n1ed\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for Flmngr file manager.
 */
class FlmngrController extends ControllerBase
{

    public function flmngr()
    {

        if (\Drupal::currentUser()->isAnonymous()) {
            throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }

        require_once(\Drupal::service('file_system')->realpath(drupal_get_path('module', 'n1ed') . '/flmngr/flmngr.php'));
        $response = new \Symfony\Component\HttpFoundation\Response();
        return $response;
    }
}