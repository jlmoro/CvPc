<template>
  <section v-loading="isLoading">

    <encabezadoDatos tituloEncabezado="Equipos" tituloBoton="Crear Equipo" @accionBonton="modalCrearEquipo"/>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-4">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
        </div>
        <table class="table table-hover f-12">
          <thead class="thead-light text-center">
            <tr>
              <th>#</th>
              <th>Chasis</th>
              <th>Placa Base</th>
              <th>Fuente Poder</th>
              <th>Memoria Ram 1</th>
              <th>Memoria Ram 2</th>
              <th>Procesador</th>
              <th>Disco Almacenamiento</th>
              <th>Periferico 1</th>
              <th>Periferico 2</th>
              <th>Periferico 3</th>
              <th>Act. Por</th>
              <th>Fecha Registro</th>
              <th colspan="3">Acciones</th>
            </tr>
          </thead>
          <tr v-for="(data,i) in listadoEquipos" :key="i">
            <td>{{i + 1}}</td>
            <td><span class="letra-capital">{{data.chasis_placa}}-{{data.chasis_marca}}</span></td>
            <td>{{data.placa_marca}}-{{data.placa_modelo}}</td>
            <td>{{data.fuente_marca}}-{{data.fuente_potencia}} Watts</td>
            <td>
              <span class="letra-capital"> {{data.memoria1_marca}}-{{data.memoria1_modelo}} {{data.memoria1_capacidad}}</span>
            </td>
            <td v-if="data.id_memoria_ram_2 !== null">
              <span class="letra-capital"> {{data.memoria2_marca}}-{{data.memoria2_modelo}} {{data.memoria2_capacidad}}</span>
            </td>
            <td v-else><span class="letra-capital">no registra</span></td>
            <td>{{data.procesador_marca}} {{data.procesador_modelo}} {{data.procesador_frecuencia}} GHz</td>
            <td v-if="data.disco_tipo == 1">(SSD) {{data.disco_marca}} {{data.disco_capacidad}} GB</td>
            <td v-else>(HDD) {{data.disco_marca}} {{data.disco_capacidad}} GB</td>
            <td v-if="data.id_periferico_1 !== null">{{data.periferico1_nombre}}</td>
            <td v-else>no registra</td>
            <td v-if="data.id_periferico_2 !== null">{{data.periferico2_nombre}}</td>
            <td v-else>no registra</td>
            <td v-if="data.id_periferico_3 !== null">{{data.periferico3_nombre}}</td>
            <td v-else>no registra</td>

            <td>{{data.usuario_nombre}} {{data.usuario_apellido}}</td>

            <td>{{data.created_at | formato_fecha('DD-MMM-yyyy')}}</td>
            <td>
              <el-popover v-if="data.observaciones === null" placement="bottom" title="Observaciones" width="250" trigger="hover"
                content="Sin Observaciones">
                <span slot="reference" class="mdi mdi-alert-circle-outline f-20 btnDescrip "></span>
              </el-popover>
              <el-popover v-else placement="bottom" title="Observaciones" width="250" trigger="hover"
                :content="data.observaciones">
                <span slot="reference" class="mdi mdi-alert-circle-outline f-20 btnDescrip "></span>
              </el-popover>
            </td>
            <td>
              <i class="mdi mdi-pencil f-18 acciones btnEditar" @click="modalEditar(data)"></i>
            </td>
            <td>
              <i class="mdi mdi-delete f-18 acciones btnEliminar" @click="modalEliminarEquipo(data)"></i>
            </td>
          </tr>
    </table>
  </div>
</div>

  <modal-crear ref="modalCrearEquipo"
  :ruta="ruta"
  :chasis="chasis"
  :fuentes="fuentes"
  :ram="ram"
  :board="board"
  :disco="disco"
  :perifericos="perifericos"
  :procesador="procesador"
  @equipo:registrado="listar_equipo" />

  <modal-eliminar ref="modalEliminarEquipo"
  titulo="eliminar equipo"
  :cuerpo="`¿Seguro desea eliminar equipo con placa ${eliminandoEq.chasis_placa}?`"
  @eliminar="eliminandoEquipo"
  />

  </section>
</template>
<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalCrearEquipo'),
    // ModalEditar:()=> import('./componentes/modalEditarFuentePoder')
  },
  data(){
    return{
      ruta:`/api/pc/equipo`,
      ruta2:`/api/select`,
      equipo:[],
      isLoading:false,
      search:'',
      chasis:[],
      fuentes:[],
      ram:[],
      board:[],
      disco:[],
      perifericos:[],
      procesador:[],
      eliminandoEq:{}
    }
  },
  computed:{
    listadoEquipos(){
      return this.equipo.filter(data => !this.search || data.placa_chasis.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listar_equipo(),
      this.listar_chasis(),
      this.listar_fuentes(),
      this.listar_placa_base(),
      this.listar_procesador(),
      this.listar_discos(),
      this.listar_ram(),
      this.listar_perifericos(),
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    async listar_equipo(){
      try {
        const {data} = await axios(`${this.ruta}/listar-equipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listando equipo',data.error)
          return
        }
        this.equipo = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_chasis(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-chasis`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar chasis',data.error)
          return
        }
        this.chasis = data

      } catch (e) {
        console.warn(e);
      }
    },
    async listar_fuentes(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-fuentes`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar chasis',data.error)
          return
        }
        this.fuentes = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_placa_base(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-board`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar board',data.error)
          return
        }
        this.board = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_procesador(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-procesador`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar chasis',data.error)
          return
        }
        this.procesador = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_discos(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-disco`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar disco',data.error)
          return
        }
        this.disco = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_ram(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-ram`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar ram',data.error)
          return
        }
        this.ram = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listar_perifericos(){
      try {
        const {data} = await axios(`${this.ruta2}/listar-perifericos`)
        if (data.error) {
          this.$Helper.notificacion('warning','error listar perifericos',data.error)
          return
        }
        this.perifericos = data
      } catch (e) {
        console.warn(e);
      }
    },
    async eliminandoEquipo(){
      try {
        const {data} = await axios.delete(`${this.ruta}/${this.eliminandoEq.id}/eliminando-equipo`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible eliminar',data.error)
          return
        }
        this.listar_equipo()
        this.$Helper.notificacion('success','Equipo Eliminado',data.mensaje)
        this.$refs.modalEliminarEquipo.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    modalEliminarEquipo(dato){
      this.eliminandoEq = dato
      this.$refs.modalEliminarEquipo.toggle()
    },
    modalCrearEquipo(){
      this.$refs.modalCrearEquipo.toggle()
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
