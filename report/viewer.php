<?php
require_once 'stimulsoft/helper.php';

if(isset($_GET['vn'])){
	$vn=$_GET['vn'];
	$cid=$_GET['cid'];

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Stimulsoft Reports.PHP - JS Report Viewer</title>

	<!-- Report Office2013 style -->
	<link href="css/stimulsoft.viewer.office2013.whiteteal.css" rel="stylesheet">

	<!-- Stimusloft Reports.JS -->
	<script src="scripts/stimulsoft.reports.js" type="text/javascript"></script>
	<script src="scripts/stimulsoft.viewer.js" type="text/javascript"></script>
	
	<?php 
		$options = StiHelper::createOptions();
		$options->handler = "handler.php";
		$options->timeout = 30;
		StiHelper::initialize($options);
		
		
	?>
	<script type="text/javascript">
		var options = new Stimulsoft.Viewer.StiViewerOptions();
		options.appearance.fullScreenMode = true;
		options.toolbar.showSendEmailButton = true;
		
		var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);
		
		// Process SQL data source
		viewer.onBeginProcessData = function (event, callback) {
			<?php StiHelper::createHandler(); ?>
		}
		
		// Manage export settings on the server side
		viewer.onBeginExportReport = function (args) {
			<?php //StiHelper::createHandler(); ?>
			//args.fileName = "MyReportName";
		}
		
		// Process exported report file on the server side
		/*viewer.onEndExportReport = function (event) {
			event.preventDefault = true; // Prevent client default event handler (save the exported report as a file)
			<?php StiHelper::createHandler(); ?>
		}*/
		
		// Send exported report to Email
		viewer.onEmailReport = function (event) {
			<?php StiHelper::createHandler(); ?>
		}
		
		// Load and show report
		var report = new Stimulsoft.Report.StiReport();
		var vn=<?=$vn?>;
		var cid=<?=$cid?>;

		//report.setVariable(test, '123456');
		report.loadFile("reports/stickerDrug_pcc.mrt");
		report.setVariable('vn', vn);
		report.setVariable('cid', cid);
		viewer.report = report;
		
		function onLoad() {
			Stimulsoft.Base.StiLicense.key =
				"6vJhGtLLLz2GNviWmUTrhSqnOItdDwjBylQzQcAOiHm2Fet7sLf2OCBW7CFzi24RU/KV3gPT3fOr6Owc" +
				"7LDdTgoUpEIHdTlKP3tJ2W3e/G6AMqEOrRtF2xTCsXqBqn7mv1GTDZxi6tjquhxs7MxgXZQY9LFfxzkY" +
				"/EikzDlWVCyXmsqmkBNEJyOhBA3aRsRDEodlmIP7jy8hIKMNktc0+A5ZVf9nqvXxGBrr1MeT5RGj4uWT" +
				"8Ajj9FNhK5P7kjRavKam4/1dVu2j4z8ro7wHPQrmMa0T3yKoZ6bR/DC0va/IwtsQt3PiG/jnm7H0dW42" +
				"KR+Kd/v1atWQyJTBofQ8UORosp8F+rtnXMlB5gEWLsoxn3oIE7i+nHS/24cfkBwijfxILUL3dyx0qXsX" +
				"WbKonuAUGuCcFkG0yoaemTaeKUqkhagMQfalWB4PLa6kNGZuuuWDFMvYyqCGwJIz8g2SM2Pc6U/LtH/1" +
				"zfZkG5xLup5+R8bv5n6zIoWO/GAPm/nVThV7E+y/oibxZVRRGIgWS6aqco630JAYdtt32qYjpWWIN42M" +
				"tV4qdfgrOOOk02xX";
			viewer.renderHtml("viewerContent");
		}
	</script>
	</head>
<body onload="onLoad();">
	<div id="viewerContent"></div>
</body>
</html>
