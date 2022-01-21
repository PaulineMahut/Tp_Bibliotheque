<?php

namespace App\Interfaces;

use App\Entity\Livre;

interface UserInterface {
    public function emprunterLivre(Livre $livre);
}
