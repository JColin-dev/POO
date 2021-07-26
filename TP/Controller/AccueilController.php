<?php 

namespace controller;

use Controller\BaseController;

class AccueilController extends BaseController {
    public function index() {
        $this->afficherVue();
    }

    public function nonTrouve() {
        $this->afficherVue("404");
    }
}