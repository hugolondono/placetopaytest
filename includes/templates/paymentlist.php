<script>
    $(document).ready(function () {
        payment_list();
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
                    Histórico de Pagos
                </li>
            </ul>
        </div>

        <div class="alert alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text"></div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-md-12">

                <div class="grid">

                    <form name="frm-delete">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código Pago</th>
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>E-mail</th>
                                    <th>Estado</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            <tbody class="paymentList">
                            </tbody>
                        </table>
                    </form>

                </div>

            </div>
        </div>
        <p></p>

    </div>
</div>