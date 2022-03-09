<?php

    class Presenter{

        private $logic;
        private $print;

        function __construct(){
            $this->logic = new Logic();
            $this->print = new printStuff();
        }

        function printCalendars() {
			$this->print->putCalendarListTitle();
			foreach ($this->logic->getCalendar() as $calendar) {
				$this->print->putCalendarListElement($calendar);
			}
		}

        function printCalendarContents() {
			$this->print->putCalendarTitle();
            $eventForCalendar = $this->logic->getEventsForCalendar(htmlspecialchars($_GET['showThisCalendar']));
			foreach ($eventForCalendar as $event) {
				$this->print->putEventListElement($event);
			}
		}

        function printEventDetails() {
            $this->print->putEvent(
                $this->logic->getEventById(
                    $_GET['showThisEvent'],
                    $_GET['calendarId']
                )
            );
        }

        function putHome() {
            print('Welcome to Google Calendar over NetTuts Example');
        }
        
        function putMenu() {
            $this->print->putLink('?action=putHome', 'Home');
            $this->print->putLink('?action=printCalendars', 'Show Calendars');
            $this->print->putLink('?logout', 'Log Out');
            print('<br><br>');
        }

    }

?>