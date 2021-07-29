<?php 

namespace Controller;

use Dao\CompetenceDao;

class CompetenceController extends BaseController {
    
    public function deleteCompetence($parametres) {
        $dao = new CompetenceDao;
        $dao->deleteById($parametres[0]);
    }
}