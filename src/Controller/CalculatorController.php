<?php

namespace App\Controller;

use App\Entity\Calculus;
use App\Entity\DivisionCalculus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class CalculatorController extends AbstractController
{
    protected ValidatorInterface $validator;

    public function __construct() {
        $builder = Validation::createValidatorBuilder();
        $builder->enableAnnotationMapping();
        $this->validator = $builder->getValidator();
    }

    #[Route('api/v1/add/{a}/to/{b}', name:'addition', methods: ['GET'])]
    public function add(string $a, string $b) : Response
    {
        $task = new Calculus($a, $b);
        $errors = $this->validator->validate($task);

        if (count($errors) > 0) {
            return $this->json(['success' => false, 'errors' => (string)$errors],400);
        }

        return $this->json(['success' => true, 'result' => $task->add()]);
    }

    #[Route('api/v1/subtract/{a}/from/{b}', name:'subtraction', methods: ['GET'])]
    public function subtract(string $a, string $b) : Response
    {
        $task = new Calculus($a, $b);
        $errors = $this->validator->validate($task);

        if (count($errors) > 0) {
            return $this->json(['success' => false, 'errors' => (string)$errors], 400);
        }

        return $this->json(['success' => true, 'result' => $task->sub()]);
    }

    #[Route('api/v1/multiply/{a}/by/{b}', name:'multiplication', methods: ['GET'])]
    public function multiply(string $a, string $b) : Response
    {
        $task = new Calculus($a, $b);
        $errors = $this->validator->validate($task);

        if (count($errors) > 0) {
            return $this->json(['success' => false, 'errors' => (string)$errors], 400);
        }

        return $this->json(['success' => true, 'result' => $task->sub()]);
    }

    #[Route('api/v1/divide/{a}/by/{b}', name:'division', methods: ['GET'])]
    public function divide(string $a, string $b) : Response
    {
        $task = new DivisionCalculus($a, $b);
        $errors = $this->validator->validate($task);

        if (count($errors) > 0) {
            return $this->json(['success' => false, 'errors' => (string)$errors], 400);
        }

        return $this->json(['success' => true, 'result' => $task->div()]);
    }
}