<template>
  <section class="crear-pc">
    <modal ref="ModalRegistrarPc">
      <div slot="header" class="row">
        <div class="col-12">
          <h5>Crear Equipo</h5>
        </div>
      </div>
      <div slot="body" class="row w-100">
        <div class="col-12">
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marcaP" class="letra-capital">fuente poder</label>

              <el-select v-model="form.id_fuente_poder" clearable filterable placeholder="Seleccione Fuente">
                <el-option
                  v-for="(item,f) in fuentes"
                  :key="f"
                  :label="item.marca"
                  :value="item.id">
                  <span style="float: left">{{ item.marca }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{ item.potencia }} Watts</span>
                </el-option>
              </el-select>

            </div>
            <div class="col-md-6">
              <label for="placaP" class="letra-capital">placa base</label>

              <el-select v-model="form.id_placa_base" clearable filterable placeholder="Seleccione Placa Base">
                <el-option
                  v-for="(item,p) in board"
                  :key="p"
                  :label="item.marca_placa_base"
                  :value="item.id">
                  <span style="float: left">{{ item.marca_placa_base }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{ item.modelo_placa }}</span>
                </el-option>
              </el-select>

            </div>
          </div>
          <div class="row w-100">
            <div class="col-md-6">
              <label for="marcaP" class="letra-capital">procesador</label>

              <el-select v-model="form.id_procesador" clearable filterable placeholder="Seleccione Procesador">
                <el-option
                  v-for="(item,p) in procesador"
                  :key="p"
                  :label="item.marca"
                  :value="item.id">
                  <span style="float: left">{{ item.marca }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{ item.modelo_tecnologia }}</span>
                </el-option>
              </el-select>

            </div>
            <div class="col-md-6">
              <label for="marcaP" class="letra-capital">disco almacenamiento</label>

              <el-select v-model="form.id_disco" clearable filterable placeholder="Seleccione Disco">
                <el-option
                  v-for="(item,d) in disco"
                  :key="d"
                  :label="item.marca"
                  :value="item.id">
                  <span style="float: left">{{ item.marca }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{ item.capacidad }} GB</span>
                </el-option>
              </el-select>

            </div>
          </div>
          <div class="row w-100">
            <div class="col-md-6">
              <label for="ram1" class="letra-capital">memoria RAM 1</label>

              <el-select v-model="form.id_memoria_ram	" clearable filterable placeholder="Seleccione RAM">
                <el-option
                  v-for="(item,r) in ram"
                  :key="r"
                  :label="item.marca"
                  :value="item.id">
                  <span style="float: left">{{ item.marca }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{item.modelo_tecnologia}} {{ item.capacidad }}</span>
                </el-option>
              </el-select>

            </div>
            <div class="col-md-6">
              <label for="ram2" class="letra-capital">memoria RAM 2</label>

              <el-select v-model="form.id_memoria_ram_2	" clearable filterable placeholder="Seleccione RAM">
                <el-option
                  v-for="(item,r) in ram"
                  :key="r"
                  :label="item.marca"
                  :value="item.id">
                  <span style="float: left">{{ item.marca }}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{item.modelo_tecnologia}} {{ item.capacidad }}</span>
                </el-option>
              </el-select>

            </div>
          </div>

          <div class="row w-100">
            <div class="col-md-6">
              <label for="peri1" class="letra-capital">periferico 1</label>

              <el-select v-model="form.id_periferico_1	" clearable filterable placeholder="Seleccione Periferico">
                <el-option
                  v-for="(item,pr) in perifericos"
                  :key="pr"
                  :label="item.nombre"
                  :value="item.id">
                </el-option>
              </el-select>

            </div>
            <div class="col-md-6">
              <label for="peri2" class="letra-capital">periferico 2</label>
              <el-select v-model="form.id_periferico_2	" clearable filterable placeholder="Seleccione Periferico">
                <el-option
                  v-for="(item,pr) in perifericos"
                  :key="pr"
                  :label="item.nombre"
                  :value="item.id">
                </el-option>
              </el-select>
            </div>
          </div>

          <div class="row w-100">
            <div class="col-md-6">
              <label for="peri3" class="letra-capital">periferico 3</label>

              <el-select v-model="form.id_periferico_3	" clearable filterable placeholder="Seleccione Periferico">
                <el-option
                  v-for="(item,pr) in perifericos"
                  :key="pr"
                  :label="item.nombre"
                  :value="item.id">
                </el-option>
              </el-select>

            </div>
            <div class="col-md-6">
              <label for="chasis" class="letra-capital">chasis</label>

              <el-select v-model="form.id_chasis	" clearable filterable placeholder="Seleccione Chasis">
                <el-option
                  v-for="(item,c) in chasis"
                  :key="c"
                  :label="item.placa"
                  :value="item.id">
                  <span style="float: left">{{ item.placa}}</span>
                  <span style="float: right; color: #8492a6; font-size: 13px">{{item.marca}}</span>
                </el-option>
              </el-select>

            </div>
          </div>

          <div class="row w-100 mt-3">
            <div class="col-md-12">
              <label for="observacionesP" class="letra-capital">observaciones</label>
              <textarea v-model="form.observaciones" id="observacionesP" name="name" rows="5" cols="80" class="txt-area"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="row">
        <div class="col-12">
          <button type="button" class="btn-crear" @click="guardarPc">Guardar</button>
          <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </modal>
  </section>
</template>

<script>
export default {
  props: [
    'ruta',
    'chasis',
    'fuentes',
    'ram',
    'board',
    'disco',
    'perifericos',
    'procesador',
  ],
  components:{
    Modal:()=> import('~/components/modales/modalB')
  },
  data(){
    return{
      form:{}
    }
  },
  methods:{
    async guardarPc(){
      try {
        const {data} = await axios.post(`${this.ruta}/registrar-equipo`,this.form)
        if (data.error) {
          this.$Helper.notificacion('warning','Error crear equipo',data.error)
          return
        }
        if (data.mensaje2) {
          this.$Helper.notificacion('info','Chasis Asignado',data.mensaje2)
          return
        }
        this.$emit('equipo:registrado')
        this.$Helper.notificacion('success','Equipo Registrado',data.mensaje)
        this.$refs.ModalRegistrarPc.toggle()

      } catch (e) {
        console.warn(e);
      }
    },
    toggle(){
      this.$refs.ModalRegistrarPc.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
