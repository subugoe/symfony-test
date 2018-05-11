<?php
namespace App\Command;

use App\CustomContext;
use App\DataAccess\Gateway\SolrGateway;
use App\BusinessLogic\Usecase\LemmaUsecase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class LemmaGetter extends Command
{

    protected function configure()
    {
        $this
            ->setName('LemmaGetter')
            ->setDescription('Gets an FWB article.')
            ->addArgument("lemma-id");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        CustomContext::$backendGateway = new SolrGateway();

        $usecase = new LemmaUsecase();
        $lemmaId = $input->getArgument("lemma-id");
        $result = $usecase->constructItem($lemmaId);

        $output->writeln("Lemma: " . $result->lemma);
    }
}