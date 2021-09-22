<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\View\View;
use Smarty;

class DemoController extends Controller {
    protected $zeit;

    public function __construct() {
        $this->zeit = date('H:i:s');
    }

    /**
     * View-Demo: keine View: Controller erzeugt HTML-Output direkt
     * in der Action-Methode
     */
    public function manual(Request $req) {
        echo <<<EOT
<html>
<h1>Hello, World!</h1>
<p>Es ist genau {$this->zeit}.</p>
</html>
EOT;
    }

    public function jsonView(Request $req) {
        // Content-Type-Header muss gesetzt werden:
        header('Content-Type: application/json');
        // JSON-Daten ausgeben:
        echo json_encode([
            'route' => $req->urlRoute,
            'params' => $req->getParams(),
        ]);
    }

    /**
     * View-Demo: eigene View-Klasse, rendert ein PHP-Template
     */
    public function ownView(Request $req) {
        $view = new View('default-demo.html');
        $view->assign('route', $req->urlRoute);
        $view->assign('params', $req->getParams());
        $view->render();
    }

    /**
     * View-Demo: View wird von Template-Engine 'Smarty' erzeugt
     *
     * Smarty kann mit composer installiert werden:
     *
     * composer require smarty/smarty
     */
    public function smartyView(Request $req) {
        $view = new Smarty();
        $view->setTemplateDir(__DIR__ . '/../../views/');
        $view->assign('route', $req->urlRoute);
        $view->assign('params', $req->getParams());
        $view->display('smarty-demo.html');
    }
}
