<template>
   <div >
		<div class="modal fade" id="UnitModal" tabindex="-1" role="dialog" aria-labelledby="UnitModalLabel" aria-hidden="true">
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

							<div class="row">
                                <div class="form-group col-md-6">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre del Proveedor" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lbshort_name">Abreviatura</label>
                                    <input type="text" class="form-control" id="short_name" name="short_name" v-model="form.short_name" placeholder="Abreviatura" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("short_name") }}</div>
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


        $('#UnitModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var unit = button.data('json') // Extract info from data-* attributes
            this.title ='Nueva Unidad ';
            if(unit)
            {
                this.title='Editar '+unit.name;

                axios.get(`unit/${unit.id}`).then(response=>{
                        this.form = response.data.unit;
                        console.log(this.form);
                });

                // this.form = unit;
            }else
            {
                this.form={};

            }
            console.log(unit);


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
