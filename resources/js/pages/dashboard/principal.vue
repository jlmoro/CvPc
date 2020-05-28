<template>
  <section class="grafica-principal">
    <div id="chartdiv" style="height: 36em;"/>
  </section>
</template>
<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_spiritedaway from "@amcharts/amcharts4/themes/spiritedaway";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
export default {
  name: "",
  data(){
    return {

    }
  },
  mounted() {
    this.grafica1()
  },
  methods: {
    grafica1() {
      // Themes begin
      am4core.useTheme(am4themes_spiritedaway);
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Create chart instance
      let chart = am4core.create("chartdiv", am4charts.XYChart);
      chart.scrollbarX = new am4core.Scrollbar();

      // Add data
      chart.data = [{
        "country": "Enero",
        "visits": 3025
      }, {
        "country": "Febrero",
        "visits": 1882
      }, {
        "country": "Marzo",
        "visits": 1809
      }, {
        "country": "Abril",
        "visits": 1322
      }, {
        "country": "Mayo",
        "visits": 1122
      }, {
        "country": "Junio",
        "visits": 1114
      }, {
        "country": "Julio",
        "visits": 984
      }, {
        "country": "Agosto",
        "visits": 711
      }, {
        "country": "Septiembre",
        "visits": 665
      }, {
        "country": "Octubre",
        "visits": 580
      }, {
        "country": "Noviembre",
        "visits": 443
      }, {
        "country": "Diciembre",
        "visits": 441
      }];

      // Create axes
      let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "country";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.renderer.labels.template.horizontalCenter = "right";
      categoryAxis.renderer.labels.template.verticalCenter = "middle";
      categoryAxis.renderer.labels.template.rotation = 270;
      categoryAxis.tooltip.disabled = true;
      categoryAxis.renderer.minHeight = 110;

      let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.renderer.minWidth = 50;

      // Create series
      let series = chart.series.push(new am4charts.ColumnSeries());
      series.sequencedInterpolation = true;
      series.dataFields.valueY = "visits";
      series.dataFields.categoryX = "country";
      series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
      series.columns.template.strokeWidth = 0;

      series.tooltip.pointerOrientation = "vertical";

      series.columns.template.column.cornerRadiusTopLeft = 10;
      series.columns.template.column.cornerRadiusTopRight = 10;
      series.columns.template.column.fillOpacity = 0.8;

      // on hover, make corner radiuses bigger
      let hoverState = series.columns.template.column.states.create("hover");
      hoverState.properties.cornerRadiusTopLeft = 0;
      hoverState.properties.cornerRadiusTopRight = 0;
      hoverState.properties.fillOpacity = 1;

      series.columns.template.adapter.add("fill", function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
      });

      // Cursor
      chart.cursor = new am4charts.XYCursor();
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
