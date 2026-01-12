<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright (C) 2022 Marat Bedoev, bestlife AG
 * @copyright (C) 2023 O3-Shop (https://www.o3-shop.com)
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

namespace O3\TinyMCE\Tests\Unit;

use D3\TestingTools\Development\CanAccessRestricted;
use O3\TinyMCE\Application\Core\TinyMCE\Loader;
use O3\TinyMCE\Application\Core\ViewConfig;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[Small]
#[CoversFunction('getTinyMceInitCode')]
#[CoversFunction('getTinyMceScripts')]
#[CoversFunction('getTinyMceIncludes')]
#[CoversFunction('getTinyMceLoader')]
class ViewConfigTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testGetTinyMceInitCode()
    {
        $loaderMock = $this->getMockBuilder(Loader::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getEditorCode'])
            ->getMock();
        $loaderMock->expects(self::atLeastOnce())->method('getEditorCode');

        $sut = $this->getMockBuilder(ViewConfig::class)
            ->onlyMethods(['getTinyMceLoader'])
            ->getMock();
        $sut->method('getTinyMceLoader')->willReturn($loaderMock);

        $this->callMethod(
            $sut,
            'getTinyMceInitCode',
        );
    }

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testGetTinyMceScripts()
    {
        $loaderMock = $this->getMockBuilder(Loader::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getScripts'])
            ->getMock();
        $loaderMock->expects(self::atLeastOnce())->method('getScripts');

        $sut = $this->getMockBuilder(ViewConfig::class)
            ->onlyMethods(['getTinyMceLoader'])
            ->getMock();
        $sut->method('getTinyMceLoader')->willReturn($loaderMock);

        $this->callMethod(
            $sut,
            'getTinyMceScripts',
        );
    }

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testGetTinyMceIncludes()
    {
        $loaderMock = $this->getMockBuilder(Loader::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getIncludes'])
            ->getMock();
        $loaderMock->expects(self::atLeastOnce())->method('getIncludes');

        $sut = $this->getMockBuilder(ViewConfig::class)
            ->onlyMethods(['getTinyMceLoader'])
            ->getMock();
        $sut->method('getTinyMceLoader')->willReturn($loaderMock);

        $this->callMethod(
            $sut,
            'getTinyMceIncludes',
        );
    }

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testGetTinyMceLoader()
    {
        $sut = $this->getMockBuilder(ViewConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(
            Loader::class,
            $this->callMethod(
                $sut,
                 'getTinyMceLoader'
            )
        );
    }
}
