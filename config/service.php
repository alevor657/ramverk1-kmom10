<?php
/**
 * Add and configure services and return the $app object.
 */

// Add all resources to $app
$app                 = new \Anax\App\App();
$app->request        = new \Anax\Request\Request();
$app->response       = new \Anax\Response\Response();
$app->url            = new \Anax\Url\Url();
$app->router         = new \Anax\Route\RouterInjectable();
$app->view           = new \Anax\View\ViewContainer();
$app->textfilter     = new \Anax\TextFilter\TextFilter();
$app->session        = new \Anax\Session\SessionConfigurable();
$app->db             = new \Anax\Database\DatabaseConfigure();
$app->commentsController = new \Anax\Comments\CommentsController();
$app->comments       = new \Anax\Comments\Comments();
$app->rem            = new \Anax\RemServer\RemServer();
$app->remController  = new \Anax\RemServer\RemServerController();

// Configure database
$app->db->configure('database.php');

// Configure request
$app->request->init();

// Configure router
$app->router->setApp($app);

// Configure session
$app->session->configure("session.php");

// Init REM Server
$app->rem->configure("remserver.php");
$app->rem->inject(["session" => $app->session]);

// Init comments module
// $app->comments->inject([
//     "db" => $app->db,
//     "textfilter" => $app->textfilter
// ]);

// Init controller for the REM Server
$app->remController->setApp($app);

// Init controller for the Comments module
$app->commentsController->setApp($app);

// Configure url
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Configure view
$app->view->setApp($app);
$app->view->configure("view.php");

// Return the populated $app
return $app;
