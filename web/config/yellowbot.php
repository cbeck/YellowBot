<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Yellowbot API Configuration
$config['api_url'] = "http://rep.ubl.org";
//$config['api_key'] = "59667cf953f4c37f0d760c003a287972";
//$config['api_secret'] = "f89d48e031440891";

//$config['api_url'] = "http://rep.locationmonitor.com";
$config['api_key'] = "c7cbf3afd2cedd3c69cd091a8f2e7347";
$config['api_secret'] = "66f4cdbbd65cb13a";

//Payment Processing Service URL
$config['payment_service_url'] =  "https://qa.ubl.org/payment.svc";
//$config['payment_service_url'] =  "https://www.ubl.org/payment.svc";

//Default Price
$config['default_price'] = '19.95';

//Default Frequency
$config['default_frequency'] = "12";

//Unregistered business message
$config['unregistered_business_label'] = "<p>Thank you for your subscription to LocationMonitor.com. You are seeing this page because the business
you submitted has not yet been added to the database for search. This is currently under review and will
be added in the next 48 hours.</p>

<p>Please note it takes a few days for our search technology to begin gathering enough information about
your business to display in the dashboard. It is an incremental process that will provide more results
over time.</p>

<p>Once it displays in the dashboard, please make sure to go to the notification tab on the site and
enter the email address to which you want reports and alerts to be sent. Alerts will be sent within 30
minutes of new data appearing, but we will only send one alert a day so your email system does not get
overloaded.</p>";

//Email Configuration
$config['confirmation_email_name'] = "LocationMonitor.com";
$config['confirmation_email_from'] = "confirmation@locationmonitor.com";
$config['confirmation_email_subject'] = "LocationMonitor.com Confirmation #"; //Append confirmation number to subject
$config['confirmation_email_body'] = "<p>Thank you for registering your business with LocationMonitor.com - a 
service of UniversalBusinessListing.org. Please note you will see the UBL name on your credit card
statement. Your card will be billed quarterly in advance unless you notify us of cancellation at
contact@locationmonitor.com.</p>

<p>Some important facts:<br /><br />

Now that you have registered, our search technology will begin to gather information about your
business - it may take a few days to gather all the information, so please allow some time for this to
display. It is an incremental process that will provide more results over time. If your business did not
show up immediately, be assured we are adding it to our search system.</p>

<p>You should make sure you go to the notification tab on the site and enter the email address to which
you want reports and alerts to be sent. Alerts will be sent within 30 minutes of new data appearing, but
we will only send one alert a day so your email system does not get overloaded.</p>

If you have any questions, please email contact@locationmonitor.com.<br />
We thank you for your subscription.";

