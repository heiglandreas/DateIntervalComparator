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

This library assumes that the compared intervals are sensible and alike. 
Comparing 3 months and 4 days against 5 months and 7 days is what this library is made for.
It's not been made for comparing 3 months and 4 days against 94 days. 
Due to the different number of days in a month this comparison will be different 
depending on the start-date and we do want to compare only the Intervals and not 
the resulting end-dates!

As long as the values do not exceed their moduli (e.g. a value of 13 for month or 25 for the hour) 
you are on the safe side.

You can even enforce this safe side by setting ```php $comparator->safe(true)```. 
That will then throw an exception when one of the values for month, day, hour, 
minute or second  will exceed the values 12, 31, 24, 60 and 60 resp.

## Caveat/Limitations

Take care! DateIntervals can be nasty!

Due to their nature DateIntervals do *not* take Date or Time into account! So
```DateInterval('P1M')``` might or might not be the same as ```DateInterval('P30D')```!
This Library will compare on a "same entity"-level. So first years are compared, 
then months, then weeks and so on. Whewn you have an interval that is descibing only 55 weeks
and compare that to one that is only describing one year, the one year will be considered greater 
even though 55 weeks are more. So you should only compare comparable intervals! 

The same can happen with f.e. ```new DateInterval('PT36H')``` and ```new DateInterval('P1DT12H')```
You'd think they are the same, but consider DaylightSavingsTime and they suddenly
might not be the same! So currently the ```P1DT12H``` would be considered the "higher" one. 

## License

This library is published under the MIT-License. Find a copy in the LICENSE.md-File.