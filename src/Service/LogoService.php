<?php

namespace App\Service;

use App\Repository\LogoRepository;

class LogoService
{
    private $logoRepository;

    public function __construct(LogoRepository $logoRepository)
    {
        $this->logoRepository = $logoRepository;
    }

    public function getLogo()
    {
        return $this->logoRepository->findOneBy([]);
    }
}
?>