<template>
  <section class="modal-crear-evento">
    <modal-b ref="modalEditarEvento">

    </modal-b>
  </section>
</template>

<script>
export default {
  data(){
    return{

    }
  },
  methods:{
    toggle(){
      this.$refs.modalEditarEvento.toggle()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
