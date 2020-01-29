<template>
    <modal ref="modalProveedor">
        
    </modal>
</template>

<script>
export default {
    components:{
        modal:()=> import('~/components/modales/modalB')
    },
    data(){
        return{

        }
    },
    methods:{
        toggle(){
            this.$refs.modalProveedor.toggle()
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
