<?php
	class Logic {

		function getCalendar() {
			global $client;
			return getCalendarList($client)['items'];
		}
				
		function getEventsForCalendar($calendarId) {
			global $client;
			return getEventList($client, $calendarId)['items'];
		}

		function getEventById($eventId, $calendarId) {
			foreach ($this->getEventsForCalendar($calendarId) as $event)
				if ($event['id'] == $eventId)
					return $event;
		}		
	}
?>