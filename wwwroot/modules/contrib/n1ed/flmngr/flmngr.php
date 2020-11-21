<?php

require __DIR__ . '/vendor/autoload.php';

use EdSDK\FlmngrServer\FlmngrServer;

use Drupal\Core\DrupalKernel;
use Drupal\Core\Site\Settings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

$autoloader = require_once 'autoload.php';

function authorize_access_allowed(Request $request) {
    $account = \Drupal::service('authentication')->authenticate($request);
    if ($account) {
        \Drupal::currentUser()->setAccount($account);
    }
    return Settings::get('allow_authorize_operations', TRUE) && \Drupal::currentUser()->hasPermission('administer software updates');
}

try {
    $request = Request::createFromGlobals();
    $kernel = DrupalKernel::createFromRequest($request, $autoloader, 'prod');
    //$kernel->prepareLegacyRequest($request);
}
catch (HttpExceptionInterface $e) {
    $response = new Response('', $e->getStatusCode());
    $response->prepare($request)->send();
    exit;
}

authorize_access_allowed($request);
$user = Drupal::currentUser();

if ($user->hasPermission("edit any article content")) {
    FlmngrServer::flmngrRequest(
        array(
            'dirFiles' => './sites/default/files/flmngr',
            'dirTmp'   => './sites/default/files/flmngr-tmp',
            'dirCache' => './sites/default/files/flmngr-cache',
        )
    );
} else {
    $response = new Response('', 403);
    $response->prepare($request)->send();
    exit;
}