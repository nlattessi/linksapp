<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

abstract class Repository
{
    /**
     * @var PDO
     */
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
