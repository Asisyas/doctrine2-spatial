<?php
/**
 * Created by PhpStorm.
 * User: kost
 * Date: 26.12.17
 * Time: 18:42
 */

namespace CrEOF\Spatial\PHP\Types;


use CrEOF\Spatial\Exception\InvalidValueException;
use CrEOF\Geo\String\Exception\RangeException;
use CrEOF\Geo\String\Exception\UnexpectedValueException;
use CrEOF\Geo\String\Parser;


class AbstractCircle extends AbstractGeometry
{
    /**
     * @var float - radius
     */
    protected $r;

    /**
     * @var float $x
     */
    protected $x;

    /**
     * @var float $y
     */
    protected $y;

    /**
     * @param $r
     * @return $this
     * @throws InvalidValueException
     */
    public function setR($r)
    {
        if ($r <= 0) {
            throw new InvalidValueException(sprintf('Invalid radius value "%s", must be greater than 0.', $r));
        }

        $this->r = $r;

        return $this;
    }

    /**
     * @return float
     */
    public function getR()
    {
        return $this->r;
    }
    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->x,
            $this->y,
            $this->r,
            ];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return self::CIRCLE;
    }

    /**
     * AbstractCircle constructor.
     * @param $x
     * @param $y
     * @param $r
     * @param null $srid
     * @throws InvalidValueException
     */
    public function __construct($x, $y, $r, $srid = null)
    {
        $this->setX($x)
            ->setY($y)
            ->setR($r)
            ->setSrid($srid);
    }

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
            $this->x = (float) $parser->parse();
        } catch (RangeException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (UnexpectedValueException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
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
            $this->y = (float) $parser->parse();
        } catch (RangeException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (UnexpectedValueException $e) {
            throw new InvalidValueException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }


    /**
     * @param $latitude
     * @return AbstractCircle
     * @throws InvalidValueException
     */
    public function setLatitude($latitude)
    {
        return $this->setY($latitude);
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->getY();
    }

    /**
     * @param $longitude
     * @return AbstractCircle
     * @throws InvalidValueException
     */
    public function setLongitude($longitude)
    {
        return $this->setX($longitude);
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->getX();
    }
}
