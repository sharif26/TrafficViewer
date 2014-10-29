
{
        if($1=="Tot"){
                c = $4; 
        }
        else if($1=="Statistics"){
                DATE_TIME=$4" "$5" "$6" "$7;
        }
        else a=$1;
}
END{
print "INSERT INTO SDP."NODE"_ppas_traffic (DATE_TIME,NODE,TOTAL) VALUES (STR_TO_DATE('"DATE_TIME"','%b %e %H:%i:%s %Y'),'"a"',"c");"
}
