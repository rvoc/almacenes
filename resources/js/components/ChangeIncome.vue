<template>
    <div class="row">
        <div class="col-md-10">

            <div class="card">
                <form id='formChange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                <div class="card-body">
                    <h5 class="card-title">Solicitud de Cambio en Ingreso</h5>
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <input type="text" name="article_income_id" :value="income.id" hidden>
                            <input type="text" name="type" v-if="form.type" :value="form.type.name" hidden>
                            <label for="tipo">Tipo</label>
                            <multiselect
                                v-model="form.type"
                                :options="types"
                                id="tipo"
                                placeholder="Seleccionar Tipo"
                                select-label="Seleccionar"
                                deselect-label="Remover"
                                selected-label="Seleccionado"
                                label="name"
                                track-by="name" >

                            </multiselect>
                            <div class="invalid-feedback">{{ errors.first("type") }}</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="lbobservation">Descripcion</label>
                            <input type="text" class="form-control" id="observation" name="observation" v-model="form.observation" placeholder="Detalle el motivo de la Solicitud" v-validate="'required'">
                            <div class="invalid-feedback">{{ errors.first("observation") }}</div>
                        </div>
                        <input type="text" name="request_income_items" :value="JSON.stringify(items)" hidden>
                        <div class="col-md-6">
                            Numero de Ingreso: {{income.correlative}} <br>
                            Fecha de Ingreso: {{income.created_at}} <br>
                            <button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#newItemModal">Adicionar Item</button>
                        </div>
                        <br>
                        <div class="col-md-12">

                                <table class="table">
                                     <thead>
                                        <th scope="col">Nro</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Nuevo Costo</th>
                                        <th scope="col">Nueva Cantidad</th>

                                     </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in items" :key="index" >
                                            <td>{{index+1}}</td>
                                            <td>{{item.article.name}}</td>
                                            <td>{{item.article.unit.name}}</td>
                                            <td>{{item.cost}}</td>
                                            <td>{{item.quantity}}</td>
                                            <td>
                                                <input type="text" class="form-control" v-model="item.new_cost" :disabled="isDeleted()" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" v-model="item.new_quantity" :disabled="isDeleted()" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>


                </div>
                </form>
            </div>
        </div>
        <!-- aqui los modals -->
        <div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newItemModalLabel">Adicionando Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                              <div class="form-group  col-md-12">
                                <input type="text" name="provider_id" v-if="item.article" :value="item.article.id" hidden>
                                <label for="Articulo">Articulo</label>
                                <multiselect
                                    v-model="item.article"
                                    :options="articles"
                                    id="Articulo"
                                    placeholder="Seleccionar Articulo"
                                    select-label="Seleccionar"
                                    deselect-label="Remover"
                                    selected-label="Seleccionado"
                                    label="name"
                                    track-by="name" >
                                </multiselect>
                                <div class="invalid-feedback">{{ errors.first("Articulo") }}</div>
                            </div>
                            <div class="form-group  col-md-12">
                                <label for="cost">Costo</label>
                                    <input type="text"  class="form-control" v-model="item.new_cost">
                                <div class="invalid-feedback">{{ errors.first("cost") }}</div>
                            </div>
                            <div class="form-group  col-md-12" >
                                <label for="quantity">Cantidad</label>
                                    <input type="text" class="form-control" v-model="item.new_quantity">
                                <div class="invalid-feedback">{{ errors.first("quantity") }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addItem()">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { constants } from 'crypto';
export default {
     props:['url','csrf','income','articles'],
    data:()=>({
        form:{},
        types:[{id:1,name:'Eliminacion'},{id:2,name:'Modificacion'}],
        items:[],
        item:{}
    }),
    mounted() {
        // console.log(this.income);
        this.items = this.income.article_income_items;
        console.log(this.items);
        console.log(this.articles);

        // axios.get('../list_units')
        //      .then(response => {
        //          this.units = response.data;
        //          console.log(response.data)
        //      });

    },
    computed:{

    },
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formChange");
                    console.log(form);
                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },
        addItem(){
            console.log(this.income);

            this.item.article_income_id = this.income.id;
            this.item.article_id = this.item.article.id;
            this.item.created_at = this.income.created_at;
            this.item.deleted_at = this.income.deleted_at;
            this.item.updated_at = this.income.updated_at;
            this.item.quantity= 0;
            this.item.cost = 0;
            this.item.id = 0;
            console.log(this.item);
            this.items.push(this.item);
        },
        isDeleted()
        {
            let deleted = false;
            // console.log(this.form.type);
            if(this.form.type)
            {
                if(this.form.type.name=="Eliminacion"){
                    deleted = true;
                    this.items.forEach(item => {
                        item.new_quantity =0
                        item.new_cost =0
                        return item;
                    });
                }else
                {
                        // this.items.forEach(item => {
                        //     item.new_cost = item.cost;
                        //     return item;
                        // });
                }
            }
            return deleted;
        }

    },
}
</script>
