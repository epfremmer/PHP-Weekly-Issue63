<?php
/**
 * File StarDate.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue63;

use DateTime;
use DateTimeZone;
use LogicException;

/**
 * Class Stardate
 *
 * @package PHPWeekly\Issue63
 */
class Stardate extends DateTime
{
    /**
     * Stardate 00000.0
     *
     * Started on Friday, July 5, 2318, around noon (Starfleet Command time)
     * (a.k.a Fri Jul 05 2318 12:00:00 GMT-0500 (CDT))
     *
     * @var float
     */
    const STARDATE_EPOCH = 10997830800;

    /**#@+
     *
     * Stardate to standard time constants
     *
     * @var float
     */
    const STARDATE_PER_YEAR    = 918.23186;
    const DAY_PER_STARDATE     = 0.397766856;
    const SECONDS_PER_STARDATE = 34367.0564;
    /**#@-*/

    /**
     * StarDate constructor
     *
     * {@inheritDoc}
     *
     * @param string $time
     */
    public function __construct($time = 'now')
    {
        if ($time === 'now') {
            return parent::__construct($time);
        }

        if (!is_numeric($time)) {
            throw new LogicException(
                sprintf('Stardates *MUST* be numeric. Got "%s".', is_scalar($time) ? $time : gettype($time))
            );
        }

        $timestamp = $this->stardateToTimestamp($time);

        return parent::__construct("@$timestamp");
    }

    /**
     * Return scalar stardate
     *
     * @return float
     */
    public function getStardate()
    {
        return $this->timestampToStardate($this->getTimestamp());
    }

    /**
     * Convert federation stardate to epoch timestamp
     *
     * @param float|int $stardate
     * @return int
     */
    public static function stardateToTimestamp($stardate)
    {
        return (int) round(self::STARDATE_EPOCH + ($stardate * self::SECONDS_PER_STARDATE));
    }

    /**
     * Convert epoch timestamp to federation stardate
     *
     * @param int $timestamp
     * @param int $precision
     * @return float
     */
    public static function timestampToStardate($timestamp, $precision = 1)
    {
        return (float) round(($timestamp - self::STARDATE_EPOCH) / self::SECONDS_PER_STARDATE, $precision);
    }

    /**
     * Create a new Stardate from a stardate scalar value
     *
     * @param float $stardate
     * @return static
     */
    public static function createFromStardate($stardate)
    {
        return new static($stardate);
    }

    /**
     * Create a new Stardate from an epoch timestamp
     *
     * @param int $timestamp
     * @return static
     */
    public static function createFromTimestamp($timestamp)
    {
        return new static(self::timestampToStardate($timestamp, 100));
    }

    /**
     * Create a new Stardate from a formatted date string
     *
     * @param string $time
     * @param DateTimeZone|null $timezone
     * @return Stardate
     */
    public static function createFromDateString($time, DateTimeZone $timezone = null)
    {
        return self::createFromDateTime(new parent($time, $timezone));
    }

    /**
     * Create a new Stardate from an existing DateTime object
     *
     * @param DateTime $datetime
     * @return static
     */
    public static function createFromDateTime(DateTime $datetime)
    {
        return new static(self::timestampToStardate($datetime->getTimestamp(), 100));
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        return self::createFromDateTime(parent::createFromFormat($format, $time, $timezone));
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return (string) $this->getStardate();
    }

    /**
     * {@inheritDoc}
     */
    public function __debugInfo()
    {
        return array_replace(['stardate' => $this->getStardate()], get_object_vars($this));
    }
}
