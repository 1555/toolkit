<?php
require_once 'OmnitureMeasurement.class.php';

$s = new OmnitureMeasurement();

/* Specify the Report Suite ID(s) to track here */
$s->account = 'REPORTSUITE_ID_GOES_HERE';

/* You may add or alter any code config here */
$s->pageName = '';
$s->pageURL = '';

$s->currencyCode = 'USD';
$s->cookieDomainPeriods = 2;

/* Turn on and configure debugging here */
$s->debugTracking = true;

/* WARNING: Changing any of the below variables will cause drastic changes
to how your visitor data is collected.  Changes should only be made
when instructed to do so by your account manager.*/
$s->trackingServer = 'nbcuniversal.122.2o7.net';
?>
