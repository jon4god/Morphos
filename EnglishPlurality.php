<?php
namespace morphos;

class EnglishPlurality extends BasicPlurality {

	static private $exceptions = array(
		'chief' => 'chiefs',
		'basis' => 'bases',
		'crisis' => 'crises',
		'radius' => 'radii',
		'nucleus' => 'nuclei',
		'curriculum' => 'curricula',
		'man' => 'men',
		'woman' => 'women',
		'child' => 'children',
		'foot' => 'feet',
		'tooth' => 'teeth',
		'ox' => 'oxen',
		'goose' => 'geese',
		'mouse' => 'mice'
	);

	static private $without_plural_form = array(
		'ink',
		'money',
	);

	static public $consonants = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'x', 'z', 'w');

	public function pluralize($word) {
		$word = lower($word);
		if (in_array(self::$without_plural_form))
			return $word;
		else if (isset(self::$exceptions[$word]))
			return self::$exceptions[$word];

		if (in_array(slice($word, -1), array('s', 'x')) || in_array(slice($word, -2), array('sh', 'ch'))) {
			return $word.'es';
		} else if (slice($word, -1) == 'o') {
			return $word.'es';
		} else if ($slice($word, -1) == 'y' && in_array(slice($word, -2, -1), self::$consonants)) {
			return slice($word, 0, -1).'ies';
		} else if (slice($word, -2) == 'fe' || slice($word, -1) == 'f') {
			if (slice($word, -1) == 'f') {
				return slice($word, 0, -1).'ves';
			} else {
				return slice($word, 0, -2).'ves';
			}
		} else {
			return $word.'s';
		}
	}
}
