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

namespace O3\TinyMCE\Tests\Unit\Application\Core\TinyMCE;

use D3\TestingTools\Development\CanAccessRestricted;
use Generator;
use O3\TinyMCE\Application\Core\TinyMCE\Configuration;
use O3\TinyMCE\Application\Core\TinyMCE\Options\MaxWidth;
use O3\TinyMCE\Application\Core\TinyMCE\Options\MinHeight;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[Small]
#[CoversFunction('__construct')]
#[CoversFunction('addOption')]
#[CoversFunction('removeOption')]
#[CoversFunction('getConfig')]
class ConfigurationTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testConstruct(): void
    {
        $sut = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addOption'])
            ->getMock();
        $sut->expects(self::exactly(2))->method('addOption');

        $this->callMethod(
            $sut,
            '__construct',
            [
                (function () {
                    yield new MinHeight();
                    yield new MaxWidth();
                })()
            ]
        );
    }

    /**
     * @throws ReflectionException
     * @dataProvider addOptionDataProvider
     */
    #[Test]
    #[DataProvider('addOptionDataProvider')]
    public function testAddOption(bool $requireRegistration, bool $quoted, $expected): void
    {
        $optionMock = $this->getMockBuilder(MaxWidth::class)
            ->onlyMethods(['requireRegistration', 'isQuoted', 'get'])
            ->getMock();
        $optionMock->method('requireRegistration')->willReturn($requireRegistration);
        $optionMock->method('isQuoted')->willReturn($quoted);
        $optionMock->method('get')->willReturn('80%');

        $sutMock = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->callMethod(
            $sutMock,
            'addOption',
            [$optionMock]
        );

        $list = $this->getValue(
            $sutMock,
            'optionList'
        );
        $this->assertSame($expected, $list);
    }

    public static function addOptionDataProvider(): Generator
    {
        yield 'dont need registration' => [false, false, []];
        yield 'unquoted' => [true, false, ['max_width' => '80%']];
        yield 'quoted' => [true, true, ['max_width' => '"80%"']];
    }

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testRemoveOption(): void
    {
        $sut = oxNew(
            Configuration::class,
             (function () {
                yield new MinHeight();
                yield new MaxWidth();
            })()
        );

        $this->callMethod(
            $sut,
            'removeOption',
            ['min_height']
        );

        $list = $this->getValue(
            $sut,
            'optionList'
        );
        $this->assertSame(['max_width'], array_keys($list));
    }

    /**
     * @throws ReflectionException
     */
    #[Test]
    public function testGetConfig(): void
    {
        $sut = oxNew(
            Configuration::class,
            (function () {
                $minHeightMock = $this->getMockBuilder(MinHeight::class)
                    ->onlyMethods(['get'])
                    ->getMock();
                $minHeightMock->method('get')->willReturn('500');
                yield $minHeightMock;
                $maxWidthMock = $this->getMockBuilder(MaxWidth::class)
                    ->onlyMethods(['get'])
                    ->getMock();
                $maxWidthMock->method('get')->willReturn('400');
                yield $maxWidthMock;
            })()
        );

        $this->assertSame(
            'min_height: 500, max_width: "400", ',
            $this->callMethod(
                $sut,
                'getConfig',
            )
        );
    }
}