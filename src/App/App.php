<?php

namespace Anax\App;

/**
 * An App class to wrap the resources of the framework.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
        exit;
    }



    /**
     * Render a standard web page using a specific layout.
     */
    public function renderPage($data = [], $status = 200)
    {
        $data["stylesheets"] = [
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css",
            "lib/css/font-awesome.min.css",
            "css/style.css"
        ];
        $data["title"] = isset($data["title"]) ? "Anax | " . $data["title"] : "Anax";

        $data["scripts"] = [
            "https://code.jquery.com/jquery-3.2.1.slim.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js",
        ];

        // Add common header, navbar and footer
        // $this->view->add("common/header", [], "header");
        $this->view->add("common/navbar", [], "navbar");
        $this->view->add("common/footer", [], "footer");

        // Add layout, render it, add to response and send.
        $this->view->add("layout/layout", $data, "layout");
        $body = $this->view->renderBuffered("layout");
        $this->response->setBody($body)
                       ->send($status);
        exit;
    }
}
