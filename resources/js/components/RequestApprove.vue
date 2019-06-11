<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{storage.name}}: Solicitud {{request.correlative}}
                  <br>
                   Solicitante: {{request.person.prs_nombres+' '+request.person.prs_paterno+' '+request.person.prs_materno}}
                    <!-- {{rows}} -->
                     <small class="float-sm-right">
                           <button class="btn btn-success" data-toggle="modal" data-target="#registerModalApprob" ><i class="fa fa-user-check"></i> Aprobar  </button>
                           <button class="btn btn-danger" ><i class="fa fa-user-times"></i> Rechazar  </button>
                           <a :href="url" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar </a>
                           <!-- <button class="btn btn-default" ><i class="fa fa-ban"></i> Cancelar  </button> -->
                        </small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                        <div class="card-body">
                            <h5>MATERIAL SOLICITADO</h5>
                              <table class="table  table-bordered">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th scope="col">#</th>
                                                <th scope="col">Articulo</th>
                                                <th scope="col">Unidad</th>
                                                <th scope="col" v-if="isRequestStorage">Costo Unitario</th>
                                                <th scope="col">Cantidad Sol.</th>
                                                <!-- <th scope="col">Cantidad Aprob.</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <tr v-for="(item,index) in request.article_request_items" :key="index">
                                                <th scope="row">{{index+1}}</th>
                                                <td>{{item.article.name}}</td>
                                                <td>{{item.article.unit.name}}</td>
                                                <td v-if="isRequestStorage">
                                                    <input type="text" class="form-control" v-model="item.cost">
                                                </td>
                                                <td>{{item.quantity}}</td>
                                               <!--  <td>
                                                    <input type="text" class="form-control" v-model="item.quantity_apro"> -->
                                                    <!-- {{item.quantity_apro}} -->
                                                <!-- </td> -->
                                            </tr>
                                            <tr v-if="isRequestStorage" >
                                                <td colspan="6" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                                <td>{{getTotalQuantity}}</td>
                                            </tr>
                                            <tr v-else>
                                                <td colspan="3" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                                <td>{{getTotalQuantity}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                            <!-- <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                <template slot="sort-asc-icon">
                                    <i class="fa fa-sort-asc"></i>
                                </template>
                                <template slot="sort-desc-icon">
                                    <i class="fa fa-sort-desc"></i>
                                </template>
                                <template slot="no-sort-icon">
                                    <i class="fa fa-sort"></i>
                                </template>

                                <template slot="quantity_apro" slot-scope="props">
                                    <input class='form-control' v-model="props.row.quantity_apro" >
                                </template>

                            </vue-bootstrap4-table> -->
                        </div>
                        </div>
                    </div>

                 <div class="col-md-6">
                      <div class="card">
                      <div class="card-body">
                        <h5>HISTORIAL DE MATERIAL SOLICITADO</h5>
                      <table class="table  table-bordered">
                                <thead>
                                    <tr class="bg-gray">
                                        <th scope="col">#</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col" v-if="isRequestStorage">Costo Unitario</th>
                                        <th scope="col">Cantidad Aprob.</th>
                                        <!-- <th scope="col">Cantidad Aprob.</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr v-for="(item,index) in histories" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.arti}}</td>
                                        <td>{{item.unidad}}</td>
                                        <td>{{item.cant}}</td>
                                      <!--   <td v-if="isRequestStorage">
                                            <input type="text" class="form-control" v-model="item.cost">
                                        </td> -->
                                        <!-- <td>{{item.quantity_apro}}</td> -->
                                       <!--  <td>
                                            <input type="text" class="form-control" v-model="item.quantity_apro"> -->
                                            <!-- {{item.quantity_apro}} -->
                                        <!-- </td> -->
                                    </tr>
                                    <!-- <tr v-if="isRequestStorage" > -->
                                     <!--    <td colspan="6" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td> -->
                                    <!-- </tr> -->
                                   <!--  <tr v-else>
                                        <td colspan="3" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                    </tr> -->

                                </tbody>
                            </table>
                      </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="registerModalApprob" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" id='formCategory' method="post" :action="url+'/confirm_request_Approve'" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel" v-if="isRequestStorage">Aprobar Solicitud de Traspaso Nro {{request.correlative}}</h5>
                        <h5 class="modal-title" id="registerModalLabel" v-else><strong>Aprobar Solicitud  Nro {{request.correlative}}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container-fluid" style="background-color:#adb5bd;">
                    <div class="modal-body">
                        <h5><strong>Datos del Solicitante</strong></h5>
                        <div class="row">
                            <div class="form-group  col-md-7">
                                <strong><label for="tipo">Funcionario:</label></strong>
                                <label for="tipo">{{request.person.prs_nombres+' '+request.person.prs_paterno+' '+request.person.prs_materno}} </label>
                                <br><strong><label for="tipo"> Gerencia:</label></strong>
                                <label for="tipo">{{gerencia}} </label>
                            </div>
                            <div class="form-group  col-md-5">
                                <strong><label for="tipo"> Fecha de solicitud:</label></strong>
                                <label for="tipo">{{request.created_at}} </label>
                            </div>

                        </div>
                        <input type="text" name="article_request_id" :value="request.id " hidden>
                        <input type="text" name="articles" :value="JSON.stringify(rows)" hidden>
                        <input type="text" name="type" value="Traspaso" v-if="isRequestStorage" hidden>
                        <input type="text" name="total_cost" :value="getTotalCost" v-if="isRequestStorage" hidden>

                        <center><p><h3><strong>ESTA SEGURO APROBAR LA SOLICITUD</strong></h3></p></center>
                    </div>
                    </div>

                    <div class="modal-footer">
                       <!--  <button type="button" class="btn btn-secondary" >Vista Previa</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

    </div> <!-- end row -->
