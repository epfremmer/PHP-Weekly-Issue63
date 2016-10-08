Challenge 063: Stardate
==========================================

[![Build Status](https://travis-ci.org/epfremmer/PHP-Weekly-Issue63.svg?branch=master)](https://travis-ci.org/epfremmer/PHP-Weekly-Issue63)
[![Coverage Status](https://coveralls.io/repos/github/epfremmer/PHP-Weekly-Issue63/badge.svg?branch=master)](https://coveralls.io/github/epfremmer/PHP-Weekly-Issue63?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/epfremmer/PHP-Weekly-Issue63/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/epfremmer/PHP-Weekly-Issue63/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/66365e8d-c6ac-4835-a7e8-00978e5bed1f/mini.png)](https://insight.sensiolabs.com/projects/66365e8d-c6ac-4835-a7e8-00978e5bed1f)

# Overview

In preparation for interplanetary space travel and humans living on planets other than earth, we are going to need a new 
system for expressing dates. Star Trek kinda already did this in the future for us, with the stardate system. We’re going 
to need some functions to translate earth dates into stardates (and vice versa). Your challenge is to write a function 
that converts and earth date (ie. 2016-10-05) into a stardate.

This [web page](http://trekguide.com/Stardates.htm) provides details on how stardates are calculated. Here is a summary of what you need to know:

 * Stardate 00000.0 started on Friday, July 5, 2318, around noon (Starfleet Command time).
 * There are 918.23186 Stardates per earth year.
 * (0.397766856 day to 1.0 Stardate, or 1.0 Stardate to 34,367.0564 seconds)

For dates before July 5, 2318, use negative numbers to represent Stardates (None of this YYMM.DD nonsense). If you want to 
check your logic, target The Next Generation Stardate calculator here: [http://trekguide.com/Stardates.htm#TNGcalculator.](http://trekguide.com/Stardates.htm#TNGcalculator)

# Stardate Examples

## Stardate Construct

```php
$stardate = new Stardate(); // now
$stardate = new Stardate('now'); // now
$stardate = new Stardate(1234.5); // stardate 1234.5 (Sat Nov 08 2319 12:02:11 GMT-0600 (CST))
```
    
## Create from Stardate

```php
$stardate = Stardate::createFromStardate(1234.5);
```
    
## Create from Timestamp

```php
$stardate = Stardate::createFromTimestamp(time());
$stardate = Stardate::createFromTimestamp(1475891080);
```
    
## Create from Date String

```php
$stardate = Stardate::createFromDateString('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)');
$stardate = Stardate::createFromDateString('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));
```

## Create from DateTime

```php
$stardate = Stardate::createFromDateTime(new DateTime('Sat Nov 08 2319 12:02:11 GMT-0600 (CST)'));
$stardate = Stardate::createFromDateTime(new DateTime('Sat Nov 08 2319 12:02:11', new DateTimeZone('America/Los_Angeles')));
```
    
## Create from Date Format

```php
$stardate = Stardate::createFromFormat(DateTime::RFC2822, 'Sat, 08 Nov 2319 12:02:11 -0800');
$stardate = Stardate::createFromFormat('D, d M Y H:i:s', 'Sat, 08 Nov 2319 12:02:11', new DateTimeZone('America/Los_Angeles'));
```
    
