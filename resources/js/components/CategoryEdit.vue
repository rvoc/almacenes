<template>
   <div >
		<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formCategory' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

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
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="lbdescription">Descripcion</label>
                                    <input type="text" class="form-control" id="description" name="description" v-model="form.description" placeholder="Descripcion" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("description") }}</div>
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


        $('#CategoryModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var category = button.data('json') // Extract info from data-* attributes
            this.title ='Nueva Categoria ';
            if(category)
            {
                this.title='Editar '+category.name;

                axios.get(`category/${category.id}`).then(response=>{
                        this.form = response.data.category;
                        console.log(this.form);
                });

                // this.form = category;
            }else
            {
                this.form={};

            }
            console.log(category);


            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        })
	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formCategory");

                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },


}
</script>
