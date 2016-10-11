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

namespace Org_Heigl\DateIntervalComparatorTest;

use Org_Heigl\DateIntervalComparator\DateIntervalComparator;

class DateIntervalComparatorTest extends \PHPUnit_Framework_TestCase
{
    public function testThatDifferentYearsResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('P1Y'), new \DateInterval('P2Y')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('P2Y'), new \DateInterval('P1Y')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('P1Y'), new \DateInterval('P1Y')));
    }

    public function testThatDifferentMonthsResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('P1M'), new \DateInterval('P2M')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('P2M'), new \DateInterval('P1M')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('P1M'), new \DateInterval('P1M')));
    }

    public function testThatDifferentDaysResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('P1D'), new \DateInterval('P2D')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('P2D'), new \DateInterval('P1D')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('P1D'), new \DateInterval('P1D')));
    }

    public function testThatDifferentHoursResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('PT1H'), new \DateInterval('PT2H')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('PT2H'), new \DateInterval('PT1H')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('PT1H'), new \DateInterval('PT1H')));
    }

    public function testThatDifferentMinutesResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('PT1M'), new \DateInterval('PT2M')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('PT2M'), new \DateInterval('PT1M')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('PT1M'), new \DateInterval('PT1M')));
    }

    public function testThatDifferentSecondsResolveCorrect()
    {
        $comparator = new DateIntervalComparator();
        $this->assertEquals(-1, $comparator->compare(new \DateInterval('PT1S'), new \DateInterval('PT2S')));
        $this->assertEquals(1, $comparator->compare(new \DateInterval('PT2S'), new \DateInterval('PT1S')));
        $this->assertEquals(0, $comparator->compare(new \DateInterval('PT1S'), new \DateInterval('PT1S')));
    }

    /** @dataProvider dateDiffResolvesCorrectlyProvider */
    public function testThatDateDiffResolvesCorrectly($interval1, $interval2, $expected)
    {
        $comparator = new DateIntervalComparator();

        $this->assertEquals($expected, $comparator->compare($interval1, $interval2));
    }

    public function dateDiffResolvesCorrectlyProvider()
    {
        return [
            [new \DateInterval('P1Y2M3DT11H12M23S'), new \DateInterval('P1Y2M3DT11H12M23S'), 0],
            [new \DateInterval('P1Y2M2DT11H12M23S'), new \DateInterval('P1Y2M3DT11H12M23S'), -1],
            [(new \DateTime('2016-02-28 12:00:00'))->diff(new \DateTime('2016-03-01 12:00:00')), new \DateInterval('P2D'), 0],
            [(new \DateTime('2015-02-28 12:00:00'))->diff(new \DateTime('2015-03-01 12:00:00')), new \DateInterval('P2D'), -1],
            [(new \DateTime('2015-02-28 12:00:00'))->diff(new \DateTime('2015-03-01 12:00:00')), new \DateInterval('P1D'), 0],
        ];
    }
}
