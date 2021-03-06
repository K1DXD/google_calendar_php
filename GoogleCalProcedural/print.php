<?php
    class printStuff{

        function putEvent($event){
            $this->putTitle('Details for event: '. $event['summary']);
            $this->putBlock('This event has status ' . $event['status']);
            $this->putBlock('It was created at ' .
                    date('Y-m-d H:m', strtotime($event['created'])) .
                    ' and last updated at ' .
                    date('Y-m-d H:m', strtotime($event['updated'])) . '.');
            $this->putBlock('For this event you have to <strong>' . $event['summary'] . '</strong>.');
        }
    
        function putCalendarListTitle(){
            $this->putTitle('These are your calendars:');
        }
    
        function putCalendarTitle(){
            $this->putTitle('These are you events for ' . getCalendar($_GET['showThisCalendar'])['summary'] . ' calendar:');
        }
    
        function putCalendarListElement($calendar){
            $this->putLink('?action=printCalendarContents&showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
            print('<br>');
        }
        
        function putEventListElement($event){
            print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
            $this->putLink('?action=printEventDetails&showThisEvent=' . htmlentities($event['id']) .
                    '&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
            print('</div>');
            print('<br>');
        }

        function putLink($href, $text) {
            print(sprintf('<a href="%s" style="font-size:12px;margin-left:10px;">%s</a> | ', $href, $text));
        }
        
        function putTitle($text) {
            print(sprintf('<h3 style="font-size:16px;color:green;">%s</h3>', $text));
        }
        
        function putBlock($text) {
            print('<div display="block">'.$text.'</div>');
        }

    }
?>