<template>
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <form id='formChange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                <div class="card-body">
                    <h5 class="card-title">Solicitud de Cambio en Ingreso</h5>
                    <div class="row">
                        <div class="form-group  col-md-3">
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
                                track-by="name" 
                                @input="mostrar()"
                                >
                            </multiselect>

                             <!-- <div v-if="sw">
                              <label><input type="radio" id="articulo" v-model="articulo" @input="mostrart()"> ARTICULO</label>
                              <label><input type="radio" id="cantidad" v-model="cantidad" @input="mostrarcant()"> CANTIDAD</label>
                              <label><input type="radio" id="costo" v-model="costo"  @input="mostrarcost()"> COSTO</label>
                              <br>
                            </div> -->
                            <div class="invalid-feedback">{{ errors.first("type") }}</div>
                        </div>

                         <div class="form-group  col-md-3" v-if="sw">
                            <input type="text" name="change" v-if="form.changes" :value="form.changes.id" hidden>
                            <br>
                            <multiselect
                                v-model="form.changes"
                                :options="changes"
                                id="change"
                                placeholder="Seleccionar una opcion"
                                select-label="Seleccionar"
                                deselect-label="Remover"
                                selected-label="Seleccionado"
                                label="name"
                                track-by="name" 
                                @input="change()"
                                >
                            </multiselect>
                            <div class="invalid-feedback">{{ errors.first("type") }}</div>
                        </div>

                        <div class="form-group  col-md-3" v-if="button"><br>
                             <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newItemModal">Adicionar Item</button>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="lbobservation">Descripcion</label>
                            <input type="text" class="form-control" id="observation" name="observation" v-model="form.observation" placeholder="Detalle el motivo de la Solicitud" v-validate="'required'">
                            <div class="invalid-feedback">{{ errors.first("observation") }}</div>
                        </div>
                        <input type="text" name="request_income_items" :value="JSON.stringify(items)" hidden>
                        <div class="col-md-4">
                            Numero de Ingreso: {{income.correlative}} <br>
                            Fecha de Ingreso: {{income.created_at}} <br>
                            Proveedor: {{income.provider.name}} <br>
                          <!--   <input type="text" class="form-control" hidden="" v-model="item.new_cost=0" :disabled="isDeleted()" >
                            <input type="text" class="form-control" hidden="" v-model="item.new_quantity=0" :disabled="isDeleted()" > -->
                           <label v-if="income.path_invoice">N° Remision: {{income.remision_number}}</label><br>
                        </div>
                        <div class="col-md-6" v-if="nota"><br><br><br>
                           <label>Nuevo N° Remision:</label>
                           <input type="text" name="request_income_items">
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
                                        <th scope="col" v-if="articulo">Nuevo Articulo</th>
                                        <th scope="col" v-if="costo">Nuevo Costo</th>
                                        <th scope="col" v-if="cantidad">Nueva Cantidad</th>

                                     </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in items" :key="index" >
                                            <td>{{index+1}}</td>
                                            <td>{{item.article.name}}</td>
                                            <td>{{item.article.unit.name}}</td>
                                            <td>{{item.cost}}</td>
                                            <td>{{item.quantity}}</td>
                                            <!-- <input type="text" name="provider_id" v-if="item.article.id" :value="item.article.id"> -->
                                            <td v-if="articulo">
                                                <input type="text" name="provider_id" v-if="item.arti" :value="item.arti.id" hidden>
                                                <multiselect
                                                    v-model="item.arti"
                                                    :options="articles"
                                                    id="articulo"
                                                    placeholder="Seleccionar Articulo"
                                                    select-label="Seleccionar"
                                                    deselect-label="Remover"
                                                    selected-label="Seleccionado"
                                                    label="name"
                                                    track-by="name"
                                                    >
                                                </multiselect>
                                               <!--  {{ item.article}} -->
                                            </td>
                                            <td v-if="costo">
                                                <input type="text" class="form-control" value="0" v-model="item.new_cost" :disabled="isDeleted()" >
                                            </td>
                                            <td v-if="cantidad">
                                                <input type="text" class="form-control" value="0" v-model="item.new_quantity" :disabled="isDeleted()" >
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
                    <iframe src="" width="100%" height="100%" frameborder="0" allowtransparency="true"></iframe>
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
        changes:[{id:1,name:'Articulo'},{id:2,name:'Cantidad'},{id:3,name:'Costo'},{id:4,name:'N° Remision'},{id:5,name:'Adicionar Item'}],
        items:[],
        item:{},
        sw:false,
        articulo:false,
        cantidad:false,
        costo:false,
        button:false,
        nota:false,
        // new_quantity:0,
    }),
    mounted() {
        // console.log(this.income);
        this.items = this.income.article_income_items;
        console.log('ESTE ES ITEM',this.income);
        console.log(this.articles);

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
        mostrar() {
               // var tipo = document.getElementById('types').value;
               console.log('tipooo',this.form.type.id);
               let tipo = this.form.type.id;
                 if(tipo==2){
                  this.sw=true;
                  }else
                  {
                    this.sw=false;
                    // item.new_cost = 0;
                    // item.new_quantity = 0;
                  }
            },

         change() {
               // var tipo = document.getElementById('types').value;
               console.log('modddd',this.form.changes.id);
               let combo = this.form.changes.id;
                 if(combo==1){
                  this.articulo=true;
                  this.cantidad=false;
                  this.costo=false;
                  this.nota=false;
                  this.button=false;

                  console.log('art',this.articulo);
                  let mostcant = this.cantidad;
                       if(mostcant==false){
                         this.items.forEach(item => {
                                item.new_quantity =0
                                item.new_cost =0
                                return item;
                            });
                       }
                  }if(combo==2)
                  {
                    this.articulo=false;
                    this.costo=false;
                    this.button=false;
                    this.nota=false;
                    this.cantidad=true;
                    console.log('cant',this.cantidad);
                       let mostcant = this.cantidad;
                       if(mostcant==false){
                         this.items.forEach(item => {
                                item.new_quantity =0
                                item.new_cost =0
                                return item;
                            });
                       }
                  }if(combo==3)
                  {
                    this.cantidad=false;
                    this.articulo=false;
                    this.button=false;
                    this.nota=false;
                    this.costo=true;
                    console.log('cost',this.costo);
                    let mostcost = this.costo;
                    if(mostcost==false){
                     this.items.forEach(item => {
                            item.new_quantity =0
                            item.new_cost =0
                            return item;
                        });
                    }
                  }if(combo==4)
                  {
                    this.cantidad=false;
                    this.articulo=false;
                    this.costo=false;
                    this.button=false;
                    this.nota=true;
                  }if(combo==5)
                  {
                    this.cantidad=false;
                    this.articulo=false;
                    this.costo=false;
                    this.nota=false;
                    this.button=true;
                  }
            },
         mostrarcost() {
               // var tipo = document.getElementById('types').value;
               console.log('cost',this.costo);
                // console.log('artid',this.item.article.id);
               let mostcost = this.costo;
               if(mostcost==false){
                 this.items.forEach(item => {
                        item.new_quantity =0
                        item.new_cost =0
                        // item.arti =this.item.article
                        return item;
                    });
               }
            },
         mostrarcant() {
               // var tipo = document.getElementById('types').value;
               console.log('cant',this.cantidad);
               let mostcant = this.cantidad;
               if(mostcant==false){
                 this.items.forEach(item => {
                        item.new_quantity =0
                        item.new_cost =0
                        // item.arti =this.item.article
                        // item.arti.id =0
                        // item.arti =0
                        return item;
                    });
               }
            },

         mostrart() {
               // var tipo = document.getElementById('types').value;
               console.log('art',this.articulo);
               let mostart = this.articulo;
               if(mostart==false){
                 this.items.forEach(item => {
                        item.new_quantity =0
                        item.new_cost =0
                        return item;
                    });
               }
            },
         mostraridart() {
               // var tipo = document.getElementById('types').value;
               // this.form.type.id
               console.log('artisuloid',this.item.article);
               let mostart = this.articulo;
               if(mostart==false){
                 this.items.forEach(item => {
                        item.new_quantity =0
                        item.new_cost =0
                        return item;
                    });
               }
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
