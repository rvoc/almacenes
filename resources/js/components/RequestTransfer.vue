<template>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                   <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="disable_storage">
                            <i class="fa fa-store-alt"></i> {{storage_select.name}}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" @click="setStorage(item)"  v-for="(item, index) in storages" :key="index" >{{item.name}} </a>
                        </div>
                    </div>
                        <i class="fa fa-arrow-alt-circle-right"></i>
                    <button class="btn btn-secondary">
                        <i class="fa fa-store-alt"></i>  {{storage.name}}
                    </button>
                </div>
                <div class="card-body">
                    <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                        <template slot="sort-asc-icon">
                            <i class="fa fa-sort-asc"></i>
                        </template>
                        <template slot="sort-desc-icon">
                            <i class="fa fa-sort-desc"></i>
                        </template>
                        <template slot="no-sort-icon">
                            <i class="fa fa-sort"></i>
                        </template>

                        <template slot="quantity" slot-scope="props">
                            <input class='form-control' v-model="props.row.quantity" >
                        </template>

                        <template slot="option" slot-scope="props">
                        <button class="btn btn-info" @click="addIncome(props.row)"><i class='fa fa-cart-plus'></i></button>

                        </template>
                    </vue-bootstrap4-table>
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <!-- <i class="fa fa-shopping-cart"></i> -->

                     Articulos Seleccinados
                      <small class="float-sm-right">
                           <button class="btn btn-success" data-toggle="modal" data-target="#registerModal" ><i class="fa fa-shopping-cart"></i> Solicitar  </button>
                           <button class="btn btn-default" ><i class="fa fa-ban"></i> Cancelar  </button>
                        </small>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Articulo</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in incomes" :key="index">
                                <th scope="row">{{index+1}}</th>
                                <td>{{item.article.name}}</td>
                                <td>{{item.article.unit.name}}</td>
                                <td>{{item.quantity}}</td>
                                <td><i class="fa fa-trash text-danger" @click="deleteIncome(index)"></i> </td>
                            </tr>
                            <tr >
                                <td colspan="3" class="text-right " > <strong>TOTAL:</strong> </td>
                                <td>{{getTotalQuantity}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" id='formCategory' method="post" :action="url" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Registro de Solicitud {{storage_select.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <legend>Datos de Ingreso</legend> -->

                        <!-- <div class="row">
                            <div class="form-group  col-md-8">
                                <label for="tipo">Solicitante:</label>
                                    <input type="text" name="person" class="form-control" :value="person" disabled >
                                <div class="invalid-feedback">{{ errors.first("tipo") }}</div>
                            </div>
                        </div> -->
                        <input type="text" name="storage_id" :value="storage_select.id" hidden>
                        <input type="text" name="articles" :value="JSON.stringify(incomes)" hidden>
                        <h5>Detalle de Solicitud</h5>

                        <div class="row">
                            <table class="table  table-bordered">
                                <thead>
                                    <tr class="bg-gray">
                                        <th scope="col">#</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr v-for="(item,index) in incomes" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.article.name}}</td>
                                        <td>{{item.article.unit.name}}</td>
                                        <td>{{item.quantity}}</td>
                                    </tr>
                                    <tr >
                                        <td colspan="3" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" >Vista Previa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- end row -->
</template>
<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
export default {
    props:['articles','url','csrf','storage','storages'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        incomes: [],
        storage_select:{},
        types:[{name: 'Ingreso'},{name:'Traspaso'},{name:'Reingreso'}],
        columns: [

            {
                label: "Nombre",
                name: "name",
                filter: {
                    type: "simple",
                    placeholder: "nombre"
                },
                sort: true,
            },
            {
                label: "Categoria",
                name: "category.name",
                filter: {
                    type: "simple",
                    placeholder: "categoria"
                },
                sort: true,
            },
            {
                label: "Unidad",
                name: "unit.name",
                filter: {
                    type: "simple",
                    placeholder: "unidad"
                },
                sort: true,
            },
            {
                label: "Stock",
                name: "quantity_stock",
            },
            {
                label: "Cantidad",
                name: "quantity",
            },

            {
                label: "Opcion",
                name: "option",
                sort: false,
            }
        ],
        config: {
			card_mode: false,
			checkbox_rows: false,
			rows_selectable: false,
			global_search:  {
					placeholder:  "Enter custom Search text",
					visibility: false,
					case_sensitive:  false
			},
			show_refresh_button:  false,
			show_reset_button:  false,
        },
        hasFile: false,


    }),
    mounted() {
        // this.rows = this.articles;
        this.storage_select = this.storages[0];
        this.getArticles();
        console.log(this.storages);
        console.log(this.articles);
        console.log(this.person);
    },
    methods: {
        addIncome(item){
            this.incomes.push({article:item,quantity:item.quantity});
            item.quantity = '';
            item.cost ='';
            console.log(item);
        },
        setStorage(item){
            this.storage_select = item;
            this.getArticles();
        },
        deleteIncome(index){

            this.incomes.splice(index,1);
        },
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            !files.length?this.hasFile=false:this.hasFile = true;
            console.log(this.hasFile);
        },
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
        getArticles(){
            axios.get(`storage_articles/${this.storage_select.id}`)
                 .then(response=>{
                     console.log(response.data);
                     this.rows = response.data;
                 });
        }
    },
    computed:{

        getTotalQuantity(){
            let quantity= 0;
            this.incomes.forEach(item => {
                // this.quantity += parseInt(item.quantity)
                quantity += Number(item.quantity)
                // console.log(item.quantity);
            });
            return quantity;
        },
        disable_storage(){
            let enable= false;
            if(this.incomes.length>0){
                enable= true;
            }
            return enable;
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
