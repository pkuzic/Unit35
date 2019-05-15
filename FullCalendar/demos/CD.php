<?php
$return_array = array();
        while ($row = mysql_fetch_array($sth)) 
        {
            $event_array = array();
            $event_array['id'] = $row['e_id'];
            $date_start = $row['e_date_start'];
            $date_end   = $row['e_date_end'];
                $date_start = explode(" ",$date_start);
                $date_end   = explode(" ", $date_end);
                $date_start[0] = str_replace('-' , '/' , trim($date_start[0]));
                $date_end[0] = str_replace('-' , '/' , trim($date_end[0]));
                //Event Title Structure
            if($row['e_title'] != "")
            {
                $event_array['title'] = $row['e_title'];
                    //Start Date Structure
                    if($date_start[0] != "0000/00/00" && $date_start[1] != "00:00:00")
                    {

                        $event_array['start'] = date(DATE_ISO8601, strtotime($date_start[0]." ".$date_start[1]));
                    }

                    //End Date Structure
                    if($date_end[0] != "0000/00/00" && $date_end[1] != "00:00:00")
                    {

                        $event_array['end'] = date(DATE_ISO8601, strtotime($date_end[0]." ".$date_end[1]));
                    }

                    //All Day Event Structure
                    if($row['e_allday'] == '1')
                    {
                        $event_array['allDay'] = true;

                    }
                    elseif($row['e_allday'] == '0') 
                    {
                        $event_array['allDay'] = false;
                    }

                array_push($return_array, $event_array);
            }
        }
        echo json_encode($return_array);
?>