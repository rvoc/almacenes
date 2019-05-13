<template>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                   Ingreso Articulos {{storage.name}}
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
                        <template slot="cost" slot-scope="props">
                            <input class='form-control' v-model="props.row.cost" >
                        </template>



                        <template slot="option" slot-scope="props">
                        <button class="btn btn-primary" @click="addIncome(props.row)"><i class='fa fa-cart-plus'></i></button>


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

                     Ingresos Pendientes
                      <small class="float-sm-right">
                           <button class="btn btn-success" ><i class="fa fa-shopping-cart"></i> Registrar  </button>
                           <button class="btn btn-default" ><i class="fa fa-ban"></i> Cancelar  </button>
                        </small>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Articulo</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Costo</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in incomes" :key="index">
                            <th scope="row">{{index+1}}</th>
                            <td>{{item.article.name}}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.cost}}</td>
                            <td><i class="fa fa-trash text-danger" @click="deleteIncome(index)"></i> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
export default {
    props:['articles','providers','url','csrf','storage'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        incomes: [],
        columns: [
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
                label: "Nombre",
                name: "name",
                filter: {
                    type: "simple",
                    placeholder: "nombre"
                },
                sort: true,
            },
            {
                label: "Cantidad",
                name: "quantity",
                // filter: {
                //     type: "simple",
                //     placeholder: "cantidad"
                // },
                // sort: true,
            },
            {
                label: "Costo",
                name: "cost",
                // filter: {
                //     type: "simple",
                //     placeholder: "Ejecucion"
                // },
                // sort: true,
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

    }),
    mounted() {
        this.rows = this.articles;
        console.log(this.articles);
        console.log(this.providers);
    },
    methods: {
        addIncome(item){
            this.incomes.push({article:item,quantity:item.quantity,cost:item.cost});
            item.quantity = '';
            item.cost ='';
            console.log(item);
        },
        deleteIncome(index){

            this.incomes.splice(index,1);
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
