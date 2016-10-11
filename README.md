# DateIntervalComparator

Compare two DateInterval-Objects with one another.

[![Build Status](https://travis-ci.org/heiglandreas/DateIntervalComparator.svg?branch=master)](https://travis-ci.org/heiglandreas/DateIntervalComparator)
[![Code Climate](https://codeclimate.com/github/heiglandreas/DateIntervalComparator/badges/gpa.svg)](https://codeclimate.com/github/heiglandreas/DateIntervalComparator)
[![Coverage Status](https://coveralls.io/repos/github/heiglandreas/DateIntervalComparator/badge.svg?branch=master)](https://coveralls.io/github/heiglandreas/DateIntervalComparator?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/DateIntervalComparator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/DateIntervalComparator/?branch=master)

[![Total Downloads](https://poser.pugx.org/org_heigl/dateintervalcomparator/downloads)](https://packagist.org/packages/org_heigl/dateintervalcomparator)
[![Latest Stable Version](https://poser.pugx.org/org_heigl/dateintervalcomparator/v/stable)](https://packagist.org/packages/org_heigl/dateintervalcomparator)
[![License](https://poser.pugx.org/org_heigl/dateintervalcomparator/license)](https://packagist.org/packages/org_heigl/dateintervalcomparator)

 
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