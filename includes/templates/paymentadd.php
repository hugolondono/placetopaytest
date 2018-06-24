<script>
    $(document).ready(function () {
        load_back_list();
        load_province_list();
    });
</script>
<div class="row">
    <div class="col-md-12">

        <div class="toolbar">
            <ul class="breadcrumb">
                <li>
                    <a href="payment?page=add"><span data-phrase="HomePage" class="glyphicon glyphicon-home ewIcon" data-caption="Inicio"></span></a>
                </li>
                <li class="active">
                    Realizar Pago
                </li>
            </ul>
        </div>

        <div class="alert alert-dismissable">
            <button type="button" class="close" onclick="remove_alert();">×</button>
            <div class="alert-text"></div>
        </div>

        <p></p>
        <div class="row">
            <div class="col-md-4">

                <form name="form-payment" class="form-horizontal">
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_type_payment">Tipo de pago</label>
                        <div class="col-sm-8">
                            <span id="el_type_payment">
                                <select class="form-control" id="x_type_payment" name="x_type_payment">
                                    <option value="">Seleccione opción...</option>
                                    <option value="0">Personas</option>
                                    <option value="1">Empresa</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_bank_id">Banco</label>
                        <div class="col-sm-8">
                            <span id="el_bank_id">
                                <select class="form-control" id="x_bank_id" name="x_bank_id">
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_type_document">Tipo de documento</label>
                        <div class="col-sm-8">
                            <span id="el_type_document">
                                <select class="form-control" id="x_type_document" name="x_type_document">
                                    <option value="">Seleccione opción...</option>
                                    <option value="CC">Cédula de ciudanía</option>
                                    <option value="CE">Cédula de extranjería</option>
                                    <option value="TI">Tarjeta de identidad</option>
                                    <option value="PPN">Pasaporte</option>
                                    <option value="NIT">Número de identificación tributaria</option>
                                    <option value="SSN">Social Security Number</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_document">Documento</label>
                        <div class="col-sm-8"> 
                            <span id="el_document">
                                <input type="text" class="form-control" id="x_document" name="x_document" placeholder="Nombres">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_name">Nombre</label>
                        <div class="col-sm-8"> 
                            <span id="el_name">
                                <input type="text" class="form-control" id="x_name" name="x_name" placeholder="Nombres">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_last_name">Apellidos</label>
                        <div class="col-sm-8">
                            <span id="el_last_name">
                                <input type="text" class="form-control" id="x_last_name" name="x_last_name" placeholder="Apellidos">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="x_company">Empresa</label>
                        <div class="col-sm-8">
                            <span id="el_company">
                                <input type="text" class="form-control" id="x_company" name="x_company" placeholder="Nombre de la compañía en la cual labora o representa">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_email_address">E-mail</label>
                        <div class="col-sm-8">
                            <span id="el_email_address">
                                <input type="email" class="form-control" id="x_email_address" name="x_email_address" placeholder="Correo electrónico">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_address">Dirección</label>
                        <div class="col-sm-8">
                            <span id="el_address">
                                <input type="email" class="form-control" id="x_address" name="x_address" placeholder="Dirección postal completa">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_province">Departamento</label>
                        <div class="col-sm-8">
                            <span id="el_province">
                                <select class="form-control" id="x_province" name="x_province" onchange="load_city_list();">
                                    <option value="">Seleccione opción...</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_city">Ciudad</label>
                        <div class="col-sm-8">
                            <span id="el_city">
                                <select class="form-control" id="x_city" name="x_city">
                                    <option value="">Seleccione opción...</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="x_phone">Teléfono</label>
                        <div class="col-sm-8">
                            <span id="el_phone">
                                <input type="email" class="form-control" id="x_phone" name="x_phone" placeholder="Número de telefonico">
                            </span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-4" for="x_mobile">Celular</label>
                        <div class="col-sm-8">
                            <span id="el_mobile">
                                <input type="email" class="form-control" id="x_mobile" name="x_mobile" placeholder="Número de celular">
                            </span>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-4 col-sm-8">
                            <button id="btn_save" name="btn_save" class="btn btn-primary btn_save">Realizar Pago</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <p></p>

    </div>
</div>