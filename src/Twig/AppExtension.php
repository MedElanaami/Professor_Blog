<?php
//src/Twig/AppExtension.php
namespace App\Twig;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\CategorieRepository;
use App\Repository\ParametreRepository;
use App\Repository\SemestreRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{


    public SemestreRepository $semestreRepository;
    public ParametreRepository $parametreRepository;
    public function __construct(SemestreRepository $semestreRepository, ParametreRepository $parametreRepository)
    {

        $this->semestreRepository=$semestreRepository;
        $this->parametreRepository=$parametreRepository;
    }

    public function getFunctions(): array
    {
        return [

            new TwigFunction('semestres', [$this, 'semestres']),
            new TwigFunction('parametre', [$this, 'parametre']),
        ];
    }


    public function semestres()
    {
        $semestres=$this->semestreRepository->findAll();
        return $semestres;
    }public function parametre()
{
    $parametre=$this->parametreRepository->findOneBy(array());
    return $parametre;
}
}
