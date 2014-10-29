#!/bin/bash

hostname=`hostname`
len=${#hostname}
mem=${hostname:$len-1:1}
code=`printf $mem | od -An -t dC | head -1`
onetwo=`expr $code - 96`

sdp=${hostname::$len-1}
lmem=`echo $mem | tr "[:lower:]" "[:upper:]"`
while(true)
do
date=`date '+%m-%d-%y'`
echo $hostname > sendtoxion
#cat /tmp/PSC-SDPInap_8.1_A_$onetwo.stat.0 | egrep "Total" | tail -1 >> sendtoxion
cat /tmp/PSC-CIPDiameter_8.1_${lmem}_1.stat.0 | egrep "Diameter" | tail -1 >> sendtoxion

val=`diff data1 sendtoxion|wc -l`
if  [ $val -eq 0 ] ; 
then 
awk -f parse_cip0.awk NODE=$sdp DATE=$date sendtoxion > sendtoxion1  

else 
awk -f parse_cip.awk NODE=$sdp DATE=$date sendtoxion > sendtoxion1
fi

cp sendtoxion data1

#PPAS
echo `hostname` > sendppastoxion
cat /tmp/PSC-PPASInterface_8.2_${lmem}_$onetwo.stat | egrep "Tot|Stat" | tail -2 >> sendppastoxion 
awk -f parse_ppas.awk NODE=$sdp sendppastoxion > sendppastoxion1

#DUMMY_IP
ftp -in<<eof
open 10.10.33.33
user ftpuser ftpuser
bin
cd /files/sdp/data/
append sendtoxion1  sendtoxion

append sendppastoxion1 sendppastoxion
close
eof
sleep 10
done
