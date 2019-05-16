<?php

namespace Towersystems\Core\Command;

class CreateDatabase {

    /**
     * @var string
     */
    protected $name;

    public function __construct(
        $name
    ) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}
