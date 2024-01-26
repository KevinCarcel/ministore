<?php

namespace App\Service;

use App\Repository\NavRepository;

class NavService{
    private $navRepository;

    public function __construct(NavRepository $navRepository)
    {
        $this->navRepository = $navRepository;
    }

    public function getNavItems()
    {
        return $this->navRepository->findAll();
    }
}
?>