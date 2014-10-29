<html>
<head>
    <title>SDP Realtime Traffic</title>
    <script type="text/javascript" src="cdjcv.js"></script>
</head>
<body style="margin:0px">
<table cellspacing="0" cellpadding="0" border="0">
<!--    <tr>
        <td align="right" colspan="2" style="background:#000088">
            <div style="padding-bottom:2px; padding-right:3px; font-weight:bold; font-size:10pt; font-style:italic; font-family:Arial;">
                <a style="color:#FFFF00; text-decoration:none" href="http://www.advsofteng.com/">Advanced Software Engineering</a>
            </div>
        </td>
    </tr>       -->
    <tr valign="top">
        <td style="width:150px; background:#c0c0ff; border-left:black 1px solid; border-right:black 1px solid; border-bottom:black 1px solid;">


        <table style="display:none"><tr><td>
            <div style="padding:10px; font-size:9pt; font-family:Verdana">
                <b>Update Period</b><br />
                <select id="UpdatePeriod" style="width:130px">
                    <option value="5">5 seconds</option>
                    <option value="10">10 seconds</option>
                    <option value="20">20 seconds</option>
                    <option value="30">30 seconds</option>
                    <option value="60" selected="selected" >60 seconds</option>
                </select>
            </div>      </td><td>
            <div style="padding:10px; font-size:9pt; font-family:Verdana">
                <b>Time Remaining</b><br />
                <div style="width:130px; border:#888888 1px inset;">
                    <div style="margin:3px" id="TimeRemaining">&nbsp;</div>
                </div>
            </div>

        </td></tr>
        </table>



        </td> </tr><tr>
        <td>
            <hr style="border:solid 1px #000080" />
            <div style="padding:0px 5px 0px 10px">
                <!-- ****** Here is the image tag for the chart image ****** -->
