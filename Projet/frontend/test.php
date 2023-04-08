<?php
    require_once('template_header.php');
?>

    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="config.js"></script>
    <script src="js/camembert.js"></script>
</head>
<body>
    <div id="chartdiv"></div>
    <button id="test_button">Test</button>

<?php
    require_once('template_footer.php');
?>

