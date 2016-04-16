<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Obfuscator;

use SetBased\Exception\LogicException;

//----------------------------------------------------------------------------------------------------------------------
/**
 * A factory for obfuscators using a reference implementation for obfuscating database ID.
 */
class ReferenceObfuscatorFactory implements ObfuscatorFactory
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * A lookup table from label to [length, key, bit mask].
   *
   * @var array[]
   */
  public static $labels = [];

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public static function decode($code, $alias)
  {
    if (!isset(self::$labels[$alias]))
    {
      throw new LogicException("Unknown label '%s'.", $alias);
    }

    return ReferenceObfuscator::decrypt($code,
                                        self::$labels[$alias][0],
                                        self::$labels[$alias][1],
                                        self::$labels[$alias][2]);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public static function encode($id, $alias)
  {
    if (!isset(self::$labels[$alias]))
    {
      throw new LogicException("Unknown label '%s'.", $alias);
    }

    return ReferenceObfuscator::encrypt($id,
                                        self::$labels[$alias][0],
                                        self::$labels[$alias][1],
                                        self::$labels[$alias][2]);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   *
   * @return ReferenceObfuscator
   */
  public static function getObfuscator($alias)
  {
    if (!isset(self::$labels[$alias]))
    {
      throw new LogicException("Unknown label '%s'.", $alias);
    }

    return new ReferenceObfuscator(self::$labels[$alias][0],
                                   self::$labels[$alias][1],
                                   self::$labels[$alias][2]);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------