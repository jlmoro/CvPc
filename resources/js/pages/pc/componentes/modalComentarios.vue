<template>
  <section class="modal-comentarios">
    <div>
      <b-sidebar
      aria-labelledby="titulo"
      right backdrop-variant="dark"
      text-variant="light"
      bg-variant="dark"
      v-model="isVisible"
      backdrop shadow >
        <div class="px-3 py-1">
          <div id="titulo" class="text-center">
            <h4>Comentarios</h4>
            <h5>Equipo - {{placaEquipo}}</h5>
          </div>
          <div class="py-4 text-center">
            <textarea name="name" rows="8" class="comentarios" v-model="comentario"></textarea>
            <button type="button" class="btn-comentar mt-2" @click="registrarComentario">Comentar</button>
          </div>
        </div>
        <div class="container">
          <div class="row" v-for="(data,c) in dataComentarios" :key="c">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-2">
                  <img src="https://placekitten.com/300/300" class="img-user-comentario" alt="">
                </div>
                <div class="col-md-10">
                  <span class="comentario pl-2">
                    {{data.comentario}}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <span class="f-12">31-10-2020</span>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>

      </b-sidebar>
    </div>
  </section>
</template>
<script>
export default {
  data(){
    return{
      ruta:'/api/comentarios/equipo',
      isVisible:false,
      placaEquipo:'',
      idEquipo:null,
      comentario:'',
      dataComentarios:[]
    }
  },
  mounted() {
    // this.listarComentarios()

  },
  methods: {
    async listarComentarios(){
      const {data} = await axios(`${this.ruta}/${this.idEquipo}/listar-comentarios-equipo`)
      if (data.error) {
        this.$Helper.notificacion('warning','No es posible mostrar comentarios',data.error)
        return
      }
      this.dataComentarios = data
    },
    async registrarComentario(){
      let datos = {
        id_equipo: this.idEquipo,
        comentario: this.comentario
      }
      try {
        const {data} = await axios.post(`${this.ruta}/registrar-comentario-equipo`,{datos})
        if (data.error) {
          this.$Helper.notificacion('warning','No es posible registrar comentario',data.error)
          return
        }
        this.$Helper.notificacion('success','Comentario Registrado',data.mensaje)
        this.listarComentarios()

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(id,placa) {
      this.placaEquipo = placa
      this.idEquipo = id
      this.isVisible == false?this.isVisible = true:this.isVisible = false
      this.listarComentarios()
    }
  }
}
</script>
<style lang="scss" scoped>

.modal-comentarios{

  .container::-webkit-scrollbar {
    -webkit-appearance: none;
  }

  .container::-webkit-scrollbar:vertical {
    width:10px;
  }

  .container::-webkit-scrollbar-thumb {
    background-color: #797979;
    border-radius: 20px;
    border: 1px solid #f1f2f3;
  }

  .container{
    overflow-y: auto !important;
    overflow: scroll !important;
    height: -webkit-fill-available;
    position: relative;
    margin-bottom: 286px;

    .comentario{
      color: whitesmoke;
      font-size: 12px;
      font-weight: lighter;
      margin-bottom: 0px;
    }
    .img-user-comentario{
      border-radius: 50%;
      width: 50px;
    }
  }
  .btn-comentar{
    border: 1px solid white;
    border-radius: 3px;
    padding: 5px 10px 5px 10px;
    background-color: midnightblue;
    color: white;
  }
  .comentarios{
    width: 288px;
    border-radius: 7px;
    resize: none;
    height: 129px;
    border: none;
    padding-left: 8px;
    padding-top: 6px;
    color: lightslategray;
    font-size: 14px;
    padding-right: 9px;
  }
}

</style>
