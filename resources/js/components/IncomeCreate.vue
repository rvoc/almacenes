<template>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="row">
                <div class="col-md-9">
                    <div class="card-header">
                       <center><h5><strong>INGRESO ARTICULOS: {{storage.name}}</strong></h5></center>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- <button class="btn btn-info" @click="addIncomemasivo()">INGRESAR TODO <i class='fa fa-cart-plus'></i>
                    </button> -->
                </div>
                </div>
                <div class="card-body">
                    <vue-bootstrap4-table :rows="rows"  :columns="columns" :config="config">
                        <template slot="sort-asc-icon">
                            <i class="fa fa-sort-asc"></i>
                        </template>
                        <template slot="sort-desc-icon">
                            <i class="fa fa-sort-desc"></i>
                        </template>
                        <template slot="option" >
                            <i class="fa fa-sort"></i>
                        </template>

                        <template slot="quantity" slot-scope="props">
                            <input class='form-control' v-model="props.row.quantity" >
                        </template>
                        <template slot="cost" slot-scope="props">
                            <input class='form-control' v-model="props.row.cost" @keyup.enter="addIncome(props.row)"  >
                            <!--<input type="text" name="">-->
                        </template>



                        <template slot="option" slot-scope="props">
                        <button class="btn btn-info" @click="addIncome(props.row)"><i class='fa fa-cart-plus'></i></button>


                            <!-- <v-icon @click="getDetail(props)" data-toggle="modal" data-target="#taskModalDetail"
                                small>
                                remove_red_eye
                            </v-icon>
                            <v-icon @click="edit(props)" data-toggle="modal" data-target="#taskModalExecuted"
                                small>
                                edit
                            </v-icon> -->
                        </template>

                    </vue-bootstrap4-table>
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <!-- <i class="fa fa-shopping-cart"></i> -->

                     <center><h5><strong>INGRESOS PENDIENTES</strong></h5></center>
                      <small class="float-sm-right">
                          <button class="btn btn-success" data-toggle="modal" data-target="#registerModal"><i
                                  class="fa fa-shopping-cart"></i> Registrar </button>
                          <button class="btn btn-default"><i class="fa fa-ban"></i> Cancelar </button>
                      </small>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Articulo</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Costo Unitario</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in incomes" :key="index">
                                <th scope="row">{{index+1}}</th>
                                <td>{{item.article.name}}</td>
                                 <td>{{item.quantity}}</td>
                                <td>{{item.cost}}</td>
                                <td>{{subTotal(item)}}</td>
                                <td><i class="fa fa-trash text-danger" @click="deleteIncome(index)"></i> </td>
                            </tr>
                            <tr >
                                <td colspan="2" class="text-right " > <strong>TOTAL:</strong> </td>
                                <td>{{getTotalQuantity}}</td>
                                <td>{{getTotCost}}</td>
                                <td>{{getTotalCost}}</td>
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
                        <h5 class="modal-title" id="registerModalLabel">Datos de Ingreso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <legend>Datos de Ingreso</legend> -->

                        <div class="row">
                            <div class="form-group  col-md-6">
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
                            </div>
                            <div class="form-group  col-md-3">
                                <input type="text" name="type" v-if="form.type" :value="form.type.name" hidden>
                                <label for="tipo">Tipo</label>
                                <multiselect
                                    v-model="form.type"
                                    :options="types"
                                    id="tipo"
                                    placeholder="Seleccionar tipo"
                                    select-label="Seleccionar"
                                    deselect-label="Remover"
                                    selected-label="Seleccionado"
                                    label="name"
                                    track-by="name" >
                                </multiselect>
                                <div class="invalid-feedback">{{ errors.first("tipo") }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-md-6">
                                <!-- <input type="text" name="provider_id" v-if="form.provider" :value="form.provider.id" hidden> -->
                                <label for="tipo">Factura</label>
                                <div class="input-group ">
                                    <div >
                                        <input type="file"  name="path_invoice" @change="onFileChange" >
                                    </div>
                                </div>
                                <div class="invalid-feedback">{{ errors.first("tipo") }}</div>
                            </div>
                            <div class="form-group  col-md-3" v-if="hasFile">
                                <label for="tipo">Nota Remision</label>
                                    <input type="text" name="remision_number" class="form-control" v-model="form.remision_number">
                                <div class="invalid-feedback">{{ errors.first("tipo") }}</div>
                            </div>
                            <div class="form-group  col-md-3" v-if="hasFile">
                                <label for="tipo">Fecha</label>
                                 <input type="text" class="form-control datepickerDays" id="id_res_fin" name="id_res_fin" placeholder="yyy/mm/dd">  
                                    <input type="text" name="date" id="id_dia" class="form-control" v-model="form.date">
                                <div class="invalid-feedback">{{ errors.first("tipo") }}</div>
                            </div>
                            <input type="text" name="articles" :value="JSON.stringify(incomes)" hidden>
                            <input type="text" name="total_cost" :value="getTotalCost" hidden>
                        </div>
                        <h5>Detalle de Ingreso</h5>

                        <div class="row">
                            <table class="table  table-bordered">
                                <thead>
                                    <tr class="bg-gray">
                                    <th scope="col">#</th>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in incomes" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{item.article.name}}</td>
                                        <td>{{item.quantity}}</td>
                                        <td>{{item.cost}}</td>
                                        <td>{{ subTotal(item) }}</td>

                                        <!-- <td><i class="fa fa-trash text-danger" @click="deleteIncome(index)"></i> </td> -->
                                    </tr>
                                    <tr >
                                        <td colspan="2" class="text-right bg-gray" > <strong>TOTAL:</strong> </td>
                                        <td>{{getTotalQuantity}}</td>
                                        <td>{{getTotCost}}</td>
                                        <td>{{getTotalCost}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" @click="vistaprevia()">Vista Previa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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
            <div class="modal-body" width="100%" height="600%">
                <iframe src="" width="100%" height="600px" frameborder="0" allowtransparency="true"></iframe>
            </div>
            </div>
        </div>
        </div>


    </div> <!-- end row -->
</template>

<script>
  // $('#id_dia',).datepicker({
  //       format: "yyyy/mm/dd",
  //       language: "es",
  //       autoclose: true,
  //   }).datepicker("setDate", new Date());
import VueBootstrap4Table from 'vue-bootstrap4-table';
export default {
    props:['articles','providers','url','csrf','storage'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        incomes: [],
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
                label: "Partida",
                name: "budget_item.name",
                filter: {
                    type: "simple",
                    placeholder: "partida"
                },
                sort: true,
            },
            {
                label: "Unidad Medida",
                name: "unit.name",
            },
           
             {
                label: "Cantidad",
                name: "quantity",
            },
            {
                label: "Costo Unitario",
                name: "cost",
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
        this.rows = this.articles;

        console.log(this.articles);
        console.log(this.providers);
    },
    methods: {
        addIncome(item){
             console.log('articulossss',item.quantity);
             console.log('itemtab',this.row);
             if(item.quantity>0 && item.cost>0)
             {
                // alert('es mayor a cero');
                this.incomes.push({article:item,quantity:item.quantity,cost:item.cost});
                item.quantity = '';
                item.cost ='';
             }else{
                 Swal.fire(
                    'La cantidad y costo unitario debe ser mayor a 0 !',
                    '',
                    'warning'
                )

             }

           // let cant = this.articles;
            console.log(item);
        },

        addIncomemasivo(){
             console.log('ingreso de datos');
             console.log(this.rows);
            // console.log('articulossss',this.incomes.push({article:item,quantity:item.quantity,cost:item.cost}));
             // if(item.quantity>0 && item.cost>0)
             // {
             //    // alert('es mayor a cero');
             //    this.incomes.push({article:item,quantity:item.quantity,cost:item.cost});
             //    item.quantity = '';
             //    item.cost ='';
             // }else{
             //    alert('La cantidad y costo unitario no debe ser vacio y debe ser mayor a 0!!!');
             // }

           // let cant = this.articles;
           // console.log(item);
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
            return numeral(sum).format('0.00');
        },


        vistaprevia(){
            console.log('ingreso de datos',this.form.provider.name);

            let parameters = this.form.provider.name;

            let url='/reporte_vista_previa?provider='+encodeURIComponent(this.form.provider.name)+'&type='+encodeURIComponent(this.form.type.name)+'&numremision='+encodeURIComponent(this.form.remision_number)+'&fecha='+encodeURIComponent(this.form.date)+'&incomes='+encodeURIComponent(JSON.stringify(this.incomes));

            console.log(url);
             $('#modalPdf .modal-body iframe').attr('src', url);
             $('#modalPdf').modal('show');
            // if(this.form.data)
            // {
            //     axios.get(`listalmacenesSal1/${this.form.data.id}`).then(response=>{
                        // this.form = response.data.article;
                        // console.log(response.data);
                        // this.rows = response.data;
                        // console.log(this.rows);

            //     });
            // }
        },

    },
    computed:{
        getTotalCost(){
            let cost= 0;
            this.incomes.forEach(item => {
                // this.cost += parseInt(item.cost)
                cost += Number(this.subTotal(item))
                // console.log(item.cost);
            });
            return numeral(cost).format('0.00');
        },
        getTotalQuantity(){
            let quantity= 0;
            this.incomes.forEach(item => {
                // this.quantity += parseInt(item.quantity)
                quantity += Number(item.quantity)
                console.log(item.quantity);
            });
            return numeral(quantity).format('0.00');
        },
        getTotCost(){
            let cost= 0;
            this.incomes.forEach(item => {
                // this.quantity += parseInt(item.quantity)
                cost += Number(item.cost)
                console.log(item.cost);
            });
            return cost;
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
