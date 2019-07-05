<template>
   <div >
		<div class="modal fade" id="RequestChangeIncomeModal" tabindex="-1" role="dialog" aria-labelledby="RequestChangeIncomeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formRequestChange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

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
                            <div class="row" v-if="form.article_income">
                                <div class="col-md-4"> Numero de nota: {{form.article_income.correlative}} </div>
                                <div class="col-md-4"> Proveedor: {{form.article_income.provider.first_name}}</div>
                            </div>
                            <div class="row" v-if="form.article_income">
                                <div class="col-md-9">  Funcionario: {{form.article_income.employee+ ' '+form.article_income.person.prs_paterno + ' '+form.article_income.person.prs_materno}}</div>
                            </div>
                             <div class="row" v-if="form.article_income">
                                <div class="col-md-9">  N° Remision: {{form.article_income.remision_number}}</div>
                                <div class="col-md-9"><label style="color:#f70707">Nuevo N° Remision: {{form.remision_number}}</label></div>
                            </div>
							<div class="row"  v-if="form.article_income">
                                <input type="text" name="request_change_income_id" :value="form.id" hidden>
                                <div class="col-md-6">
                                    <strong>Ingreso Actual</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Articulo</th>
                                                <th scope="col">Costo</th>
                                                <th width="90" scope="col">Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,index) in form.article_income.article_income_items" :key="index">
                                                <th scope="row">{{index+1}}</th>
                                                <td>{{item.article.name}}</td>
                                                <td>{{item.cost}}</td>
                                                <td>{{item.quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <strong> Ingreso Solicitado</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col"> Articulo</th>
                                                <th scope="col"> Costo</th>
                                                <th scope="col"> Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,index) in form.request_change_income_items" :key="index">
                                                <th scope="row">{{index+1}}</th>
                                                <td>{{item.article.name }}</td>
                                                <td>{{item.cost}} </td>
                                                <td>{{item.quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <!-- <div class="form-group col-md-8">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lbcode">Codigo</label>
                                    <input type="text" class="form-control" id="code" name="code" v-model="form.code" placeholder="Codigo" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("code") }}</div>
                                </div> -->

							</div>

                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                            <button type="submit" class="btn btn-success" v-if="edited" >Aprobar</button>
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
        edited:false,

    }),
    mounted() {
        console.log('Componente request_change_income iniciado')
        $('#RequestChangeIncomeModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var request_change_income = button.data('json') // Extract info from data-* attributes
            console.log('rquest',request_change_income);
            this.edited = button.data('edited')
            // console.log(request_change_income);
            // console.log(request_change_income);

                console.log(this.edited);
                this.title='Solicitud de Modificacion en Ingreso ';

                axios.get(`request_change/${request_change_income.id}`).then(response=>{
                        this.form = response.data;
                        console.log('formmmm',this.form) ;
                });

                // this.form = request_change_income;


        })
	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formRequestChange");

                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },


}
</script>
