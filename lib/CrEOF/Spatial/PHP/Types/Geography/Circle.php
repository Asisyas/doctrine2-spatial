<?php
/**
 * Created by PhpStorm.
 * User: kost
 * Date: 26.12.17
 * Time: 18:40
 */

namespace CrEOF\Spatial\PHP\Types\Geography;

use CrEOF\Spatial\PHP\Types\AbstractCircle;
use CrEOF\Geo\String\Exception\RangeException;
use CrEOF\Geo\String\Exception\UnexpectedValueException;
use CrEOF\Geo\String\Parser;
use CrEOF\Spatial\Exception\InvalidValueException;


class Circle extends AbstractCircle implements GeographyInterface
{
    /**
     * @param mixed $x
     *
     * @return self
     * @throws InvalidValueException
     */
    public function setX($x)
    {
        $parser = new Parser($x);

        try {
            $x = (float) $parser->parse();
        } catch (RangeException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (UnexpectedValueException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        if ($x < -180 || $x > 180) {
            throw new InvalidValueException(sprintf('Invalid longitude value "%s", must be in range -180 to 180.', $x));
        }

        $this->x = $x;

        return $this;
    }

    /**
     * @param mixed $y
     *
     * @return self
     * @throws InvalidValueException
     */
    public function setY($y)
    {
        $parser = new Parser($y);

        try {
            $y = (float) $parser->parse();
        } catch (RangeException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (UnexpectedValueException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        if ($y < -90 || $y > 90) {
            throw new InvalidValueException(sprintf('Invalid latitude value "%s", must be in range -90 to 90.', $y));
        }

        $this->y = $y;

        return $this;
    }
}