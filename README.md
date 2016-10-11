# DateIntervalComparator

Compare two DateInterval-Objects with one another.
 
## Installation

DateIntervalComparator is best installed using [composer](https://getcomposer.org)

    composer require org_heigl/dateintervalcomparator
    

## Usage

```php
$comparator = new Org_Heigl\DateIntervalComparator\DateIntervalCompoarator()
echo $comparator->compare(new Dateinterval('P1Y'), new DateInterval('P1M'));
// 1
```

The ```DateIntervalComparator``` uses the same return values all 
comparison-functions in PHP use. When the first value is smaller than the second it 
returns -1, if the first is greater than the second it returns 1 and when both are 
equals it returns 0. The method can therefore be used as callback to sort arrays.

## License

This library is published under the MIT-License. Find a copy in the LICENSE.md-File.