<?php
require 'vendor/autoload.php';
date_default_timezone_set('America/New_York');

// the following is adapted from v1.1 github.com/jobapis/jobs-multi/blob/master/README.md

// Include as many or as few providers as you want. Just be sure to include any required keys.
// GP: here I include only those providers who may not need authentication
$providers = [
    'Careercast' => [],
    'Dice' => [],
    'Github' => [],
    'Govt' => [],
    'Ieee' => [],
    'Jobinventory' => [],
    'Monster' => [],
    'Stackoverflow' => [],
];

// Instantiate a new JobsMulti client
$client = new \JobApis\Jobs\Client\JobsMulti($providers);

// Set the parameters: Keyword, Location, Page
$client->setKeyword('training')
    // Location must be formatted "City, ST".
    ->setLocation('chicago, il')
    ->setPage(1, 10);

// Make queries to each individually
$indeedJobs = $client->getJobsByProvider('Indeed');
echo print_r($indeedJobs);

// And include an array of options if you'd like
$options = [
    'maxAge' => 30,              // Maximum age (in days) of listings
    'maxResults' => 100,         // Maximum number of results
    'orderBy' => 'datePosted',   // Field to order results by
    'order' => 'desc',           // Order ('asc' or 'desc')
];
$diceJobs = $client->getJobsByProvider('Dice', $options);
echo print_r($diceJobs);

// Or get an array with results from all the providers at once
$jobs = $client->getAllJobs($options);
echo print_r($jobs);
