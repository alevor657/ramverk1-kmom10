<?php

namespace Alvo\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Page\PageRenderInterface;

/**
 * A default page rendering class.
 */
class PageRender implements PageRenderInterface, InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * Render a standard web page using a specific layout.
     *
     * @param array   $data   variables to expose to layout view.
     * @param integer $status code to use when delivering the result.
     *
     * @return void
     *
     * @SuppressWarnings("exit")
     */
    public function renderPage($data = [], $status = 200)
    {
        $data["stylesheets"] = [
            // "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css",
            "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css",
            "lib/css/font-awesome.min.css",
            "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css",
            "css/style.css",
        ];

        $data["title"] = isset($data["title"]) ? "Anax | " . $data["title"] : "Anax";

        $data["scripts"] = [
            "https://code.jquery.com/jquery-3.2.1.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js",
        ];

        // Add common header, navbar and footer
        $view = $this->di->get("view");

        $user = $this->di->get("user")->getUser();
        $userId = $this->di->get("session")->get('userId', null);

        $view->add("common/navbar", ["user" => $user, "userId" => $userId], "navbar");
        $view->add("common/footer", [], "footer");

        // Add layout, render it, add to response and send.
        $view->add("layout/layout", $data, "layout");
        $body = $view->renderBuffered("layout");
        $this->di->get("response")->setBody($body)
                       ->send($status);
        exit;
    }
}
