<?php
/**
 * File index.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
//
//$tz1 = new DateTimeZone('UTC');
//$tz2 = new DateTimeZone('America/Chicago');
//
////var_dump($tz1, $tz2);
//
//$date1 = new DateTime(sprintf('@%s', (new DateTime('now', $tz1))->getTimestamp()));
//$date2 = new DateTime(sprintf('@%s', (new DateTime('now', $tz2))->getTimestamp()));
//
//var_dump($date1, $date2);

use PHPWeekly\Issue63\Stardate;

require_once 'src/StarDate.php';


$time = time();
$date = new DateTime("@$time");

var_dump($time, $date->getTimestamp(), Stardate::stardateToTimestamp(Stardate::timestampToStardate($time)));


//$sdn = new Stardate();
//$sd0 = Stardate::createFromDateString('Fri Jul 05 2318 12:00:00 GMT-0500 (CDT)');
//$sd1 = new Stardate('1.0');
//$sd2 = new Stardate(54868.6);
//
//var_dump(
//    $sdn, $sdn->getTimestamp(), $sdn->getStardate(),
//    $sd0, $sd0->getTimestamp(), $sd0->getStardate(),
//    $sd1, $sd1->getTimestamp(), $sd1->getStardate(),
//    $sd2, $sd2->getTimestamp(), $sd2->getStardate()
//);

//$sd1 = new StarDate('54868.6');

//var_dump(
//    StarDate::stardateToTimestamp(54868.6),
//    StarDate::stardateToTimestamp(0)
//);


//var_dump(strtotime(123));
//var_dump(strtotime('123'));
//var_dump(strtotime('*123'));
//var_dump(strtotime(54868.6));
//var_dump(strtotime('*54868.6'));
//var_dump(strtotime(''));
//var_dump(strtotime(''));
//var_dump(strtotime(''));
