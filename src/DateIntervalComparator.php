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

class DateIntervalComparator
{
    protected $safe = false;

    public function safe($safe = true)
    {
        $this->safe = $safe;
    }

    /**
     * COmpare the two date intervals.
     *
     * If the first contains a larger timespan we return 1, if the second contains more
     * we return -1 and when they are equals we return 0.
     *
     * @param \DateInterval $first
     * @param \DateInterval $second
     *
     * @return int
     */
    public function compare(\DateInterval $first, \DateInterval $second)
    {
        if ($this->safe) {
            $this->safecheck($first);
            $this->safecheck($second);
        }

        if ($first->y > $second->y) {
            return 1;
        }

        if ($first->y < $second->y) {
            return -1;
        }

        if ($first->m > $second->m) {
            return 1;
        }

        if ($first->m < $second->m) {
            return -1;
        }

        if ($first->d > $second->d) {
            return 1;
        }

        if ($first->d < $second->d) {
            return -1;
        }

        if ($first->h > $second->h) {
            return 1;
        }

        if ($first->h < $second->h) {
            return -1;
        }

        if ($first->i > $second->i) {
            return 1;
        }

        if ($first->i < $second->i) {
            return -1;
        }

        if ($first->s > $second->s) {
            return 1;
        }

        if ($first->s < $second->s) {
            return -1;
        }

        return 0;
    }

    protected function safecheck(\DateInterval $interval)
    {
        if ($interval->m > 12) {
            throw new \UnexpectedValueException('Month exceeds value 12');
        }

        if ($interval->d > 31) {
            throw new \UnexpectedValueException('Day exceeds value 31');
        }

        if ($interval->h > 24) {
            throw new \UnexpectedValueException('Hour exceeds value 24');
        }

        if ($interval->i > 60) {
            throw new \UnexpectedValueException('Minute exceeds value 60');
        }

        if ($interval->s > 60) {
            throw new \UnexpectedValueException('Day exceeds value 60');
        }

    }
}
