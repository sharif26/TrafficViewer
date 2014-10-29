
{
        if($2=="Diameter"){
        c = $7; 
        DATE_TIME=DATE" "$1;
        }
        else a=$1;
}
END{
print "INSERT INTO SDP."NODE"_inap_traffic (DATE_TIME,NODE,TOTAL) VALUES (STR_TO_DATE('"DATE_TIME"','%m-%d-%y %H:%i:%s'),'"a"',"c");"
}
