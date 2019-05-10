<template>
   <div >
		<div class="modal fade" id="ArticleModal" tabindex="-1" role="dialog" aria-labelledby="ArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formArticle' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

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

							<div class="row">
                                <div class="form-group col-md-8">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lbcode">Codigo</label>
                                    <input type="text" class="form-control" id="code" name="code" v-model="form.code" placeholder="Codigo" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("code") }}</div>
                                </div>
                                <div class="form-group  col-md-6">
                                    <input type="text" name="budget_item_id" v-if="form.budget_item" :value="form.budget_item.id" hidden>
									<label for="partida">Partida</label>
									<multiselect
										v-model="form.budget_item"
										:options="budget_items"
										id="partida"
										placeholder="Seleccionar Partida"
										select-label="Seleccionar"
										deselect-label="Remover"
										selected-label="Seleccionado"
										label="name"
										track-by="name" >

									</multiselect>
									<div class="invalid-feedback">{{ errors.first("partida") }}</div>
								</div>
                                <div class="form-group  col-md-6">
                                    <input type="text" name="category_id" v-if="form.category" :value="form.category.id" hidden>
									<label for="categoria">Categoria</label>
									<multiselect
										v-model="form.category"
										:options="categories"
										id="categoria"
										placeholder="Seleccionar Partida"
										select-label="Seleccionar"
										deselect-label="Remover"
										selected-label="Seleccionado"
										label="name"
										track-by="name" >

									</multiselect>
									<div class="invalid-feedback">{{ errors.first("categoria") }}</div>
								</div>
                                <!-- <div class="form-group  col-md-8">
                                    <input type="text" name="provider_id" v-if="form.provider" :value="form.provider.id" hidden>
									<label for="proveedor">Proveedor</label>
									<multiselect
										v-model="form.provider"
										:options="providers"
										id="proveedor"
										placeholder="Seleccionar Proveedor"
										select-label="Seleccionar"
										deselect-label="Remover"
										selected-label="Seleccionado"
										label="name"
										track-by="name" >

									</multiselect>
									<div class="invalid-feedback">{{ errors.first("proveedor") }}</div>
								</div> -->

                                <div class="form-group  col-md-4">
                                    <input type="text" name="unit_id" v-if="form.unit" :value="form.unit.id" hidden>
									<label for="unidad">Unidad</label>
									<multiselect
										v-model="form.unit"
										:options="units"
										id="unidad"
										placeholder="Seleccionar unidad"
										select-label="Seleccionar"
										deselect-label="Remover"
										selected-label="Seleccionado"
										label="name"
										track-by="name" >

									</multiselect>
									<div class="invalid-feedback">{{ errors.first("unidad") }}</div>
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
        budget_items:[],
        units: [],
        categories: [],
        providers: [],
        title:'',
    }),
    mounted() {
        console.log('Componente Article iniciado')

        axios.get('../list_units')
             .then(response => {
                 this.units = response.data;
                 console.log(response.data)
             });

        axios.get('../list_categories')
             .then(response => {
                 this.categories = response.data;
                 console.log(response.data)
             });
        axios.get('../list_budget_items')
             .then(response => {
                 this.budget_items = response.data;
                 console.log(response.data)
             });
        axios.get('../list_providers')
             .then(response => {
                 this.providers = response.data;
                 console.log(response.data)
             });
        // axios.get('../list_storages')
        //      .then(response => {
        //          this.storages = response.data;
        //          console.log(response.data)
        //      });




        $('#ArticleModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var article = button.data('json') // Extract info from data-* attributes
            this.title ='Nueva Articulo ';
            if(article)
            {
                this.title='Editar '+article.name;

                axios.get(`article/${article.id}`).then(response=>{
                        this.form = response.data.article;
                        console.log(this.form);
                });

                // this.form = article;
            }else
            {
                this.form={};

            }
            console.log(article);

        })
	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formArticle");

                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },


}
</script>
