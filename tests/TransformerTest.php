<?php

namespace FluentDOM\PhpCss {

  use PHPUnit\Framework\TestCase;

  require_once __DIR__.'/../vendor/autoload.php';

  class TransformerTest extends TestCase {

    /**
     * @covers \FluentDOM\\PhpCss\Transformer
     * @dataProvider provideCSSSelectors
     *
     * @param string $expectedXpath
     * @param string $selector
     * @param int $contextMode
     * @param bool $isHtml
     */
    public function testToXpath($expectedXpath, $selector, $contextMode, $isHtml) {
      $transformer = new Transformer();
      $this->assertEquals(
        $expectedXpath,
        $transformer->toXpath($selector, $contextMode, $isHtml)
      );
    }

    public static function provideCSSSelectors() {
      return [
        ['.//p', 'p', Transformer::CONTEXT_CHILDREN, FALSE],
        ['//p', 'p', Transformer::CONTEXT_DOCUMENT, FALSE],
        ['self::p', 'p', Transformer::CONTEXT_SELF, FALSE],
        ['.//P', 'P', Transformer::CONTEXT_CHILDREN, FALSE],
        ['//P', 'P', Transformer::CONTEXT_DOCUMENT, FALSE],
        ['self::P', 'P', Transformer::CONTEXT_SELF, FALSE],
        ['.//*[local-name() = "p"]', 'P', Transformer::CONTEXT_CHILDREN, TRUE],
        ['//*[local-name() = "p"]', 'P', Transformer::CONTEXT_DOCUMENT, TRUE],
        ['self::*[local-name() = "p"]', 'P', Transformer::CONTEXT_SELF, TRUE]
      ];
    }
  }
}