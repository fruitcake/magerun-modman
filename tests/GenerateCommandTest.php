<?php

use Fruitcake\Magerun\Modman\GenerateCommand;

class GenerateCommandTest extends PHPUnit_Framework_TestCase
{
    /** @var  GenerateCommand */
    protected $command;

    public function setUp()
    {
        $this->command = new GenerateCommand();
    }

    /**
     * @dataProvider rewrites
     * @param string $source
     * @param string $expected
     */
    public function testRewrite($source, $expected)
    {
        $this->assertSame($expected, $this->command->rewritePath($source));
    }

    public function rewrites()
    {
        return array(
            array('app/code/community/foo/bar/etc/config.xml', 'app/code/community/foo/bar'),
            array('app/code/community/foo_bar/baz/etc/config.xml', 'app/code/community/foo_bar/baz'),
            array('app/code/community/fooBar/baz/etc/config.xml', 'app/code/community/fooBar/baz'),
            array('lib/foo/bar.php', 'lib/foo'),
            array('js/foo/bar/baz.js', 'js/foo/bar'),
            array('app/design/frontend/base/default/layout/foo/layout.xml', 'app/design/frontend/base/default/layout/foo'),
            array('app/design/frontend/base/default/template/foo/bar.phtml', 'app/design/frontend/base/default/template/foo'),
            array('skin/frontend/base/default/foo/bar/baz.css', 'skin/frontend/base/default/foo/bar')
        );
    }

    /**
     * @dataProvider noRewrites
     * @param string $source
     */
    public function testSkipsRewrite($source)
    {
        $this->assertSame($source, $this->command->rewritePath($source));
    }

    public function noRewrites()
    {
        return array(
            array('app/code/local/Mage/Catalog/somefile.php'),
            array('lib/Varien/overwrite.php')
        );
    }
}
