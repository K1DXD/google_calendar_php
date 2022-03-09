<?php

function authenticate(&$client) {
	if (isset($_GET['logout'])) {
		unset($_SESSION['token']);
	}

	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['token'] = $client->getAccessToken();
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	}

	if (isset($_SESSION['token'])) {
		$client->setAccessToken($_SESSION['token']);
	}

	return isAuthenticated($client);
}

function createCalendar(&$client) {
	return new Google_Service_Calendar($client);
}

function isAuthenticated(Google_Client &$client) {
	createCalendar($client);
	if ($client->getAccessToken()) {
		$_SESSION['token'] = $client->getAccessToken();
		return true;
	}

	$authUrl = $client->createAuthUrl();
	print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

function listAllCalendars(Google_Client &$client) {
	if (!isAuthenticated($client))
		return;

	// $calList = createCalendar($client)->calendarList->listCalendarList();
	$calendarId = 'primary';
	$optParams = array(
  	'maxResults' => 10,
  	'orderBy' => 'startTime',
  	'singleEvents' => true,
  	'timeMin' => date('c'),
	);
	$results = createCalendar($client)->events->listEvents($calendarId, $optParams);
	$events = $results->getItems();

	if (empty($events)) {
    print "<h1>Upcoming events</h1><br><p>No upcoming events found.</p>";
	} else {
    print "<h1>Upcoming events</h1><br>";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    	}
	}
	//print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
}

function getCalendarList($client) {
	return createCalendar($client)->calendarList->listCalendarList();
}

function getCalendar($client, $id) {
	return createCalendar($client)->calendars->get($id);
}

function getEventList($client, $calendarId) {
	return createCalendar($client)->events->listEvents(htmlspecialchars($calendarId));
}

function getEvent($client, $eventID) {
	return createCalendar($client)->events->listEvents(htmlspecialchars($calendarId));
}

?>
