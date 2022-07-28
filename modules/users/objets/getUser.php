<?php
Class GetUser {
  public function getUserCurrentPage($premier, $parPage, $valide) {
    $select = "SELECT `idUser`, `login`, `role`, `dateCreation`, `valide` FROM `users` WHERE `valide`  = :valide ORDER BY `login` LIMIT {$premier}, {$parPage}";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    $readUsersPage = new RCUD($select, $param);
    return $readUsersPage->READ();
  }
}
