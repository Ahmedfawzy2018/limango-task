<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entities\CigaretteTransactionEntity;
use App\Machine\CigaretteMachine;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $itemCount = (int) $input->getArgument('packs');
        $amountPaid = (float) \str_replace(',', '.', $input->getArgument('amount'));

        try {

            $cigaretteTransaction= new CigaretteTransactionEntity();
            $cigaretteTransaction->setItemQuantity($itemCount);
            $cigaretteTransaction->setPaidAmount($amountPaid);

            $cigaretteMachine = new CigaretteMachine();
            $cigaretteEntity = $cigaretteMachine->execute($cigaretteTransaction);

            $output->writeln("You bought <info> " . $cigaretteEntity->getItemQuantity() .
                " </info> packs of cigarettes for <info> " . $cigaretteEntity->getTotalAmount() .
                " </info>, each for <info>" . CigaretteMachine::ITEM_PRICE . "</info>. ");
            $output->writeln('Your change is:');

            $table = new Table($output);
            $table
                ->setHeaders(array('Coins', 'Count'))
                ->setRows(
                    $cigaretteEntity->getChange()
                );
            $table->render();
        } catch (\Exception $exception) {
            $outputStyle->warning($exception->getMessage());
        }

    }
}