</template>
<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
export default {
    props:['url','csrf','storage','request','gerencia','providers', 'histories','data'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        incomes: [],
        types:[{name: 'Ingreso'},{name:'Traspaso'},{name:'Reingreso'}],
        provider:{},
        // columns: [

        //     {
        //         label: "Articulo",
        //         name: "article.name",
        //         filter: {
        //             type: "simple",
        //             placeholder: "articulo"
        //         },
        //         sort: true,
        //     },

        //     {
        //         label: "Unidad",
        //         name: "article.unit.name",
        //         filter: {
        //             type: "simple",
        //             placeholder: "unidad"
        //         },
        //         sort: true,
        //     },

        //     {
        //         label: "Stock",
        //         name: "stock.stock",
        //         sort: true,
        //     },
        //     {
        //         label: "Cantidad Solicitada",
        //         name: "quantity",
        //         sort: true,
        //     },

        //     {
        //         label: "Cantidad",
        //         name: "quantity_apro",
        //         sort: true,
        //     },
        // ],
        // config: {
        //  card_mode: false,
        //  checkbox_rows: false,
        //  rows_selectable: false,
        //  global_search:  {
        //          placeholder:  "Enter custom Search text",
        //          visibility: false,
        //          case_sensitive:  false
        //  },
        //  show_refresh_button:  false,
        //  show_reset_button:  false,
        // },
        hasFile: false,

    }),
    mounted() {
        // this.rows = this.request;
        console.log('esteee',this.request.article_request_items.quantity);
        this.data = this.history;
        this.provider = this.providers[0];
        // console.log(this.articles);
       // console.log(this.articles);
    },
    methods: {
        addIncome(item, item2){
            this.incomes.push({article:item,quantity:item.quantity});
            //this.incomes.push({history:item2,quantity:item2.quantity});
            item.quantity = '';
            item.cost ='';

            // item2.quantity = '';
            // item2.cost ='';
            // console.log('esteee es',item2);
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
        subTotal(item){
            let sum = Number(item.quantity) * Number(item.cost);
            return sum;
        }


    },
    computed:{

         getTotalCost(){
            let cost= 0;
            this.rows.forEach(item => {
                // this.cost += parseInt(item.cost)
                cost += this.subTotal(item)
                // console.log(item.cost);
            });
            return cost;
        },
        getTotalQuantity(item){
            let quantity= 0;
            let sum = Number(item.quantity)
            this.request.article_request_items.forEach(item => {
                quantity += Number(item.quantity)
                // console.log('qqqq',quantity);
            });
            // console.log('qqqq',item.request.article_request_items);
            return quantity;
        },
        isRequestStorage() {
            let res=false;
            if(this.request.type =='Almacen'){
                res=true;
            }
            return res;
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
