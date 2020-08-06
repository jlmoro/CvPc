<template>
  <section class="listar-chasis" v-loading="isLoading">

    <encabezadoDatos tituloEncabezado="Listado de Chasís" tituloBoton="registrar chasís" @accionBonton="modalRegistrarChasis"/>

    <div class="row w-100 mt-4">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <el-input v-model="search" placeholder="Buscar..." clearable></el-input>
          </div>
          <div class="col-md-2">
            <i v-if="dataChasis.length > 0" class="mdi mdi-adobe-acrobat icono-pdf" @click="descargaPdf"></i>
          </div>
          <div class="col-md-4 text-right">
            <span>Filas: </span>
            <el-select v-model="perPage" @change="cantidadFilas($event)">
              <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </div>
        </div>
      </div>
    </div>
    <div class="row w-100">
      <div class="col-md-12">
        <table class="table" id="my-table">
          <thead class="thead-light text-center f-13">
            <th>#</th>
            <th>Marca</th>
            <th>Placa</th>
            <th>Serial</th>
            <th>Encargado</th>
            <th>Proveedor</th>
            <th>Fecha Registro</th>
            <th>Estado</th>
            <th colspan="4">Acciones</th>
          </thead>
          <tbody class="text-center f-12">
            <!-- <tr v-for="(data,c) in dataChasis" :key="c"> -->
            <tr v-for="(data,c) in listaFiltradaChasis" :key="c">
              <td>{{ c + 1}}</td>
              <td><span class="letra-capital">{{data.marca}}</span></td>
              <td>{{data.placa}}</td>
              <td>{{data.serial}}</td>
              <td><span class="letra-capital">{{data.nombre_ecnargado}}</span></td>
              <td><span class="letra-capital">{{data.nombre_proveedor}}</span></td>
              <td>{{data.created_at | formato_fecha('D-MM-YYYY')}}</td>
              <td>
                <button v-if="data.estado == 1" type="button" class="btn-estado-act" @click="cambiarEstado(data)">Activo</button>
                <button v-else type="button" class="btn-estado-inact" @click="cambiarEstado(data)">Inactivo</button>
              </td>
              <td>
                <i class="mdi mdi-information-outline f-16 mr-3"></i>
                <i class="mdi mdi-pencil acciones btn-editar"></i>
                <i class="mdi mdi-delete acciones btn-delete"></i>
                <i class="mdi mdi-calendar btn-evento ml-2"></i>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="overflow-auto">
          <b-pagination pills align="center"
          v-model="currentPage"
          :total-rows="total"
          :per-page="perPage"
          aria-controls="my-table"
          @change="cambioPagina($event)"
          ></b-pagination>
        </div>

      </div>
    </div>

    <modal-crear ref="modalRegistroChasis" :ruta="ruta"
    :encargados="encargados"
    :proveedores="proveedores"
    @pc:creado="listaChasis"/>

  </section>
</template>

