<?php

namespace Syclass\FipeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Syclass\FipeBundle\Entity\FipeManufacturer;
use Syclass\Core\Entity\Category;
use Syclass\Core\Entity\CategoryDescription;
use Syclass\Core\Entity\Locale;

class SyclassFipeCreateCategoriesCommand extends Command
{
    protected $monitor;
    protected static $defaultName = 'syclass:fipe:create-categories';
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine)
    {
        parent::__construct();
        $this->em = $doctrine->getEntityManager();
    }
    protected function configure()
    {
        $this
            ->setDescription('Create Categories for FIPE Manufacturers')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $locale = $this->em->getRepository(Locale::class)->findOneByCode('pt_BR');
        $categoryRepository = $this->em->getRepository(Category::class);
        $descriptionRepository = $this->em->getRepository(CategoryDescription::class);

        $parent = $this->em->getRepository(Category::class)->find(2);

        foreach ($this->em->getRepository(FipeManufacturer::class)->findAll() as $manufacturer) {
            $io->writeln($manufacturer->getName());
            if(NULL == $descriptionRepository->findOneByName($manufacturer->getName())){
                $category = new Category($parent);
                $this->em->persist($category);
                $description = new CategoryDescription($locale, $category, $manufacturer->getName(), $manufacturer->getSlug());
                $this->em->persist($description);
            }
        }
        $this->em->flush();
        $io->success('Categories created.');
    }
}
