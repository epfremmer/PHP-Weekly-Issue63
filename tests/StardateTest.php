<?php
/**
 * File StardateTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue63\Tests;

use DateTime;
use DateTimeZone;
use LogicException;
use PHPUnit_Framework_TestCase;
use PHPWeekly\Issue63\Stardate;

/**
 * Class StardateTest
 *
 * @package PHPWeekly\Issue63\Tests
 */
class StardateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @group Stardate
     */
    public function testConstruct()
    {
        $stardate = new Stardate();
        $datetime = new DateTime();

        $this->assertInstanceOf(DateTime::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testConstructNow()
    {
        $stardate = new Stardate('now');
        $datetime = new DateTime('now');

        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testConstructWithStardate()
    {
        $stardate = new Stardate(1234.5);
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');

        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     * @expectedException \LogicException
     */
    public function testConstructException()
    {
        new Stardate('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
    }

    /**
     * @group Stardate
     */
    public function testGetStardate()
    {
        $stardate = new Stardate(1234.5);

        $this->assertEquals(1234.5, $stardate->getStardate());
    }

    /**
     * @group Stardate
     */
    public function testGetStardateNow()
    {
        $stardate = new Stardate('now');

        $this->assertEquals(Stardate::timestampToStardate(time()), $stardate->getStardate());
    }

    /**
     * @group Stardate
     */
    public function testStardateToTimestamp()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');

        $this->assertEquals($datetime->getTimestamp(), Stardate::stardateToTimestamp(1234.5));
    }

    /**
     * @group Stardate
     */
    public function testTimestampToStardate()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');

        $this->assertEquals(1234.5, Stardate::timestampToStardate($datetime->getTimestamp()));
    }

    /**
     * @group Stardate
     */
    public function testCreateFromStardate()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
        $stardate = Stardate::createFromStardate(1234.5);

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromTimestamp()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
        $stardate = Stardate::createFromTimestamp($datetime->getTimestamp());

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromDateString()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
        $stardate = Stardate::createFromDateString('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromDateStringWithTimezone()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));
        $stardate = Stardate::createFromDateString('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromDateTime()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
        $stardate = Stardate::createFromDateTime($datetime);

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromDateTimeWithTimezone()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));
        $stardate = Stardate::createFromDateTime($datetime);

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromFormat()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11 -0800');
        $stardate = Stardate::createFromFormat(DateTime::RFC2822, 'Sat, 08 Nov 2319 12:02:11 -0800');

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testCreateFromFormatWithTimezone()
    {
        $datetime = new DateTime('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));
        $stardate = Stardate::createFromFormat('D, d M Y H:i:s', 'Sat, 08 Nov 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));

        $this->assertInstanceOf(Stardate::class, $stardate);
        $this->assertEquals($datetime, $stardate);
    }

    /**
     * @group Stardate
     */
    public function testToString()
    {
        $stardate = new Stardate(1234.5);

        $this->assertEquals(1234.5, (string) $stardate);
    }

    /**
     * @group Stardate
     */
    public function testDebugInfo()
    {
        $stardate = new Stardate(1234.5);
        $expected = [
            'stardate' => 1234.5,
            'date' => '2319-11-08 18:02:11.000000',
            'timezone_type' => 1,
            'timezone' => '+00:00',
        ];

        $this->assertEquals($expected, $stardate->__debugInfo());
    }
}
