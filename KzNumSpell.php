<?php

namespace KzNumSpell;
/**
 * Created by PhpStorm.
 * User: kanat
 * Date: 16.11.2017
 * Time: 17:20
 */
/**
 * Class KzNumSpell Class for spelling numbers up to 10^24
 * @package KzNumSpell
 */
class KzNumSpell {
	const nums = [
		'1'   => 'бір',
		'2'   => 'екі',
		'3'   => 'үш',
		'4'   => 'төрт',
		'5'   => 'бес',
		'6'   => 'алты',
		'7'   => 'жеті',
		'8'   => 'сегіз',
		'9'   => 'тоғыз',
		'10'  => 'он',
		'20'  => 'жиырма',
		'30'  => 'отыз',
		'40'  => 'қырық',
		'50'  => 'елу',
		'60'  => 'алпыс',
		'70'  => 'жетпіс',
		'80'  => 'сексен',
		'90'  => 'тоқсан',
		'100' => 'жүз',
		'x3'  => 'мың',
		'x6'  => 'миллион',
		'x9'  => 'миллиард',
		'x12' => 'триллион',
		'x15' => 'квадриллион',
		'x18' => 'квинтиллион',
		'x21' => 'секстиллион',
		'x24' => 'септиллион'
	];

	/**
	 * Spells given number
	 * @param string $number Number to spell. Non digit chars are omitted
	 * @return string Spelled text
	 */
	public function spell(string $number): string {
		$numbersOnly = preg_replace('/[^0-9]/', '', $number);

		return $this->toString($this->_spell($numbersOnly));
	}

	/**
	 * Internal recursive function to handle spelling
	 * @param string $number number to spell
	 * @param array  $array array to keep number spellings
	 * @return array array of strings
	 */
	private function _spell(string $number, array &$array = []): array {
		$count = strlen($number);
		if ($count == 1) {
			if ($number != 0)
				$array[] = KzNumSpell::nums[$number];

		} elseif ($count == 2) {
			$least = $number % 10;
			$number -= $least;
			$array[] = KzNumSpell::nums[$number];
			$this->_spell($least, $array);

		} elseif ($count == 3) {
			$least = $number % 100;
			$number -= $least;
			$number = intval($number / 100);
			$this->_spell($number);
			if ($number != 1)
				$this->_spell($number, $array);
			if ($number != 0)
				$array[] = KzNumSpell::nums[100];
			$this->_spell($least, $array);

		} elseif ($count >= 4) {
			/// n+1 < digitCount < n+3 , where n <- razriad
			/// get leftmost and iterate until divisible by three
			$left = $count - 3;
			$degree = $left;
			while ($degree % 3 != 0) {
				$degree++;
			}
			$least = substr($number, $count - $degree);
			$number = substr($number, 0, $count - $degree);
			if ($number != 1)
				$this->_spell($number, $array);
			if ($number != 0)
				$array[] = KzNumSpell::nums["x$degree"];
			$this->_spell($least, $array);

		}

		return $array;
	}

	/**
	 *    Joins given array and returns string
	 * @param array $array array to join
	 * @return string stringified array
	 */
	private function toString(array $array): string {
		return join(' ', $array);
	}
}