<template>
  <modal-b ref="modalDetalles">
    <div slot="header" class="row">
      <div class="col-12">
        <h5>Detalles Usuario - {{detalles.name}} {{detalles.lastname}}</h5>
      </div>
    </div>

    <div  slot="body" class="row w-100">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col text-center">
            <img v-if="detalles.foto != null" class="img-user" :src="`/storage/${detalles.foto}`" alt="">
            <img v-else class="img-user" src="img/user_default.jpg"/>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table table-striped" width="100" align="center">
              <tr>
                <td class="text-right">Nombre(s):</td>
                <td><span class="letra-capital">{{detalles.name}}</span></td>
              </tr>
              <tr>
                <td class="text-right">Apellido(s):</td>
                <td><span class="letra-capital">{{detalles.lastname}}</span></td>
              </tr>
              <tr>
                <td class="text-right">Documento:</td>
                <td>{{detalles.documento}}</td>
              </tr>
              <tr>
                <td class="text-right">Correo:</td>
                <td>{{detalles.email}}</td>
              </tr>
              <tr>
                <td class="text-right">Teléfono:</td>
                <td>{{detalles.telefono}}</td>
              </tr>
              <tr>
                <td class="text-right">Área:</td>
                <td><span class="letra-capital">{{detalles.nombre_area}}</span></td>
              </tr>
              <tr>
                <td class="text-right">Rol:</td>
                <td><span class="letra-capital">{{detalles.nombre_rol}}</span></td>
              </tr>
              <tr>
                <td class="text-right">Estado:</td>
                <td>
                  <span v-if="detalles.estado == 1">Activo</span>
                  <span v-else>Inactivo</span>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div slot="footer" class="">
      <button type="button" class="btn-crear" data-dismiss="modal" >Aceptar</button>
    </div>
  </modal-b>
</template>

<script>
export default {
  props:[
    'ruta'
  ],
  data(){
    return{
      detalles:{},
    }
  },
  methods:{

    toggle(dato){
      this.detalles = _.cloneDeep(dato);
      // console.log(this.detalles);
      this.$refs.modalDetalles.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>
.croppa-container{
  border-radius: 26px;
}
.img-user{
  width: 150px;
  height: 150px;
  border-radius: 10px;
  box-shadow: 0px 2px 3px 0px #00000091;
  border: none;
}
</style>
