<template>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id='formChange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">
        <div class="modal-content ">
            <div v-html='csrf'></div>
        <div class="modal-header laravel-modal-bg">
            <h5 class="modal-title" id="exampleModalLabel">Cambio de Almacen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">

                    <div class="form-group  col-md-12">
                        <input type="text" name="storage_id" v-if="storage_select" :value="storage_select.id" hidden>
                        <label for="Alamacen">Alamacen</label>
                        <multiselect
                            v-model="storage_select"
                            :options="storage"
                            id="storage"
                            placeholder="Seleccionar Almacen"
                            select-label="Seleccionar"
                            deselect-label="Remover"
                            selected-label="Seleccionado"
                            label="name"
                            track-by="name" >

                        </multiselect>
                        <div class="invalid-feedback">{{ errors.first("storage") }}</div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Aceptar</button>
        </div>
        </div>
         </form>
    </div>
    </div>
		<!-- <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal" role="document">
                <form id='formchange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

                    <div class="modal-content">
                        <div v-html='csrf'></div>
						<input type="text" name="id" :value="form.id" v-if="form.id" hidden>
                        <div class="modal-header laravel-modal-bg">
                            <h5 class="modal-title" >Cambio de Sucursal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

							<div class="row">

                                <div class="form-group  col-md-6">
                                    <input type="text" name="storage_id" v-if="storage_select" :value="storage.id" hidden>
									<label for="Alamacen">Alamacen</label>
									<multiselect
										v-model="storage_select"
										:options="storages"
										id="categoria"
										placeholder="Seleccionar Almacen"
										select-label="Seleccionar"
										deselect-label="Remover"
										selected-label="Seleccionado"
										label="name"
										track-by="name" >

									</multiselect>
									<div class="invalid-feedback">{{ errors.first("categoria") }}</div>
								</div>
							</div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->

</template>
<script>
export default {
    props:['url','csrf','storages','storage'],
    data:()=>({

        storage_select:{},
    }),
    mounted() {
        this.storage_select = this.storage.id;
        console.log('Componente change iniciado')
        console.log(this.storage)
        // axios.get('../list_units')
        //      .then(response => {
        //          this.units = response.data;
        //          console.log(response.data)
        //      });

	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formChange");
                    console.log(form);
                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },


}
</script>
