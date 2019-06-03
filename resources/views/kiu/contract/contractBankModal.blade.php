 <!-- Aqui Coloco el mensaje modal para Condiciones Bancarias -->

                        <div class="modal bs-example-modal-lg" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModalBank" style="margin-top: 5%; font-size: 12px;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel" style="text-align: center;">@lang('payment.contitte')</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div style="text-align: center;">
                                            <img style="width: 25%;height: 10%;" src="{{ asset('img/CondBancaria.png')}}">
                                        </div>
                                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="aceptoCondicionBank();" style="margin-top: 2.4%" >@lang('payment.noigree')
                                                </button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('payment.igree')
                                                </button> 
                                            </div>  
                                </div>
                            </div>
                        </div>
                        
                                    
               
                <!-- Termino Modal para Condiciones Bancarias -->
