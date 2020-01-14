<?php
/**
 * Copyright (c) Andreas Heigl<andreas@heigl.org>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @since     11.10.2016
 * @link      http://github.com/heiglandreas/org.heigl.DateIntervalComparator
 */

namespace Org_Heigl\DateIntervalComparator;

use DateInterval;
use UnexpectedValueException;

class DateIntervalComparator
{
    private $safe = false;

    public function __construct(bool $safe = false)
    {
        $this->safe = $safe;
    }

    /** @deprecated Use the constructor injected safety flag */
    public function safe($safe = true): void
    {
        $this->safe = $safe;
    }

    /**
     * COmpare the two date intervals.
     *
     * If the first contains a larger timespan we return 1, if the second contains more
     * we return -1 and when they are equals we return 0.
     *
     * @param DateInterval $first
     * @param DateInterval $second
     *
     * @return int
     */
    public function compare(DateInterval $first, DateInterval $second): int
    {
        if ($this->safe) {
            $this->safecheck($first);
            $this->safecheck($second);
        }

        if (0 !== $datePart = $this->compareDatePart($first, $second)) {
            return $datePart;
        }

        return $this->compareTimePart($first, $second);
    }

    private function compareDatePart(DateInterval $first, DateInterval $second): int
    {
        if (0 !== $year = $this->compareValue($first->y, $second->y)) {
            return $year;
        }

        if (0 !== $month = $this->compareValue($first->m, $second->m)) {
            return $month;
        }

        if (0 !== $day = $this->compareValue($first->d, $second->d)) {
            return $day;
        }

        return 0;
    }

    private function compareTimePart(DateInterval $first, DateInterval $second): int
    {
        if (0 !== $hour = $this->compareValue($first->h, $second->h)) {
            return $hour;
        }

        if (0 !== $minute = $this->compareValue($first->i, $second->i)) {
            return $minute;
        }

        if (0 !== $second = $this->compareValue($first->s, $second->s)) {
            return $second;
        }

        return 0;
    }

    private function compareValue(int $a, int $b): int
    {
        if ($a < $b) {
            return -1;
        }

        if ($a > $b) {
            return 1;
        }

        return 0;
    }

    private function safecheck(DateInterval $interval): void
    {
        if ($interval->m > 12) {
            throw new UnexpectedValueException('Month exceeds value 12');
        }

        if ($interval->d > 31) {
            throw new UnexpectedValueException('Day exceeds value 31');
        }

        // 25 due to DST-Transitions
        if ($interval->h > 25) {
            throw new UnexpectedValueException('Hour exceeds value 25');
        }

        if ($interval->i > 60) {
            throw new UnexpectedValueException('Minute exceeds value 60');
        }

        // 61 due to leap-seconds
        if ($interval->s > 61) {
            throw new UnexpectedValueException('Second exceeds value 61');
        }
    }
}
