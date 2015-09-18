<?php

namespace Fruitcake\Magerun\Modman;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Filesystem\Filesystem;
use N98\Magento\Command\AbstractMagentoCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate a modman file for the current directory.
 */
class GenerateCommand extends AbstractMagentoCommand
{
    protected function configure()
    {
        $this
          ->setName('modman:generate')
          ->setDescription('Generate a modman file for the current directory.')
          ->addOption('file', 'f',  InputOption::VALUE_OPTIONAL, 'Filename to save the modman file to.', 'modman')
          ->addOption('dir', 'd', InputOption::VALUE_OPTIONAL, 'Directory in which the module files are located.')
          ->addOption('preview', 'p', InputOption::VALUE_NONE, 'Only output the modman file, instead of writing.')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get dir, make sure it ends with 1 /
        $dir = $input->getOption('dir');
        $dir = $dir ? rtrim($dir, '/') .'/' : '';

        // Get filename to store modman file
        $filename = ($input->getOption('file'));

        // Create a finder instance for all files in the dir.
        $finder = new Finder();
        $finder->files()->in('./' . $dir);

        $paths = [];
        foreach ($finder as $file) {
            /* @var $file SplFileInfo */
            $path = $this->rewritePath($file->getRelativePathname());
            $paths[$path] = $path;
        }

        // Create the actual modman file
        $content = '';
        foreach ($paths as $path) {
            $content .= $dir . $path . "\t" . $path . "\n";
        }

        // If preview, only show
        if ($input->getOption('preview')) {
            $output->writeln($content);
        } else {
            $write = file_put_contents($filename, $content);

            if ($write === false) {
                $output->writeln('<error>Could not write output to '.$filename.'</error>');
            } else {
                $output->writeLn('<info>Saved contents to '.$filename.'</info>');
            }
        }
    }

    /**
     * Rewrite path. Based on https://gist.github.com/schmengler/88fa071822a95224373f
     *
     * app/code/community/VENDOR/PACKAGE/etc/config.xml -> app/code/community/VENDOR/PACKAGE
     */
    protected function rewritePath($path)
    {
        $path = preg_replace('{^\./}', '', $path);
        $path = preg_replace('{^app/code/(.*?)/(.*?)/(.*?)/(.*)$}', 'app/code/$1/$2/$3', $path);
        $path = preg_replace('{^lib/(.*?)/(.*)$}', 'lib/$1', $path);
        $path = preg_replace('{^js/(.*?)/(.*?)/(.*)$}', 'js/$1', $path);
        $path = preg_replace('{^app/design/(.*?)/(.*?)/default/layout/(.*?)/(.*)$}', 'app/design/$1/$2/default/layout/$3', $path);
        $path = preg_replace('{^app/design/(.*?)/(.*?)/default/template/(.*?)/(.*)$}', 'app/design/$1/$2/default/template/$3', $path);
        $path = preg_replace('{^skin/(.*?)/(.*?)/default/(.*?)/(.*?)/(.*)$}', 'skin/$1/$2/default/$3/$4', $path);

        return $path;
    }
}
