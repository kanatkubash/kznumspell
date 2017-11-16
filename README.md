# Number spelling for Kazakh language
This PHP library can be used to spell number into text in kazakh language. Typical usage scenarion is bank invoices
Maximum supported up to 10^21
### Usage
1.  Install using composer ` composer require ozgeris/kznumspell ` and run dump autoload
2.  Include `KzNumSpell.php` directly
### PHP version >= 7.0
### Example
```php
use KzNumSpell\KzNumSpell;

$speller = new KzNumSpell;
$speller->spell(10456);
$speller->spell('123 456 789');
```
### Running tests
Library uses phpunit for testing.
  Tests are in folder `tests`
  
  `phpunit tests\Spelltest.php`
