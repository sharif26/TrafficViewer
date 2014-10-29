<?php
#require_once("../lib/phpchartdir.php");
#require_once("/apps/web/in/reports/ChartDirector/lib/phpchartdir.php");

#connect to db
include("functions.php");
$cur_date = format_date();
$link = connect_to_db();

$sdp_init = 1;
$sdp_count = 66;

$sdpid=0;
for ($counter = $sdp_init; $counter <= $sdp_count; $counter ++) {

        if( $counter == 42 || $counter == 44 || $counter == 11 || $counter == 12 || $counter == 13 || $counter == 14 || $counter == 44 || $counter == 15 || $counter == 16 )
                continue;


$query= "select * from SDP.sdp{$counter}_ppas_traffic where node='sdp{$counter}a' order by tid desc limit 1 ";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_row($result)) {
   $dataA[$sdpid++] = $row[3];
   $timeA[] = $row[1];

  }
}

$sdpid=0;
for ($counter = $sdp_init; $counter <= $sdp_count; $counter ++) {
if( $counter == 42 || $counter == 44 || $counter == 11 || $counter == 12 || $counter == 13 || $counter == 14 || $counter == 44 || $counter == 15 || $counter == 16 )
        continue;


$query= "select * from SDP.sdp{$counter}_ppas_traffic where node='sdp{$counter}b' order by tid desc limit 1 ";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_row($result)) {
   $dataB[$sdpid++] = $row[3];

  }
}
# The age groups
$labels = array("SDP01","SDP02","SDP03","SDP04","SDP05","SDP06","SDP07","SDP08","SDP09","SDP10","SDP17","SDP18","SDP19","SDP20","SDP21","SDP22","SDP23","SDP24","SDP25","SDP26","SDP27","SDP28","SDP29","SDP30","SDP31","SDP32","SDP33","SDP34","SDP35","SDP36","SDP37","SDP38","SDP39","SDP40","SDP41","SDP43","SDP45","SDP46","SDP47","SDP48","SDP49","SDP50","SDP51","SDP52","SDP53","SDP54","SDP55","SDP56","SDP57","SDP58","SDP59","SDP60","SDP61","SDP62","SDP63","SDP64","SDP65","SDP66");

# The male population (in thousands)

# The female population (in thousands)



#=============================================================
#    Draw the right bar chart
#=============================================================

# Create a XYChart object of size 320 x 300 pixels
$c = new XYChart(380, 700);

# Set the plotarea at (50, 0) and of size 250 x 255 pixels. Use pink (0xffdddd) as
# the background.
#$c->setPlotArea(38, 0, 300, 655, 0xddddff);
$c->setPlotArea(38, 0, 300, 655, 0x000000);

# Add a custom text label at the top right corner of the right bar chart
$textBoxObj = $c->addText(320, 0, "A node", "timesbi.ttf", 16, 0xffffff);#0xa07070
$textBoxObj->setAlignment(TopRight);


for($i = 0; $i < count($dataA); ++$i) {
    if (($dataB[$i] > 0 )){
        $colors[$i] = 0xff0000;
    } else {
        $colors[$i] = 0x0cffc0;
    }
}
$barLayerObj = $c->addBarLayer3($dataA, $colors);

# Add the pink (0xf0c0c0) bar chart layer using the female data
#$femaleLayer = $c->addBarLayer($female, 0xf0c0c0);
#$femaleLayer = $c->addBarLayer($female,$colors);

# Swap the axis so that the bars are drawn horizontally
$c->swapXY(true);
$barLayerObj->setAggregateLabelFormat("${value}");
$barLayerObj->setAggregateLabelStyle("",8,0x0cffc0);

# Set the bar to touch each others
#$femaleLayer->setBarGap(TouchBar);

# Set the border style of the bars to 1 pixel 3D border
#$femaleLayer->setBorderColor(-1, 1);

# Add a Transparent line layer to the chart using the male data. As it is
# Transparent, only the female bar chart can be seen. We need to put both male and
# female data in both left and right charts, because we want auto-scaling to produce
# the same scale for both chart.
#$c->addLineLayer($male, Transparent);

# Set the y axis label font to Arial Bold
$c->yAxis->setLabelStyle("arialbd.ttf");
#$c->yAxis->setLabelStyle("arialbd.ttf",8,0x0cffc0);

# Set the labels between the two bar charts, which can be considered as the x-axis
# labels for the right chart
$tb = $c->xAxis->setLabels($labels);

# Use a fix width of 50 for the labels (height = automatic) with center alignment
$tb->setSize(0, 0);
$tb->setAlignment(Left);

# Set the label font to Arial Bold
$tb->setFontStyle("arialbd.ttf");
$tb->setFontColor(0x000000);
#$tb->setBackground(0x000000);

# Disable ticks on the x-axis by setting the tick length to 0
$c->xAxis->setTickLength(0);

#=============================================================
#    Draw the left bar chart
#=============================================================

# Create a XYChart object of size 280 x 300 pixels with a transparent background.
$c2 = new XYChart(380, 700, Transparent);

# Set the plotarea at (20, 0) and of size 250 x 255 pixels. Use pale blue (0xddddff)
# as the background.
$c2->setPlotArea(20, 0, 300, 655, 0x000000);

# Add a custom text label at the top left corner of the left bar chart
$c2->addText(50, 0, "B node", "timesbi.ttf", 16, 0xffffff);#0x7070a0

# Add the pale blue (0xaaaaff) bar chart layer using the male data


#$maleLayer = $c2->addBarLayer($dataB, 0xaaaaff);

$barLayerObj = $c2->addBarLayer3($dataB, $colors);
$barLayerObj->setAggregateLabelFormat("${value}");
$barLayerObj->setAggregateLabelStyle("",8,0x0cffc0);

# Swap the axis so that the bars are drawn horizontally
$c2->swapXY(true);

# Reverse the direction of the y-axis so it runs from right to left
$c2->yAxis->setReverse();

# Set the bar to touch each others
#$maleLayer->setBarGap(TouchBar);

# Set the border style of the bars to 1 pixel 3D border
#$maleLayer->setBorderColor(-1, 1);

# Add a Transparent line layer to the chart using the female data. As it is
# Transparent, only the male bar chart can be seen. We need to put both male and
# female data in both left and right charts, because we want auto-scaling to produce
# the same scale for both chart.
#$c2->addLineLayer($female, Transparent);

# Set the y axis label font to Arial Bold
$c2->yAxis->setLabelStyle("arialbd.ttf");

#=============================================================
#    Use a MultiChart to contain both bar charts
#=============================================================

# Create a MultiChart object of size 590 x 320 pixels.
$m = new MultiChart(670, 780);
$m->setRoundedFrame();
# Add a title to the chart using Arial Bold Italic font
$m->addTitle("ERS Traffic of all SDP", "arialbi.ttf",12,0x00ff00);

# Add another title at the bottom using Arial Bold Italic font
$m->addTitle2(Bottom, "Total IN throughput (Request per second)", "arialbi.ttf", 15,0x00ff00);

# Put the right chart at (270, 25)
$m->addChart(320, 55, $c);

# Put the left chart at (0, 25)
$m->addChart(0, 55, $c2);

# Output the chart
header("Content-type: image/png");
print($m->makeChart2(PNG));
?>
