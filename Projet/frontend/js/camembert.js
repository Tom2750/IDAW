async function getConsommations(id_utilisateur, date_conso) {
    params = `ID_UTILISATEUR=${id_utilisateur}&DATE_CONSO=${date_conso}`; 
    liste_nutriment = [];
    conso = {};
    try {
        const response = await $.ajax({
            url: path + `backend/api.php/consommations?` + params,
            type: "GET",
            dataType: "json"
        });
        // Traitement de la réponse de l'API
        for (var i = 0; i < response.length; i++){
            const nutriments = await getNutriments(response[i]['ID_ALIMENT'], response[i]['QUANTITE']);
            nutriments.push({
                id_nutriment: 17,
                unité: parseFloat(response[i]['QUANTITE'])
            });
            liste_nutriment.push(nutriments); //bonne valeur
            //quantité += parseFloat(response[i]['QUANTITE']);
        }
        conso = additionnerNutriments(liste_nutriment); //bonne valeur
        return conso;
    } catch (error) {
        // Traitement de l'erreur
        alert("Une erreur s'est produite : " + error);
    }
  }
  
  //Récupère bon nutriments dans getConsommation()
  function getNutriments(id_aliment, quantité){
    return new Promise(function(resolve, reject) {
      $.ajax({
        url: path + `backend/api.php/compositions/${id_aliment}`,
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Traitement de la réponse de l'API
            var nutriments = [];
            for (var i = 0; i < response.length; i++) {
                var id_nutriment = response[i]['ID_NUTRIMENT'];
                var unité = response[i]['RATIO']/100 * quantité;
                // Vérifie si l'id_nutriment est déjà présent dans le tableau nutriments
                var index = nutriments.findIndex(function(item) {
                    return item.id_nutriment === id_nutriment;
                });
                // Si l'id_nutriment est déjà présent, passe à la ligne suivante
                if (index >= 0) {
                    continue;
                }
                // Sinon, ajoute une nouvelle ligne au tableau nutriments
                var ligne = {
                    id_nutriment: id_nutriment,
                    unité: unité
                };
                nutriments.push(ligne);
            }
            // Utilisation du tableau des nutriments
            resolve(nutriments);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Traitement de l'erreur
            reject("Une erreur s'est produite : " + textStatus + ", " + errorThrown);
        }
      });
    });
  }
  
  function additionnerNutriments(tableauxNutriments) {
    const sommeNutriments = {};
    tableauxNutriments.forEach(tableau => {
      tableau.forEach(nutriment => {
        if (sommeNutriments[nutriment.id_nutriment] === undefined) {
          sommeNutriments[nutriment.id_nutriment] = nutriment.unité;
        } else {
          sommeNutriments[nutriment.id_nutriment] += nutriment.unité;
        }
      });
    });
    const resultat = [];
    for (const [id_nutriment, valeur] of Object.entries(sommeNutriments)) {
      resultat.push({id_nutriment: id_nutriment, unité: valeur});
    }
    return resultat;
  }


  function prepareData(conso) {
    for(i=1;i<18;i++){
        const nutriment = conso.find(element => element.id_nutriment === `${i}`);
        if (!nutriment) {
            conso.splice(i-1, 0, {id_nutriment: `${i}`, unité: 0});
        }
    }
    for(i=1;i<18;i++){
        const nutriment = conso.find(element => element.id_nutriment === `${i}`);
        var reste = 0.0;
        if (nutriment){
            if((i == 11) || (i == 13) || (i == 14) || (i == 15) || (i == 16)){
                nutriment.unité /= 1000;
            }
            if(i == 2){
                nutriment.unité = 0;
            }
        }
    }

    let somme = 0;
    for (let i = 1; i < conso.length; i++) {
        if(i+1 !== conso.length){
            somme += conso[i].unité;
        } else {
            conso[i].unité -= somme; 
        }
    }
}

function findNutriment(tableau, nutrimentId){
    const nutriment = tableau.find(element => element.id_nutriment === nutrimentId);
    return nutriment.unité;
}

  
  async function main() {
    try {
        const conso = await getConsommations(sessionId, '2023-04-08'); //modifier avec date du jour
        prepareData(conso);

        am5.ready(function() {

        var root = am5.Root.new("chartdiv");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            innerRadius: 100,
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "size",
            categoryField: "sector"
        }));
        
        series.data.setAll([
            { sector: "Protéines", size: findNutriment(conso, '3') },
            { sector: "Glucides", size: findNutriment(conso, '4') },
            { sector: "Lipides", size: findNutriment(conso, '5') },
            { sector: "Sucres", size: findNutriment(conso, '6') },
            { sector: "Fibres", size: findNutriment(conso, '7') },
            { sector: "AG saturés", size: findNutriment(conso, '8') },
            { sector: "AG mono-insaturés", size: findNutriment(conso, '9') },
            { sector: "AG polyinsaturés", size: findNutriment(conso, '10') },
            { sector: "Cholestérol", size: findNutriment(conso, '11') },
            { sector: "Sel", size: findNutriment(conso, '12') },
            { sector: "Calcium", size: findNutriment(conso, '13') },
            { sector: "Fer", size: findNutriment(conso, '14') },
            { sector: "Magnésium", size: findNutriment(conso, '15') },
            { sector: "Zinc", size: findNutriment(conso, '16') },
            { sector: "Autre", size: findNutriment(conso, '17') }
        ]);

        var label = root.tooltipContainer.children.push(am5.Label.new(root, {
            x: am5.p50,
            y: am5.p50,
            centerX: am5.p50,
            centerY: am5.p50,
            fill: am5.color(0x000000),
            fontSize: 38
        }));

        const calories =  findNutriment(conso, '1') + " Kcal";
        label.set("text", calories);
    });

    } catch (error) {
        console.error(error);
    }
  }
  
  main();


  
  /*
  am5.ready(function() {
  
  
  switch(response[i]['ID_NUTRIMENT']){
                      case 1:
                        nutriment = "Calories";
                      case 2:
                        nutriment = "Eau";
                      case 3:
                        nutriment = "Protéines";
                      case 4:
                        nutriment = "Glucides";
                      case 5:
                        nutriment = "Lipides";
                      case 6:
                        nutriment = "Sucres";
                      case 7:
                        nutriment = "Fibres";
                      case 8:
                        nutriment = "AG saturés";
                      case 9:
                        nutriment = "AG mono-insaturés";
                      case 10:
                        nutriment = "AG polyinsaturés";
                      case 11:
                        nutriment = "Cholestérol";
                      case 12:
                        nutriment = "Sel";
                      case 13:
                        nutriment = "Calcium";
                      case 14:
                        nutriment = "Fer";
                      case 15:
                        nutriment = "Magnésium";
                      case 16:
                        nutriment = "Zinc";
                        
                  }
  
      });
  
      // Define data for each year
      var chartData = {
        "Nutriments": [
          { sector: "Calories", size: 5.0 },
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
      }
      
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
          { sector: "Calories", size: 2.0 },
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
      
      
      // Play initial series animation
      // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
      series.appear(1000, 100);
      
      
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
      
      loop();
      
      }); end am5.ready()
      */