<?php
/**
 * Created by PhpStorm.
 * User: kanat
 * Date: 16.11.2017
 * Time: 18:34
 */

namespace KzNumSpell\Tests;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../KzNumSpell.php';

use KzNumSpell\KzNumSpell;

class SpellTest extends TestCase {
	/**
	 * Test if zero regions of number handled correctly
	 */
	public function testZerosHandledCorrect() {
		$speller = new KzNumSpell();
		$this->assertEquals(
			'жүз миллиард он мың',
			$speller->spell('100000010000')
		);
	}

	/**
	 * Test if trillion number handled correctly
	 */
	public function testTrillionHandledCorrect() {
		$speller = new KzNumSpell();
		$this->assertEquals(
			'сегіз жүз елу төрт триллион он екі миллиард жүз миллион үш жүз отыз төрт мың сегіз жүз жетпіс төрт',
			$speller->spell('854012100334874')
		);
	}

	/**
	 * Test simple number
	 */
	public function testSimpleNumber() {
		$speller = new KzNumSpell();
		$this->assertEquals(
			'елу бес',
			$speller->spell(55)
		);
		$this->assertEquals(
			'тоғыз',
			$speller->spell(9)
		);
		$this->assertEquals(
			'сегіз жүз тоғыз',
			$speller->spell(809)
		);
	}

	/**
	 * Test if non digits are omitted
	 */
	public function testNonDigitsAreOmitted() {
		$speller = new KzNumSpell();
		$this->assertEquals(
			'алты жүз бір миллиард сексен сегіз мың алты',
			$speller->spell('601 000 _ 088 _ 006')
		);
	}
}