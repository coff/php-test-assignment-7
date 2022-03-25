<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calculus
{
    #[Assert\NotBlank]
    #[Assert\Length(min:1, max:20)]
    #[Assert\Regex(pattern: '/^\d*\.?\d*$/')]
    public string $a = '';

    #[Assert\NotBlank]
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

    public function mul() : string {
        return bcmul($this->a, $this->b, $this->scale);
    }

    public function add() : string {
        return bcadd($this->a, $this->b, $this->scale);
    }

    public function sub() : string {
        return bcsub($this->a, $this->b, $this->scale);
    }
}