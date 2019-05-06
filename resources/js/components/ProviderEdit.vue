<template>
   <div >
		<div class="modal fade" id="ProviderModal" tabindex="-1" role="dialog" aria-labelledby="ProviderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formProvider' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

                    <div class="modal-content">
                        <div v-html='csrf'></div>
						<input type="text" name="id" :value="form.id" v-if="form.id" hidden>
                        <div class="modal-header laravel-modal-bg">
                            <h5 class="modal-title" >{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<!-- <input type="text" name="action_short_term_id" v-model="action_short_term.id" hidden> -->
                            <legend>Datos del Proveedor</legend>
							<div class="row">
                                <div class="form-group col-md-12">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre del Proveedor" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lbphone">Telefono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" v-model="form.phone" placeholder="Telefono" v-validate="'required|numeric'">
                                    <div class="invalid-feedback">{{ errors.first("phone") }}</div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="lbaddress">Direccion</label>
                                    <input type="text" class="form-control" id="address" name="address" v-model="form.address" placeholder="Direccion" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("address") }}</div>
                                </div>
							</div>
                            <legend>Datos del Responsable</legend>
							<div class="row">
                                <div class="form-group col-md-8">
                                    <label for="lbfirst_name">Nombres</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" v-model="form.first_name" placeholder="Nombre" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("address") }}</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="lblast_name">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" v-model="form.last_name" placeholder="Apellido Paterno" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("last_name") }}</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="lbmother_last_name">Apellido Materno</label>
                                    <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" v-model="form.mother_last_name" placeholder="Apellido Materno" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("mother_last_name") }}</div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="lbcellphone">Celular</label>
                                    <input type="text" class="form-control" id="cellphone" name="cellphone" v-model="form.cellphone" placeholder="Celular" v-validate="'required|numeric'">
                                    <div class="invalid-feedback">{{ errors.first("cellphone") }}</div>
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
        </div>

    </div>
</template>
<script>
export default {
    props:['url','csrf'],
    data:()=>({
        form:{},
        title:'',
    }),
    mounted() {
        console.log('Componente Proveedor iniciado')


        $('#ProviderModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var provider = button.data('json') // Extract info from data-* attributes
            this.title ='Nuevo Proveedor ';
            if(provider)
            {
                this.title='Editar '+provider.name;

                axios.get(`provider/${provider.id}`).then(response=>{
                        this.form = response.data.provider;
                        console.log(this.form);
                });

                // this.form = provider;
            }else
            {
                this.form={};

            }
            console.log(provider);


            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        })
	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formProvider");

                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },


}
</script>
