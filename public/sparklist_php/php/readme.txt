PHP SOAP Client Guide



1) Copy lmapiTest.php to web accessible directory

2) Unzip NuSoap (included) into the same directory
[YOURDIR]
      |
      |_ lmapiTest.php
      |_ lib/
      |_ samples/

3) Point your browser to the location http://[YOURSERVER]/[YOURDIR_LOCATION]/lmapiTest.php


4) PHP version notes:

Files are set by default to work under PHP5, but if you want to use it with an earlier version (PHP4) 
you need to overwrite file lib/nusoap.php with nusoap_php4.php and lmapiTest.php with lmapiTest_php4.php.
If you ever wanted to take that change back and work again with php version 5, just overwrite nusoap.php 
with nusoap_php5.php and lmapiTest.php with lmapiTest_php5.php