<script>
export default {
  components:{
    ModalCrear:()=> import('./componentes/modalRegistrarChasis'),
  },
  data(){
    return{
      ruta:'/api/pc',
      search: '',
      isLoading:false,
      encargados:[],
      proveedores:[],
      dataChasis:[],
      perPage: 5,
      total:null,
      currentPage: 1,
      options: [{
          value: 5,
          label: '5'
        }, {
          value: 10,
          label: '10'
        }, {
          value: 15,
          label: '15'
        }],
    }
  },
  computed: {
    listaFiltradaChasis() {
      if (this.search !== '') {
        // return dataChasis.filter(marca => word.length > 6);
        return this.dataChasis.filter(data => !this.search
          || data.marca.toLowerCase().includes(this.search.toLowerCase()))
      }else {
        return this.dataChasis
      }
    }
  },
  mounted(){
    this.isLoading = true
    Promise.all([
      this.listarEncargados(),
      this.listarProveedores(),
      this.listaChasis()
    ]).then(res => {
      this.isLoading = false
    })
  },
  methods: {
    async descargaPdf(){

      try {
        window.open(`${this.ruta}/descarga-pdf`)

      } catch (e) {
        console.warn(e);
      }
    },
    async cambiarEstado(dato){
      try {
        const {data} = await axios.put(`${this.ruta}/${dato.id}/cambiar-estado-chasis`)
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible cambiar estado',data.error)
          return
        }
        this.listaChasis();
        this.$Helper.notificacion('success','Estado Actualizado',data.mensaje)
      } catch (e) {
        console.warn(e);
      }
    },
    async listaChasis(){
      let params = {
        page: this.currentPage,
        perPage: this.perPage
      }
      try {
        const {data} = await axios(`${this.ruta}/listar-pc/`,{params})
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar chasis',data.error)
          return
        }
        this.dataChasis = data.chasis.data
        this.perPage = data.paginate.perPage
        this.currentPage = data.paginate.currentPage
        this.total = data.paginate.total

      } catch (e) {
        console.warn(e);
      }
    },
    cantidadFilas(filas){
      this.perPage = filas
      this.currentPage = 1
      this.listaChasis()
    },
    cambioPagina(page){
      this.currentPage = page
      this.listaChasis()
    },
    async listarEncargados() {
      try {
        const {data} = await axios(`/api/select/listar-encargados`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar encargados',data.error)

          return
        }
        this.encargados = data
      } catch (e) {
        console.warn(e);
      }
    },
    async listarProveedores() {
      try {
        const {data} = await axios(`/api/select/listar-proveedores`)
        if (data.error) {
          this.$Helper.notificacion('warning','Error listar proveedores',data.error)
          return
        }
        this.proveedores = data
      } catch (e) {
        console.warn(e);
      }
    },
    modalRegistrarChasis(){
      this.$refs.modalRegistroChasis.toggle()
    }
  }

}
</script>

<style lang="scss" scoped>
.listar-chasis{
  .icono-excel{
    // border: 1px solid #710606e6;
    border-radius: 2px;
    padding: 3px;
    font-size: 16px;
    // color: white;
    // background-color: #710606e6;
    transition-duration: .85s;
    &:hover{
      // color: #710606e6;
      // background-color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .icono-pdf{
    border: 1px solid #710606e6;
    border-radius: 2px;
    padding: 3px;
    font-size: 16px;
    color: white;
    background-color: #710606e6;
    transition-duration: .85s;
    &:hover{
      color: #710606e6;
      background-color: white;
      transition-duration: .4s;
      cursor: pointer;
    }
  }
  .el-input{
    width: 315px !important;
  }
  .el-select{
    width: 68px !important;
  }
  .table{
    tbody{
      tr{
        border-radius: 5px;
        transition-duration: .85s;
        &:hover{
          background-color: #c0c4cc;
          transform: translateY(-3px);
          box-shadow: 0px 3px 2px 1px #49505f7d;
          transition-duration: .4s;
        }
      }
    }
  }
  .btn-evento{
    border: 1px solid midnightblue;
    border-radius: 3px;
    font-size: 13px;
    padding: 3px;
    color: midnightblue;
    transition-duration: .85s;
    &:hover{
      background-color: midnightblue;
      color: white;
      cursor: pointer;
      transition-duration: .4s;
    }
  }
  .btn-delete{
    border: 1px solid #4c0303;
    border-radius: 3px;
    padding: 2px;
    // font-size: 13px;
    color: #4c0303;
    transition-duration: .85s;
    &:hover{
      background-color: #4c0303;
      color: white;
      cursor: pointer;
      transition-duration: .4s;
    }
  }
  .btn-editar{
    border: 1px solid darkorange;
    color: darkorange;
    border-radius: 3px;
    padding: 2px;
    transition-duration: .85s;
    &:hover{
      background-color: darkorange;
      color: white;
      cursor: pointer;
      transition-duration: .4s;
    }
  }
  .btn-estado-act{
    border: none;
    background-color: #094809f5;
    border-radius: 5px;
    color: #85e685;
    font-size: 12px;
    padding: 3px;
  }
  .btn-estado-inact{
    border: none;
    background-color: #520303;
    border-radius: 5px;
    color: #d08585;
    font-size: 12px;
    padding: 3px;
  }
}
</style>
