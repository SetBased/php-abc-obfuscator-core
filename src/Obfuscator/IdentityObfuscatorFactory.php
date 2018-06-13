<?php

namespace SetBased\Abc\Obfuscator;

/**
 * A factory for obfuscators that do not obfuscate at all.
 */
class IdentityObfuscatorFactory implements ObfuscatorFactory
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritdoc
   */
  public static function decode(?string $code, string $alias): ?int
  {
    return ($code===null || $code==='') ? null : (int)$code;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritdoc
   */
  public static function encode(?int $id, string $alias): ?string
  {
    return ($id===null) ? null : (string)$id;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritdoc
   *
   * @return IdentityObfuscator
   */
  public static function getObfuscator(string $alias)
  {
    return new IdentityObfuscator();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
