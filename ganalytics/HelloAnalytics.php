<!doctype html>
<html>
  <head>
    <title>Bar Chart</title>
    <script src="./js/Chart.min.js"></script>
  </head>
  <body>
    
<?php

function getService()
{
  // Creates and returns the Analytics service object.

  // Load the Google API PHP Client Library.
  require_once 'src/Google/autoload.php';

  // Use the developers console and replace the values with your
  // service account email, and relative location of your key file.
  $service_account_email = '305454685596-4mea8ua6gc5vehhldjo6gdsb1ssbfv9e@developer.gserviceaccount.com';
  $key_file_location = 'api-project-ed2efb894110.p12';

  // Create and configure a new client object.
  $client = new Google_Client();
  $client->setApplicationName("HelloAnalytics");
  $analytics = new Google_Service_Analytics($client);

  // Read the generated client_secrets.p12 key.
  $key = file_get_contents($key_file_location);
  $cred = new Google_Auth_AssertionCredentials(
      $service_account_email,
      array(Google_Service_Analytics::ANALYTICS_READONLY),
      $key
  );
  $client->setAssertionCredentials($cred);
  if($client->getAuth()->isAccessTokenExpired()) {
    $client->getAuth()->refreshTokenWithAssertion($cred);
  }

  return $analytics;
}

$profileId = '85776034';
// ///////////////////////////////////
//GET SESSIONS
// ///////////////////////////////////
function getSessions(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '30daysAgo',
       '2015-06-29',
       'ga:sessions');
}
//GET SESSIONS FROM 3 MONTHS AGO
function getSessionsThree(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '150daysAgo',
       '120daysAgo',
       'ga:sessions');
}
//GET SESSIONS FROM ONE YEAR AGO
function getSessionsYear(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '365daysAgo',
       '335daysAgo',
       'ga:sessions');
}


// ///////////////////////////////////
//GET SESSION DURATION
// ///////////////////////////////////
function getSessionDuration(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '30daysAgo',
       '2015-06-29',
       'ga:sessionDuration');
}
//GET SESSION DURATION FROM ONE YEAR AGO
// ///////////////////////////////////
function getSessionDurationThree(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '150daysAgo',
       '120daysAgo',
       'ga:sessionDuration');
}
//GET SESSION DURATION FROM ONE YEAR AGO
// ///////////////////////////////////
function getSessionDurationYear(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
    return $analytics->data_ga->get(
       'ga:' . $profileId,
       '365daysAgo',
       '335daysAgo',
       'ga:sessionDuration');
}

// ///////////////////////////////////
//PRINT SESSIONS
// ///////////////////////////////////
function printSessions(&$results) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $results->getRows();
    $sessions = $rows[0][0];
    

    // Print the results.
    ?>
    <script>
      var sessionCurrent = <?php print "$sessions\n"; ?>;
    </script>
    <!-- <h1><?php print "Last month: $profileName\n"; ?></h1>
    <h2><?php print "Total sessions: $sessions\n"; ?></h2> -->
<?php

  } else {
    print "No results found.\n";
  }
}
function printSessionsThree(&$resultsThree) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($resultsThree->getRows()) > 0) {

    // Get the profile name.
    $profileName = $resultsThree->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $resultsThree->getRows();
    $sessions = $rows[0][0];
    

    // Print the results.
    ?>
    <script>
      var sessionThree = <?php print "$sessions\n"; ?>;
    </script>
    <!-- <hr>
    <h1><?php print "Three months ago: $profileName\n"; ?></h1>
    <h2><?php print "Total sessions: $sessions\n"; ?></h2> -->
<?php
  } else {
    print "No results found.\n";
  }
}
function printSessionsYear(&$resultsOld) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($resultsOld->getRows()) > 0) {

    // Get the profile name.
    $profileName = $resultsOld->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $resultsOld->getRows();
    $sessions = $rows[0][0];
    

    // Print the results.
    ?>
    <script>
      var sessionYear = <?php print "$sessions\n"; ?>;
    </script>
    <!-- <hr>
    <h1><?php print "A year ago: $profileName\n"; ?></h1>
    <h2><?php print "Total sessions: $sessions\n"; ?></h2> -->
    
    <?php
    

  } else {
    print "No results found.\n";
  }
}

// ///////////////////////////////////
//PRINT SESSION DURATION
// ///////////////////////////////////
function printSessionDuration(&$resultsDuration) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($resultsDuration->getRows()) > 0) {

    // Get the profile name.
    $profileName = $resultsDuration->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $resultsDuration->getRows();
    $sessionDuration = $rows[0][0];
    

    // Print the results.
    ?>
    <!-- <hr>
    <h1><?php print "Last month: $profileName\n"; ?></h1>
    <h2><?php print "Session Duration: $sessionDuration\n"; ?></h2> -->
<?php
  } else {
    print "No results found.\n";
  }
}
function printSessionDurationThree(&$resultsDurationThree) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($resultsDurationThree->getRows()) > 0) {
    // Get the profile name.
    $profileName = $resultsDurationThree->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $resultsDurationThree->getRows();
    $sessionDuration = $rows[0][0];
   
    // Print the results.
    ?>
    <!-- <hr>
    <h1><?php print "Three months ago: $profileName\n"; ?></h1>
    <h2><?php print "Session Duration: $sessionDuration\n"; ?></h2> -->
    <?php
    

  } else {
    print "No results found.\n";
  }
}
function printSessionDurationYear(&$resultsDurationOld) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($resultsDurationOld->getRows()) > 0) {
    // Get the profile name.
    $profileName = $resultsDurationOld->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $resultsDurationOld->getRows();
    $sessionDuration = $rows[0][0];
   
    // Print the results.
    ?>
    <!-- <hr>
    <h1><?php print "A year ago: $profileName\n"; ?></h1>
    <h2><?php print "Session Duration: $sessionDuration\n"; ?></h2> -->
    <?php
    

  } else {
    print "No results found.\n";
  }
}


$analytics = getService();
$profile = $profileId;

$results = getSessions($analytics, $profile);
$resultsThree = getSessionsThree($analytics, $profile);
$resultsOld = getSessionsYear($analytics, $profile);

$resultsDuration = getSessionDuration($analytics, $profile);
$resultsDurationThree = getSessionDurationThree($analytics, $profile);
$resultsDurationOld = getSessionDurationYear($analytics, $profile);

printSessions($results);
printSessionsThree($resultsThree);
printSessionsYear($resultsOld);

printSessionDuration($resultsDuration);
printSessionDurationThree($resultsDurationThree);
printSessionDurationYear($resultsDurationOld);

?>
<div style="width: 50%">
      <canvas id="canvas" height="450" width="600"></canvas>
    </div>

<script>
  var barChartData = {
    labels : ["One Year","Three Months","Current"],
    datasets : [

      {
        fillColor : "rgba(195,213,0,0.5)",
        strokeColor : "rgba(195,213,0,0.8)",
        highlightFill : "rgba(195,213,0,0.75)",
        highlightStroke : "rgba(195,213,0,1)",
        data: [sessionYear, sessionThree, sessionCurrent]
      }
    ]

  }
  window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
      responsive : true
    });
  }

  </script>
  </body>
</html>
