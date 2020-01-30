<template>

    <div ref="modalB" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header">
                        default header
                    </slot>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        default body
                    </slot>
                </div>

                <div class="modal-footer justify-content-center">
                    <slot name="footer">
                        default footer
                        <button class="btn-secondary" @click="toggle">
                            Cerrar
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name:'ModalB',
    data(){
        return{

        }
    },
    methods:{
        toggle(){
            $(this.$refs.modalB).modal('toggle');
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
