<?php 
    function convertDate($date){
        $date = date_create($date);
        return date_format($date, "m/d/Y");
    }
?>