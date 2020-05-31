<template>
  <section class="grafica-principal">
    <!-- <div id="chartdiv" class="lista-cantidad-eventos" style="height: 36em;"/> -->
    <div class="row">
      <div class="col-md-6 text-center">
        <h5>Cantidad de Eventos</h5>
        <div id="chartdiv" class="lista-cantidad-eventos" />
      </div>
    </div>
  </section>
</template>
<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_kelly from "@amcharts/amcharts4/themes/kelly";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
export default {
  name: "",
  data(){
    return {

    }
  },
  mounted() {
    this.listarEventosChart()
  },
  methods: {
    async listarEventosChart() {
      try {
        const {data} = await axios(`/api/dashboard/principal/listar-eventos`)
        if (data.error) {
          this.$Helper.notificacion('warning','error el listar eventos',data.error)
          return
        }
        // Themes begin
        am4core.useTheme(am4themes_kelly);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

        // Add data
        chart.data = data

        // Create axes
        let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "nombre_tipo";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = 300;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        let series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "cantidad_eventos";
        series.dataFields.categoryX = "nombre_tipo";
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
      } catch (e) {
        console.warn(e);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.grafica-principal{
  .lista-cantidad-eventos{
    height: 511px;
    width: 482px;
  }
}
</style>
