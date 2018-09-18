<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_ENV') === "production" ? false : true,
        'determineRouteBeforeAppMiddleware' => true,
    ],
    'notFoundHandler' => function($c) {
        return function($request, $response) use ($c) {
            return $response->withJson(["status" => 404, "error" => TRUE, "msg" => "NOT FOUND"], 404);
        };
    },
  ];
