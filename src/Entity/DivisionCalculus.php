<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class DivisionCalculus
{
    #[Assert\NotBlank]
    #[Assert\Length(min:1, max:20)]
    #[Assert\Regex(pattern: '/^\d*\.?\d*$/')]
    public string $a = '';

    #[Assert\NotBlank]
    #[Assert\NotEqualTo('0')]
    #[Assert\Length(min:1, max:20)]
    #[Assert\Regex(pattern: '/^\d*\.?\d*$/')]
    public string $b = '';

    public int $scale;

    public function __construct($a, $b, $scale = 4)
    {
        $this->a = $a;
        $this->b = $b;
        $this->scale = $scale;
    }

    public function div() : string {
        return bcdiv($this->a, $this->b, $this->scale);
    }
}