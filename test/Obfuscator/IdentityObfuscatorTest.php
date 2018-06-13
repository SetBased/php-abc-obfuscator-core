<?php

namespace SetBased\Abc\Test\Obfuscator;

use PHPUnit\Framework\TestCase;
use SetBased\Abc\Obfuscator\IdentityObfuscatorFactory;

/**
 * Test case for IdentityObfuscator.
 */
class IdentityObfuscatorTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritdoc
   */
  public function setup()
  {
    mt_srand(crc32(microtime()));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test null and empty string are decoded to null.
   */
  public function testDeObfuscate1()
  {
    $obfuscator = IdentityObfuscatorFactory::getObfuscator('abc');

    $codes = ['', null];
    foreach ($codes as $code)
    {
      $id = $obfuscator->decode($code);
      self::assertNull($id);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test encode does nothing.
   */
  public function testIdentity1()
  {
    $obfuscator = IdentityObfuscatorFactory::getObfuscator('abc');
    $id         = mt_rand(1, 2147483647);
    $code       = $obfuscator->encode($id);

    self::assertEquals($id, $code);
  }


  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test decode does nothing.
   */
  public function testIdentity2()
  {
    $obfuscator = IdentityObfuscatorFactory::getObfuscator('abc');
    $code       = (string)mt_rand(1, 2147483647);
    $id         = $obfuscator->decode($code);

    self::assertEquals($code, $id);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test ID 0 is encoded en decoded correctly.
   */
  public function testObfuscateDeObfuscate1()
  {
    $obfuscator = IdentityObfuscatorFactory::getObfuscator('abc');
    $values     = [0, '0'];

    foreach ($values as $value)
    {
      $code = $obfuscator->encode($value);
      $tmp  = $obfuscator->decode($code);

      self::assertEquals($tmp, 0);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------