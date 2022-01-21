<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use \DateTimeImmutable as dateImmut;

/** @ORM\Entity */
final class Journal extends Document {

    /**
     * @ORM\Column(type="date")
     */
    private dateImmut $date_parution;

    public function __construct(string $title, dateImmut $d)
    {
        parent::__construct($title);
        $this->date_parution = $d;
    }

    public function getDateParution() : dateImmut
    {
        return $this->date_parution;
    }

    public function setDateParution(dateImmut $date_parution) : self
    {
        $this->name = $date_parution;

        return $this;

    }
}
