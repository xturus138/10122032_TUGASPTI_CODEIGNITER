<?php
/**
 * PHPExcel_Shared_String
 *
 * This class contains various utility methods to handle string operations for PHPExcel
 * 
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */

class PHPExcel_Shared_String
{
    /**
     * Method to build the character sets used by PHPExcel
     * This can include any necessary initialization for character encoding
     */
    public static function buildCharacterSets()
    {
        // Sample implementation of character set initialization (empty for now)
        // In real PHPExcel code, this would set up any global string handling
        // related to character encoding, but for now, we just ensure the class is available.
        if (!function_exists('mb_strlen')) {
            throw new PHPExcel_Exception('Multibyte string extension (mbstring) is not available.');
        }

        // Placeholder for future extension, if needed.
    }

    /**
     * Method to handle character set encoding conversion.
     * Converts a string from one encoding to another
     *
     * @param string $string The input string
     * @param string $fromCharset The source character set (e.g. UTF-8)
     * @param string $toCharset The target character set (e.g. ISO-8859-1)
     * @return string The converted string
     */
    public static function convertEncoding($string, $fromCharset = 'UTF-8', $toCharset = 'ISO-8859-1')
    {
        // Ensure multibyte functions are available
        if (!function_exists('mb_convert_encoding')) {
            throw new PHPExcel_Exception('Multibyte string extension (mbstring) is not available.');
        }

        return mb_convert_encoding($string, $toCharset, $fromCharset);
    }

    /**
     * Method to handle string length calculation
     * This is useful for counting characters in multibyte encodings
     *
     * @param string $string The input string
     * @return int The length of the string
     */
    public static function strlen($string)
    {
        // Ensure multibyte functions are available
        if (!function_exists('mb_strlen')) {
            throw new PHPExcel_Exception('Multibyte string extension (mbstring) is not available.');
        }

        return mb_strlen($string);
    }
}
