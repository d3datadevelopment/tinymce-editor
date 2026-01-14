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

namespace O3\TinyMCE\Tests\Unit\Application\Core\TinyMCE\Options;

use D3\TestingTools\Development\CanAccessRestricted;
use Generator;
use O3\TinyMCE\Application\Core\TinyMCE\Options\ContentCss;
use OxidEsales\Eshop\Core\Config;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[Small]
#[CoversFunction('get')]
class ContentCssTest extends TestCase
{
    use CanAccessRestricted;

    /**
     * @throws ReflectionException
     * @dataProvider getDataProvider
     */
    #[Test]
    #[DataProvider('getDataProvider')]
    public function testGet($theme, bool $dark, string $expected): void
    {
        $configMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getConfigParam'])
            ->getMock();
        $configMock->method('getConfigParam')->with($this->identicalTo('sTheme'))->willReturn($theme);

        $sut = oxNew(ContentCss::class, $configMock);

        $this->setValue($sut, 'darkMode', $dark);

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'get'
            )
        );
    }

    public static function getDataProvider(): Generator
    {
        yield 'theme unconfigured' => [false, false, ''];
        yield 'theme configured' => ['myTheme', false, '/out/mytheme/src/css/styles.min.css'];
        yield 'dark mode' => ['myTheme', true, 'dark'];
    }
}