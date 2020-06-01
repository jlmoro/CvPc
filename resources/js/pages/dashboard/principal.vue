<template>
  <section class="grafica-principal">
    <!-- <div id="chartdiv" class="lista-cantidad-eventos" style="height: 36em;"/> -->
    <div class="row">
      <div class="col-md-6 text-center">
        <h5>Cantidad de Eventos</h5>
        <div id="chartdiv" class="lista-cantidad-eventos" />
      </div>
      <div class="col-md-6">
        <div class='demo-app'>
          <!-- <div class='demo-app-top'>
            <button @click="toggleWeekends">toggle weekends</button>
            <button @click="gotoPast">go to a date in the past</button>
            (also, click a date/time to add an event)
          </div> -->
          <FullCalendar
          class='demo-app-calendar'
          ref="fullCalendar"
          defaultView="dayGridMonth"
          :header="{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            }"
            :plugins="calendarPlugins"
            :weekends="calendarWeekends"
            :events="calendarEvents"
            @dateClick="handleDateClick"
            />
          </div>
        </div>
      </div>
    </section>
  </template>
  <script>
  import * as am4core from "@amcharts/amcharts4/core";
  import * as am4charts from "@amcharts/amcharts4/charts";
  import am4themes_kelly from "@amcharts/amcharts4/themes/kelly";
  import am4themes_animated from "@amcharts/amcharts4/themes/animated";

  import FullCalendar from '@fullcalendar/vue'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import esLocale from '@fullcalendar/core/locales/es';

  export default {
    name: "",
    components: {
      FullCalendar // make the <FullCalendar> tag available
    },
    data(){
      return {
        calendarPlugins: [ // plugins must be defined in the JS
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],

        calendarWeekends: true,
        calendarEvents: [ // initial event data
          { title: 'Event Now', start: new Date() }
        ]
      }
    },
    mounted() {
      this.listarEventosChart()
    },

    methods: {
      toggleWeekends() {
        this.calendarWeekends = !this.calendarWeekends // update a property
      },
      gotoPast() {
        let calendarApi = this.$refs.fullCalendar.getApi() // from the ref="..."
        calendarApi.gotoDate('2000-01-01') // call a method on the Calendar object
      },
      handleDateClick(arg) {
        console.log(arg);
        // return
        if (confirm('Would you like to add an event to ' + arg.dateStr + ' ?')) {
          this.calendarEvents.push({ // add new event data
            title: 'Nuevo Evento',
            start: arg.date,
            allDay: arg.allDay
          })
        }
      },
      eventosResolver(){

      },
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
  @import '~@fullcalendar/core/main.css';
  @import '~@fullcalendar/daygrid/main.css';
  @import '~@fullcalendar/timegrid/main.css';
  .grafica-principal{
    .demo-app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
    .demo-app-top {
      margin: 0 0 3em;
    }
    .demo-app-calendar {
      margin: 0 auto;
      max-width: 900px;
    }
    .lista-cantidad-eventos{
      height: 511px;
      width: 482px;
    }
  }
  </style>
