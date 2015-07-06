<?php
require 'gapi.class.php';
define('ga_profile_id','85776034');

$ga = new gapi("305454685596-4mea8ua6gc5vehhldjo6gdsb1ssbfv9e@developer.gserviceaccount.com", "api-project-ed2efb894110.p12");

$ga->requestReportData(ga_profile_id,array('browser','browserVersion'),array('pageviews','visits','bounces','sessionDuration'));



?>
<table>
<!--
<tr>
  <th>Browser &amp; Browser Version</th>
  <th>Pageviews</th>
  <th>Visits</th>
</tr>
<?php
foreach($ga->getResults() as $result):
?>
<tr>
  <td><?php echo $result ?></td>
  <td><?php echo $result->getPageviews() ?></td>
  <td><?php echo $result->getVisits() ?></td>
</tr>
<?php
endforeach
?>
-->
</table>

<table>
<tr>
  <th>Total Results</th>
  <td><?php echo $ga->getTotalResults() ?></td>
</tr>
<tr>
  <th>Total Pageviews</th>
  <td><?php echo $ga->getPageviews() ?>
</tr>
<tr>
  <th>Total Visits</th>
  <td><?php echo $ga->getVisits() ?></td>
</tr>
<tr>
  <th>Total Bounces</th>
  <td><?php echo $ga->getBounces() ?></td>
</tr>
<tr>
  <th>Bounce Rate</th>
  <td><?php echo $ga->getBounces() / $ga->getVisits() ?></td>
</tr>
<tr>
  <th>Session Duration</th>
  <td><?php echo $ga->getSessionDuration() / $ga->getVisits() ?></td>
</tr>
</table>