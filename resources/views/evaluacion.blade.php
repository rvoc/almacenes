
<div class="modal fade" id="modal_encuesta" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #563d7c;">
          <h4 class="col-12 modal-title text-center" style="color: white;">EVALUACIÓN DEL SISTEMA - SAES</h4>
        </div>
        <div class="modal-body">
            <form action="/action_page.php">
              <input id="token" name="csrf-token" type="hidden" value="{{ csrf_token() }}">
              <!-- <div class="form-group">
                <label><h5><strong>¿El sistema es de facil acceso?</strong></h5></label>
                <div class="row">                  
                    <div class="radio col" style="font-size: 20px">
                      <label>
                       <input type="radio" name="o1" value="SI" id="respuesta1" checked>
                       <span class="cr"><i class="cr-icon fas fa-circle"></i></span>
                       Si
                       </label>
                    </div>
                    
                    <div class="radio col" style="font-size: 20px">
                      <label>
                       <input type="radio" name="o1" value="NO" id="respuesta1">
                       <span class="cr"><i class="cr-icon fas fa-circle"></i></span>
                       No
                       </label>
                    </div>
                  <div class="col"></div>
                </div>
              </div> -->
              <!-- <div class="form-group">
                <label><h5><strong>¿El sistema genera reportes, boletas oportunas?</strong></h5></label>
                <div class="row">                
                  <div class="radio col" style="font-size: 20px">
                    <label>
                     <input type="radio" name="o2" value="SI" id="respuesta1" checked>
                     <span class="cr"><i class="cr-icon fas fa-circle"></i></span>
                     Si
                     </label>
                  </div>               
                  <div class="radio col" style="font-size: 20px">
                    <label>
                     <input type="radio" name="o2" value="NO" id="respuesta1">
                     <span class="cr"><i class="cr-icon fas fa-circle"></i></span>
                     No
                     </label>
                  </div>
                 <div class="col"></div>                
                </div>
              </div> -->
              <div class="text-center">
                <div class="form-group">
                  <label><h5><strong>¿Tiene alguna observación y/o sugerencia?</strong></h5></label>                     
                       <textarea type="text" name="o3" value="" rows="3" id="sugerencia" class="form-control"> </textarea>              
                </div>
              </div>
        <div class="text-center">
          <div class="form-group">
            <label><h4><strong>VALORACIÓN AL SISTEMA SAES</strong></h4></label>
                <h1 style="font-size: 70px;"><div id="Estrellas"></div></h1>
            </div>
          </div>
          
        
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-lg" id="RegistrarEvaluacion">Enviar mi Evaluación</button>
          <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal" id="NoEvaluar">Evaluar más tarde</button>
        </div>
      </div>
      
    </div>
</div>


