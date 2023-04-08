am5.ready(function() {

/*
    function getConsommation(, ) {
        params = `LOGIN=${login}&HASH_MDP=${pwd}`; 
        $.ajax({
            url: path + `backend/api.php/utilisateurs?` + params,
            type: "GET",
            dataType: "json",
            success: function(response) {
              // Traitement de la réponse de l'API
              if (!(response.length==0)) {
                // Connexion réussie
                alert("Connexion réussie !");
                window.location.href = "dashboard.php";
                document.cookie = 'id='+response[0]['ID_UTILISATEUR'];
                document.getElementById("signInForm").reset();
              } else {
                // Connexion échouée
                alert("Login ou mot de passe incorrect !");
                document.getElementById("signInForm").reset();
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Traitement de l'erreur
              alert("Une erreur s'est produite : " + textStatus + ", " + errorThrown);
            }
          });
    }*/










    // Define data for each year
    var chartData = {
      "Nutriments": [
        { sector: "Calories", size: 6.6 },
        { sector: "Eau", size: 0.6 },
        { sector: "Protéines", size: 23.2 },
        { sector: "Glucides", size: 2.2 },
        { sector: "Lipides", size: 4.5 },
        { sector: "Sucres", size: 14.6 },
        { sector: "Fibres", size: 9.3 },
        { sector: "AG saturés", size: 22.5 },
        { sector: "AG mono-insaturés", size: 0.6 },
        { sector: "AG polyinsaturés", size: 0.6 },
        { sector: "Cholestérol", size: 0.6 },
        { sector: "Sel", size: 0.6 },
        { sector: "Calcium", size: 0.6 },
        { sector: "Fer", size: 0.6 },
        { sector: "Magnésium", size: 0.6 },
        { sector: "Zinc", size: 0.6 }, ]
    };
    
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");
    
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(am5percent.PieChart.new(root, {
      innerRadius: 100,
      layout: root.verticalLayout
    }));
    
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    var series = chart.series.push(am5percent.PieSeries.new(root, {
      valueField: "size",
      categoryField: "sector"
    }));
    
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series.data.setAll([
        { sector: "Calories", size: 6.6 },
        { sector: "Eau", size: 0.6 },
        { sector: "Protéines", size: 23.2 },
        { sector: "Glucides", size: 2.2 },
        { sector: "Lipides", size: 4.5 },
        { sector: "Sucres", size: 14.6 },
        { sector: "Fibres", size: 9.3 },
        { sector: "AG saturés", size: 22.5 },
        { sector: "AG mono-insaturés", size: 0.6 },
        { sector: "AG polyinsaturés", size: 0.6 },
        { sector: "Cholestérol", size: 0.6 },
        { sector: "Sel", size: 0.6 },
        { sector: "Calcium", size: 0.6 },
        { sector: "Fer", size: 0.6 },
        { sector: "Magnésium", size: 0.6 },
        { sector: "Zinc", size: 0.6 }, 
    ]);
    
    /*
    // Play initial series animation
    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
    series.appear(1000, 100);*/
    
    
    // Add label
    var label = root.tooltipContainer.children.push(am5.Label.new(root, {
      x: am5.p50,
      y: am5.p50,
      centerX: am5.p50,
      centerY: am5.p50,
      fill: am5.color(0x000000),
      fontSize: 38
    }));
    
    label.set("text", "Nutriments");
    /*
    // Animate chart data
    var currentYear = 1995;
    function getCurrentData() {
      var data = chartData[currentYear];
      currentYear++;
      if (currentYear > 2014)
        currentYear = 1995;
      return data;
    }
    
    function loop() {
      label.set("text", currentYear);
      var data = getCurrentData();
      for(var i = 0; i < data.length; i++) {
        series.data.setIndex(i, data[i]);
      }
      chart.setTimeout( loop, 4000 );
    }
    
    loop();*/
    
    }); // end am5.ready()