<img id="ChartImage12" src="realtimechart1.php?node=sdp17">
<img id="ChartImage13" src="realtimechart1.php?node=sdp18">
<img id="ChartImage14" src="realtimechart1.php?node=sdp19">
<img id="ChartImage15" src="realtimechart1.php?node=sdp20">
<img id="ChartImage16" src="realtimechart1.php?node=sdp21">
<img id="ChartImage17" src="realtimechart1.php?node=sdp22">
<img id="ChartImage18" src="realtimechart1.php?node=sdp23">
<img id="ChartImage19" src="realtimechart1.php?node=sdp24">
<img id="ChartImage20" src="realtimechart1.php?node=sdp25">
<img id="ChartImage21" src="realtimechart1.php?node=sdp26">
<img id="ChartImage22" src="realtimechart1.php?node=sdp27">
<img id="ChartImage23" src="realtimechart1.php?node=sdp28">
<img id="ChartImage24" src="realtimechart1.php?node=sdp29">
<img id="ChartImage25" src="realtimechart1.php?node=sdp30">
<img id="ChartImage26" src="realtimechart1.php?node=sdp31">
<img id="ChartImage27" src="realtimechart1.php?node=sdp32">
<img id="ChartImage28" src="realtimechart1.php?node=sdp33">
<img id="ChartImage29" src="realtimechart1.php?node=sdp34">
<img id="ChartImage30" src="realtimechart1.php?node=sdp35">
<img id="ChartImage31" src="realtimechart1.php?node=sdp36">
<img id="ChartImage32" src="realtimechart1.php?node=sdp37">
<img id="ChartImage33" src="realtimechart1.php?node=sdp38">
<img id="ChartImage34" src="realtimechart1.php?node=sdp39">
<img id="ChartImage35" src="realtimechart1.php?node=sdp40">
<img id="ChartImage36" src="realtimechart1.php?node=sdp41">
<img id="ChartImage38" src="realtimechart1.php?node=sdp43">
<img id="ChartImage40" src="realtimechart1.php?node=sdp45">
<img id="ChartImage41" src="realtimechart1.php?node=sdp46">
<img id="ChartImage42" src="realtimechart1.php?node=sdp47">
<img id="ChartImage43" src="realtimechart1.php?node=sdp48">
<img id="ChartImage44" src="realtimechart1.php?node=sdp49">
<img id="ChartImage45" src="realtimechart1.php?node=sdp50">
<img id="ChartImage46" src="realtimechart1.php?node=sdp51">
<img id="ChartImage47" src="realtimechart1.php?node=sdp52">
<img id="ChartImage48" src="realtimechart1.php?node=sdp53">
<img id="ChartImage49" src="realtimechart1.php?node=sdp54">
<img id="ChartImage50" src="realtimechart1.php?node=sdp55">
<img id="ChartImage51" src="realtimechart1.php?node=sdp56">
<img id="ChartImage52" src="realtimechart1.php?node=sdp57">
<img id="ChartImage53" src="realtimechart1.php?node=sdp58">
<img id="ChartImage54" src="realtimechart1.php?node=sdp59">
<img id="ChartImage55" src="realtimechart1.php?node=sdp60">
<img id="ChartImage56" src="realtimechart1.php?node=sdp61">
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
// The followings is executed once every second
function updateDisplay()
{
    // Utility to get an object by id that works with most browsers
    var getObj = function(id) {    return document.getElementById ? document.getElementById(id) : document.all[id]; }

    // Get the configured update period
    var updatePeriodObj = getObj("UpdatePeriod");
    var updatePeriod = parseInt(updatePeriodObj.value);

    // Subtract 1 second for the remaining time - reload the counter if remaining time is 0
    if (!updatePeriodObj.timeLeft || (updatePeriodObj.timeLeft <= 0))
        updatePeriodObj.timeLeft = updatePeriod - 1;
    else
        updatePeriodObj.timeLeft = Math.min(updatePeriod, updatePeriodObj.timeLeft) - 1;

    // Update the chart if configured time has elasped
    if ((updatePeriodObj.timeLeft <= 0) && window.JsChartViewer){
JsChartViewer.get('ChartImage12').streamUpdate();
JsChartViewer.get('ChartImage13').streamUpdate();
JsChartViewer.get('ChartImage14').streamUpdate();
JsChartViewer.get('ChartImage15').streamUpdate();
JsChartViewer.get('ChartImage16').streamUpdate();
JsChartViewer.get('ChartImage17').streamUpdate();
JsChartViewer.get('ChartImage18').streamUpdate();
JsChartViewer.get('ChartImage19').streamUpdate();
JsChartViewer.get('ChartImage20').streamUpdate();
JsChartViewer.get('ChartImage21').streamUpdate();
JsChartViewer.get('ChartImage22').streamUpdate();
JsChartViewer.get('ChartImage23').streamUpdate();
JsChartViewer.get('ChartImage24').streamUpdate();
JsChartViewer.get('ChartImage25').streamUpdate();
JsChartViewer.get('ChartImage26').streamUpdate();
JsChartViewer.get('ChartImage27').streamUpdate();
JsChartViewer.get('ChartImage28').streamUpdate();
JsChartViewer.get('ChartImage29').streamUpdate();
JsChartViewer.get('ChartImage30').streamUpdate();
JsChartViewer.get('ChartImage31').streamUpdate();
JsChartViewer.get('ChartImage32').streamUpdate();
JsChartViewer.get('ChartImage33').streamUpdate();
JsChartViewer.get('ChartImage34').streamUpdate();
JsChartViewer.get('ChartImage35').streamUpdate();
JsChartViewer.get('ChartImage36').streamUpdate();
JsChartViewer.get('ChartImage38').streamUpdate();
JsChartViewer.get('ChartImage40').streamUpdate();
JsChartViewer.get('ChartImage41').streamUpdate();
JsChartViewer.get('ChartImage42').streamUpdate();
JsChartViewer.get('ChartImage43').streamUpdate();
JsChartViewer.get('ChartImage44').streamUpdate();
JsChartViewer.get('ChartImage45').streamUpdate();
JsChartViewer.get('ChartImage46').streamUpdate();
JsChartViewer.get('ChartImage47').streamUpdate();
JsChartViewer.get('ChartImage48').streamUpdate();
JsChartViewer.get('ChartImage49').streamUpdate();
JsChartViewer.get('ChartImage50').streamUpdate();
JsChartViewer.get('ChartImage51').streamUpdate();
JsChartViewer.get('ChartImage52').streamUpdate();
JsChartViewer.get('ChartImage53').streamUpdate();
JsChartViewer.get('ChartImage54').streamUpdate();
JsChartViewer.get('ChartImage55').streamUpdate();
JsChartViewer.get('ChartImage56').streamUpdate();
        }

    // Update the display to show remaining time
    getObj("TimeRemaining").innerHTML = updatePeriodObj.timeLeft + ((updatePeriodObj.timeLeft > 1) ? " seconds" : " second");
}
window.setInterval("updateDisplay()", 1000);
</script>
