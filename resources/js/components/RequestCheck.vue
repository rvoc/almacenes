<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{storage.name}}: Solicitud {{request.correlative}}
                  <br>
                   Solicitante: {{request.full_name}}
                    <!-- {{rows}} -->
                     <small class="float-sm-right">
                           <button class="btn btn-success" data-toggle="modal" data-target="#registerModal" ><i class="fa fa-user-check"></i> Aprobar  </button>
                           <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDisApproved"><i class="fa fa-user-times"></i> Rechazar  </button>
                           <a :href="url" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar </a>
                           <!-- <button class="btn btn-default" ><i class="fa fa-ban"></i> Cancelar  </button> -->
                        </small>
                </div>
                <div class="card-body">
                      <table class="table  table-bordered">
                                <thead>
                                    <tr class="bg-gray">
                                        <th scope="col">#</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col" v-if="isRequestStorage">Costo Unitario</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Cantidad Sol.</th>
                                        <th scope="col">Cantidad Aprob.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr v-for="(item,index) in rows" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.article.name}}</td>
                                        <td>{{item.article.unit.name}}</td>
                                        <td v-if="isRequestStorage">
                                            <input type="text" class="form-control" v-model="item.cost">
                                        </td>
                                        <td>{{item.stock.stock}}</td>
                                        <td>{{item.quantity}}</td>
                                        <td>
                                            <input type="text" class="form-control" v-model="item.quantity_apro">
                                            <!-- {{item.quantity_apro}} -->
                                        </td>
                                    </tr>
                                    <tr v-if="isRequestStorage" >
                                        <td colspan="6" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="5" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                    </tr>

                                </tbody>
                            </table>
                </div>
            </div>

        </div>

        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" id='formCategory' method="post" :action="url+'/confirm_request'" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel" v-if="isRequestStorage">Aprobar Solicitud de Traspaso Nro {{request.correlative}}</h5>
                        <h5 class="modal-title" id="registerModalLabel" v-else>Aprobar Solicitud  Nro {{request.correlative}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Datos del Solicitante</h5>
                        <div class="row">
                            <div class="form-group  col-md-8">
                                <label for="tipo">Funcionario: {{request.full_name}} </label>
                                <br><label for="tipo"> Gerencia: {{gerencia}} </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="tipo"> Fecha de solicitud: {{request.created_at}} </label>
                            </div>

                        </div>
                        <input type="text" name="article_request_id" :value="request.id " hidden>
                        <input type="text" name="articles" :value="JSON.stringify(rows)" hidden>
                        <input type="text" name="type" value="Traspaso" v-if="isRequestStorage" hidden>
                        <input type="text" name="total_cost" :value="getTotalCost" v-if="isRequestStorage" hidden>
                        <h5>Detalle de Solicitud</h5>

                        <div class="row">
                            <table class="table  table-bordered">
                                <thead>
                                    <tr class="bg-gray">
                                        <th scope="col">#</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col" v-if="isRequestStorage">costo</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col" v-if="isRequestStorage">Subtotal</th>

                                    </tr>
                                </thead>
                                <tbody>
                                     <tr v-for="(item,index) in rows" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.article.name}}</td>
                                        <td>{{item.article.unit.name}}</td>
                                        <td v-if="isRequestStorage">{{item.cost}}</td>
                                        <td>{{item.quantity_apro}}</td>
                                        <td v-if="isRequestStorage">{{subTotal(item)}}</td>

                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="vistaprevia()">Vista Previa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

          <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="modalPdfTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPdfTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" width="100%" height="600px" frameborder="0" allowtransparency="true"></iframe>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalDisApproved" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" id='formCategory' method="post" :action="url+'/disapproved_request'">
                    <div v-html='csrf'></div>
                    <div class="modal-body">   
                        <input type="text" name="article_request_id" :value="request.id " hidden>
                        <input type="text" name="articles" :value="JSON.stringify(rows)" hidden>
                        <input type="text" name="type" value="Traspaso" v-if="isRequestStorage" hidden>
                        <input type="text" name="total_cost" :value="getTotalCost" v-if="isRequestStorage" hidden>
                    <center><p><h3 style="color:#922d31;"><strong>ESTA SEGURO DE RECHAZAR<br>LA SOLICITUD Nro {{request.correlative}}?</strong></h3></p></center>
                    </div>
                              <!--   <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <strong><label>Observaciones:</label></strong><br>
                                            <textarea class="md-textarea form-control" rows='3' placeholder="Observaciones"></textarea>
                                        </div>
                                    </div>
                                </div><br> -->
                    <div class="modal-footer" style="display:block;">
                       <!--  <button type="button" class="btn btn-secondary" >Vista Previa</button> -->
                        <center><button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">SI</button></center>
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
    props:['articles','url','csrf','storage','request','gerencia','providers'],
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
		// 	card_mode: false,
		// 	checkbox_rows: false,
		// 	rows_selectable: false,
		// 	global_search:  {
		// 			placeholder:  "Enter custom Search text",
		// 			visibility: false,
		// 			case_sensitive:  false
		// 	},
		// 	show_refresh_button:  false,
		// 	show_reset_button:  false,
        // },
        hasFile: false,

    }),
    mounted() {
        this.rows = this.articles;
        this.provider = this.providers[0];
        // console.log(this.articles);
        // console.log(this.gerencia);
    },
    methods: {
        addIncome(item){
            this.incomes.push({article:item,quantity:item.quantity});
            item.quantity = '';
            item.cost ='';
            console.log(item);
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
        },

        vistaprevia(){
             console.log('ingreso de datos salida',this.rows);

             let parameters = this.rows;
           
            let url='/reporte_vista_RequestCheck?funcionario='+encodeURIComponent(this.request.full_name)+'&gerencia='+encodeURIComponent(this.gerencia)+'&salidas='+encodeURIComponent(JSON.stringify(this.rows));

             console.log('del url',url);
            $('#modalPdf .modal-body iframe').attr('src', url);
            $('#modalPdf').modal('show');     
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
        getTotalQuantity(){
            let quantity= 0;
            this.rows.forEach(item => {
                quantity += Number(item.quantity_apro)
            });
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
