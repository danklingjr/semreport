<?php
require 'gapi.class.php';

$ga = new gapi("305454685596-4mea8ua6gc5vehhldjo6gdsb1ssbfv9e@developer.gserviceaccount.com", "api-project-ed2efb894110.p12");

$ga->requestAccountData();

foreach($ga->getAccounts() as $result)
{
  echo $result . ' ' . $result->getId() . ' (' . $result->getProfileId() . ")<br />";
}
