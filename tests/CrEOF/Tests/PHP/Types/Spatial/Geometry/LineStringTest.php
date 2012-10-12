<?php
/**
 * Copyright (C) 2012 Derek J. Lambert
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace CrEOF\Tests\PHP\Types\Spatial\Geometry;

use CrEOF\PHP\Types\Spatial\Geometry\LineString;
use CrEOF\PHP\Types\Spatial\Geometry\Point;

/**
 * LineString object tests
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
class LineStringTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyLineString()
    {
        $lineString = new LineString(array());

        $this->assertEmpty($lineString->getPoints());
    }

    public function testGoodLineString()
    {
        $lineString = new LineString(array(
            new Point(0, 0),
            new Point(1, 1),
            new Point(2, 2),
            new Point(3, 3)
        ));

        $this->assertCount(4, $lineString->getPoints());
    }

    /**
     * Test LineString bad parameter
     *
     * @expectedException        \CrEOF\Exception\InvalidValueException
     * @expectedExceptionMessage Value needs to be of type "Point", is "integer".
     */
    public function testBadLineString()
    {
        $lineString = new LineString(array(1, 2, 3 ,4));
    }

    public function testToStringLineString()
    {
        $lineString = new LineString(array(
            new Point(0, 0),
            new Point(10, 0),
            new Point(10, 10),
            new Point(0, 10)
        ));
        $result = (string) $lineString;

        $this->assertEquals('LINESTRING(0 0,10 0,10 10,0 10)', $result);
    }
}
