<?php 
$stireport_path = "view/lib/stimulsoft-report/2021.3.6/"; 
require_once "function/report.php";
$customers = report();
?>



<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Data Pelanggan</title>
  <link rel="stylesheet" type="text/css" href="<?= $stireport_path . 'css/stimulsoft.viewer.office2013.whiteblue.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?= $stireport_path . 'css/stimulsoft.designer.office2013.whiteblue.css' ?>">
  <script type="text/javascript" src="<?= $stireport_path . 'scripts/stimulsoft.reports.js' ?>"></script>
  <script type="text/javascript" src="<?= $stireport_path . 'scripts/stimulsoft.viewer.js' ?>"></script>
  <script type="text/javascript" src="<?= $stireport_path . 'scripts/stimulsoft.dashboards.js' ?>"></script>
  <script type="text/javascript" src="<?= $stireport_path . 'scripts/stimulsoft.designer.js' ?>"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      function Start() {
        Stimulsoft.Base.StiLicense.loadFromFile("<?= $stireport_path ?>stimulsoft/license.php");
        var viewerOptions = new Stimulsoft.Viewer.StiViewerOptions()
        
        var viewer = new Stimulsoft.Viewer.StiViewer(viewerOptions, "StiViewer", false)
        var report = new Stimulsoft.Report.StiReport()
  
        var options = new Stimulsoft.Designer.StiDesignerOptions()
        options.appearance.fullScreenMode = true
  
        // var designer = new Stimulsoft.Designer.StiDesigner(options, "Designer", false)
  
        var dataSet = new Stimulsoft.System.Data.DataSet("Data")
  
        viewer.renderHtml('content')
        report.loadFile('view/reports/MasterDetail.mrt')
  
        // report.dictionary.dataSources.clear()
        
        dataSet.readJson(<?php echo json_encode($customers) ?>)
        
        report.regData(dataSet.dataSetName, '', dataSet)
        // report.dictionary.synchronize()
        
        // var dataRelation = new Stimulsoft.Report.Dictionary.StiDataRelation("relation", "relation", "relation", report.dictionary.dataSources.getByName("customers"), report.dictionary.dataSources.getByName("orders"), ["no_invoice"],  ["no_invoice"]);

        // report.dictionary.relations.add(dataRelation)
        report.dictionary.synchronize()
        
        viewer.report = report
        designer.renderHtml("content")
        designer.report = report
      }

    function afterPrint() {
      if (confirm('Tutup halaman?')) {
        window.close()
      }
    }
  </script>
  <style type="text/css">
    .stiJsViewerPage {
      word-break:  break-all !important;
    }

    @media print {
      * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
      }
    }
  </style>
</head>
<body onLoad="Start()" onafterprint="afterPrint()">

  <div id="content"></div>

</body>
</html>
