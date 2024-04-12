<!----------------------------------MODAL DATOS FACTURA---------------------------------------------->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Facturación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h5><strong>Nombre/Razón Social: </strong><span id="name_modal"></span></h5>
                    <h5><strong>CIF / DNI: </strong><span id="dni_modal"></span></h5>
                    <h5><strong>Email: </strong><span id="email_modal"></span></h5>
                    <h5><strong>Ciudad: </strong><span id="ciudad_modal"></span></h5>
                    <h5><strong>Teléfono: </strong><span id="tel_modal"></span></h5>
                    <h5><strong>Dirección: </strong><span id="address_modal"></span></h5>
                    <h5><strong>Código Postal: </strong><span id="pobla_modal"></span></h5>
                    <h5><strong>País: </strong><span id="pais_modal"></span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ELIMINAR USUARIO -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body"> ¿Estás segur@ de que deseas eliminar a este usuario? <br>
                <span class="badge bg-dark p-1" id='modal_delete'>EMAIL</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_delete'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal SUBIR LISTADO DE USUARIOS -->
<div class="modal fade" id="exampleModalimport" tabindex="-1" aria-labelledby="exampleModalLabelimport"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelimport">Subir lista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form method="POST" enctype="multipart/form-data" id="import-form" class="text-start">
                    <div class="file-input text-start col-6  px-4">
                        <div class="mb-3">
                            <label class="form-label">Elegir Archivo Excel</label>
                            <input class="form-control rounded-pill" type="file" name="dataClientexl"
                                style=" background:linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);color: white;">
                        </div>
                    </div>
                    <div class="px-5" style="display: none" id="tabla_lista_duplicado">
                        <h5>Emails duplicados</h5>
                        <p>Debe cambiar el correo electrónico de estos usuarios para poder ser registrados. Esto se debe
                            a que existen registros en la base de datos que ya usan estos emails.</p>
                        <table class="table table-light table-striped px-4">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody id="imprime_lista_duplicado">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer text-end mt-5"> <a
                            href='https://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/archivos/dataClientesxl.xlsx'
                            download="Plantilla Codigo-Tecno" type="button"
                            class="btn btn-secondary me-auto rounded-pill download-link">
                            Descargar plantilla </a>
                        <button type="button" class="btn btn-enviar rounded-pill px-5 shadow-sm"
                            style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white"
                            id='subir_excel'><span class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span> Subir Excel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal CARGAR FACTURA -->
<div class="modal fade" id="exampleModalimportfact" tabindex="-1" aria-labelledby="exampleModalLabelimportfact"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelimportfact">Subir Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form method="POST" enctype="multipart/form-data" id="contact-acturas" class="text-start">
                    <div class="file-input text-start  px-4 col-6">
                        <div class="mb-3">
                            <label class="form-label">Elegir Archivo PDF</label>
                            <input class="form-control rounded-pill" type="file" name="datafact"
                                style=" background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);color: white;">
                        </div>
                        <label class="form-label" style='display:none'>¿Qué acciones desea realizar con los usuarios que
                            ya existen?</label>
                        <div class="form-check" style='display:none'>
                            <input class="form-check-input rounded-pill" type="radio" value='1' name="action"
                                id="radio1" checked>
                            <label class="form-check-label" for="radio1"> Saltar al siguiente </label>
                        </div>
                        <div class="form-check" style='display:none'>
                            <input class="form-check-input " type="radio" value='2' name="action" id="radio2">
                            <label class="form-check-label" for="radio2"> Actualizar datos </label>
                        </div>
                    </div>
                    <div class="mb-3 px-4">
                        <label class="form-label">Facturas Existentes</label>
                        <hr>
                    </div>
                    <div class="row px-4" id="facturas-mostradas"> </div>
                    <div class="modal-footer text-end mt-5">
                        <button type="button" class="btn btn-enviar rounded-pill px-5 shadow-sm"
                            style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white"
                            id='subir_fact'>Subir Factura</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!------MODAL ELIMINAR FACTURA------------------>
<div class="modal fade" id="eliminar-fact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-factLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-factLabel">Eliminar factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h6>¿Desea eliminar esta factura?</h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill" data-bs-dismiss="modal">
                    No</button>
                <a href='#' id="delete-factura" type="button" class="btn export px-5 rounded-pill shadow-sm"
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Si</a>
            </div>
        </div>
    </div>
</div>
<!------MODAL ACTIVE------------------>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Activar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> ¿Estás segur@ de que deseas activar a este usuario? <br>
                <span class="badge bg-dark p-1" id='modal_email'>EMAIL</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-5 shadow-sm" id='send_active'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Activar</button>
            </div>
        </div>
    </div>
</div>
<!------MODAL COBROS Y DEVOLUCIONES------------------>
<div class="modal fade" id="exampleModal8" tabindex="-1" aria-labelledby="exampleModalLabel8" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel8">Gestión de cobros y devoluciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><br>
                <div class="col-12">
                    <p> Pendietes y devoluviones por servicios. </p>
                    <table class="table table-hover m-auto mb-5">
                        <tbody id='tabla_costes'>
                            <tr>
                                <th class="border-start">Servicios</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th class='border-start border-end'>PAGADO</th>
                            </tr>
                            <tr id="tabla_usuario">
                                <td class="border-start">Cuota C.</td>
                                <td>0</td>
                                <td>0</td>
                                <td class='border-start border-end'>0</td>
                            </tr>
                            <?php if($generales_form['ESTADO_ACOMPA']==1): ?>
                            <tr id="tabla_acompa">
                                <td class="border-start">Cuota A.</td>
                                <td>0</td>
                                <td>0</td>
                                <td class='border-start border-end'>0</td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <p class="mt-2"> Listado de pedidos TPV. </p>
                    <p> <a class="btn btn-secondary rounded-pill btn-sm" data-bs-toggle="collapse"
                            href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Desplegar </a> </p>
                    <div class="collapse" id="collapseExample">
                        <table class="table table-hover m-auto mb-5">
                            <tbody id='tabla_pedidos'>
                                <tr>
                                    <th class="border-start">No de Pedido</th>
                                    <th class='border-start'>ESTADO</th>
                                    <th class='border-start border-end'>FECHA</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m-5"></div>
                    <p> Balance de pendientes y devoluciones. </p>
                    <table class="table table-hover m-auto mt-5">
                        <tbody id='tabla_totales'>
                            <tr>
                                <th class="border-start">TOTAL</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th class="border-end border-start ">TOTAL PAGADO</th>
                            </tr>
                            <tr>
                                <td class="border-start">TOTAL</td>
                                <td>0.00€</td>
                                <td>(CONFIRMADO)</td>
                                <td class="border-end border-start"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12 text-end w-100 px-0 mt-4">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm rounded-pill"
                                data-bs-toggle="dropdown" aria-expanded="false"> Confirmar </button>
                            <ul class="dropdown-menu">
                                <p hidden id="id_resolver_all"></p>
                                <button id="resolver_all" class="btn py-1  mx-2 rounded-pill px-5"
                                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);">Ejecutar</button>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 mt-5 px-0">
                        <div class="col-md-12 text-end w-100 px-0 mt-4">
                            <p class="text-start"> <a class="btn btn-secondary btn-sm rounded-pill"
                                    data-bs-toggle="collapse" href="#collapseExample2" role="button"
                                    aria-expanded="false" aria-controls="collapseExample2"> Devoluciones parciales </a>
                            </p>
                            <div class="collapse" id="collapseExample2">
                                <div class="card card-body">
                                    <p class='text-start' style="line-height: normal"> Debe introducir el porciento (%)
                                        a <strong>devolver</strong> y el sistema procederá a dar de baja todos los
                                        servicios y descontar de cada uno de ellos el porciento correspondiente a las
                                        devoluciones y retenciones. </p>
                                    <form id="devoluciones_parciales">
                                        <p class='text-start d-flex' style="line-height: normal;font-size: 24px;">
                                            <input name="porciento" class=" w-25 form-control border required text"
                                                type="number" placeholder="John" id="asunto-mensaje">
                                            &nbsp;&nbsp;%
                                            <button type="button" class="btn shadow-sm rounded-pill w-50 btn-sm ms-5"
                                                style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                                                Relizar Devolución</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------MODAL OCULTAR USUARIO------------------>
<div class="modal fade" id="ocultar_usuario" tabindex="-1" aria-labelledby="ocultar_usuarioLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 700px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ocultar_usuarioLabel8">Usuario Ocultos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><br>
                <div class="col-12 devolver">
                    <p>Listado de usuarios Inactivos. Estos usuarios no computan en ninguna de las métricas que se
                        reflejan en los editores de datos y tampoco tendrán acceso a su Áreal Personal.</p>
                    <table class="table table-hover m-auto mb-5">
                        <tbody id='tabla_costes'>
                            <tr>
                                <th class="border-start" style='font-size:11px'>ID</th>
                                <th class="border-start" style='font-size:11px'>Nombre</th>
                                <th class="border-start" style='font-size:11px'>Apellidos</th>
                                <th class="border-start" style='font-size:11px'>Email</th>
                                <th class="border-start" style='font-size:11px'>Acompa</th>
                                <th class="border-start" style='font-size:11px'>Hotel</th>
                                <th class="border-start" style='font-size:11px'>Fecha</th>
                                <th class='border-start border-end' style='font-size:11px'>Accion</th>
                            </tr>
                            <?php foreach($ocultos as $elemento): ?>
                            <tr>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['ID'] ?></td>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['NAME'] ?></td>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['SURNAME'] ?></td>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['EMAIL'] ?></td>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['ACOMPA'] ?></td>
                                <td class="border-start" style='font-size:11px'>
                                    <?php if($elemento['HABITACION']==""): echo "No"; else: echo "Si"; endif;?></td>
                                <td class="border-start" style='font-size:11px'><?php echo $elemento['DATE'] ?></td>
                                <td class='border-start border-end'>
                                    <p hidden><?php echo $elemento['ID'] ?></p>
                                    <button class='show btn bg-success btn-sm text-white rounded-pill'
                                        style='font-size:11px'>Activar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------MODAL ACTIVE------------------>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Activar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> ¿Estás segur@ de que deseas activar a este usuario? <br>
                <span class="badge bg-dark p-1" id='modal_email'>EMAIL</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-5 shadow-sm" id='send_active'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Activar</button>
            </div>
        </div>
    </div>
</div>
<!------MODAL SENDER------------------>
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel5">ENVIAR CONFIRMACIÓN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> La confirmación se enviará al siguiente email <span
                    class="badge bg-dark py-1 px-2 rounded-pill" id='modal_email_sender'>EMAIL</span> de forma
                predeterminada. <br>
                <br>
                Si desea enviar a otro email la confirmación escríbalo a continuación. <br>
                <label>&nbsp;Nuevo Email:</label>
                <input name="conf_email" class="form-control border required text" type="email" placeholder="John"
                    id="conf_email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-5 shadow-sm" id='send_sender'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Enviar</button>
            </div>
        </div>
    </div>
</div>

<!------MODAL MENSAJES------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop6Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop6Label">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="contactform-mensaje" method="post">
                        <fieldset>
                            <!-- form two columns start -->
                            <div class="row g-3 needs-validation">
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos del mensaje</h4>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label"> <span class="dtr-form-subtext">Usuario</span></label>
                                    <select class='form-control border required text' id="lista-usuarios">
                                        <option value='No'>Elija usuario destino...</option>
                                        <?php foreach($usuarios as $elemento):?>
                                        <option value='<?php echo $elemento['EMAIL']?>'>
                                            <?php echo  $elemento['ID']."  |  ".$elemento['NAME']." ".$elemento['SURNAME']."</p>"?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <p class="form-label"> <span class="dtr-form-subtext">Asunto</span></p>
                                    <input name="aname" class="form-control border required text" type="text"
                                        placeholder="John" id="asunto-mensaje">
                                </div>
                                <div class="col-md-12">
                                    <p class="form-label"> <span class="dtr-form-subtext">Mensaje</span></p>
                                    <textarea class="form-control border required text" style="height: 180px!important"
                                        id="texto-mensaje"></textarea>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <button id="mensaje_mail" class="btn p-3 w-100 rounded-pill px-5 shadow-sm"
                                        style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Enviar</button>
                                </div>
                        </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!------UPDATE ACOMPAÑANTE------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="acompa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop4Label">Acompañante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <form id="contactform-acompa">
                        <fieldset>
                            <!-- form two columns start -->
                            <div class="row g-3 needs-validation">
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Cuota Acompañante</h4>
                                </div>
                                <?php foreach($cuotas as $elemento): if($elemento['TIPO']=="ACOMPA"): ?>
                                <div class="col-3 ">
                                    <div class="cuota">
                                        <p hidden><?php echo $elemento['PRECIO'] ?></p>
                                        <?php echo $elemento['PRECIO'] ?>€
                                    </div>
                                </div>
                                <?php endif; endforeach;?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Método de pago</h4>
                                </div>
                                <?php if($m_pagos['TRANSFERENCIA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago11'>
                                        <p hidden>TRANSFERENCIA</p>
                                        Pago por Transferencia
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA_VECI']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago21'>
                                        <p hidden>TARJETA ECI</p>
                                        Pago con Tarjeta ECI
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago31'>
                                        <p hidden>TPV</p>
                                        Pago con Tarjeta
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago41'>
                                        <p hidden>FREE</p>
                                        Sin Coste
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Estado del pago</h4>
                                </div>
                                <div class="col-3">
                                    <div class="estado-pago" id='estado-pago11'>
                                        <p hidden>PAGADO</p>
                                        CONFIRMADO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago21'>
                                        <p hidden>PENDIENTE</p>
                                        PENDIENTE DE PAGO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago31'>
                                        <p hidden>DEVOLUCION</p>
                                        PENDIENTE DE DEVOLUCIÓN
                                    </div>
                                </div>
                                <div class="col-12 devolver_piloto mt-4">
                                    <div class="row mx-2">
                                        <div class="col-3 border-bottom px-2">CONFIRMADO</div>
                                        <div class="col-9 border-bottom text-end px-2">0.00€</div>
                                    </div>
                                </div>
                                <div class="col-12 devolver_piloto2 mt-4">
                                    <div class="row mx-2">
                                        <div class="col-3 border-bottom px-2 text-success">TOTAL PAGADO</div>
                                        <div class="col-9 border-bottom text-end text-success px-2">0.00€</div>
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos del Acompañante</h4>
                                </div>
                                <div class="col-md-6">
                                    <p class="form-label"> <span class="dtr-form-subtext">Nombre</span></p>
                                    <input name="aname" class="form-control border required text" type="text"
                                        id="aname">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> <span class="dtr-form-subtext">Apellidos</span></label>
                                    <input name="asurname" class="form-control border required text" type="text"
                                        id="aape">
                                </div>
                                <div class="col-md-6">
                                    <p class="form-label"> <span class="dtr-form-subtext">Correo Electrónico</span></p>
                                    <input name="aemail" class="form-control border required email" type="email"
                                        id="aemail">
                                </div>
                                <div class="col-md-6">
                                    <p class="form-label"> <span class="dtr-form-subtext">DNI</span></p>
                                    <input name="adni" class="form-control border" type="text required text" id="adni">
                                </div>
                                <div class="col-md-6">
                                    <p class="form-label"> <span class="dtr-form-subtext">Teléfono</span> </p>
                                    <input name="atel" class="form-control border" type="tel required text" id="atel">
                                </div>
                                <div class="col-md-12 mt-5">
                                    <button id="update_acompa" class="btn p-3 w-100 rounded-pill px-5 shadow-sm"
                                        style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Enviar</button>
                                </div>
                                <div id="formalert2"></div>
                                <div id="result2"></div>
                        </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger me-auto px-5 rounded-pill"
                    id="delete-acompa">Eliminar Acompañante</button>
                <button type="button" class="btn btn-secondary ms-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!------UPDATE HOTELES------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="hoteles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop4Label">Reservas de hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <form id="contactform-hotel">
                        <fieldset>
                            <!-- form two columns start -->
                            <div class="row g-3 needs-validation">
                                <div class="d-block w-100">
                                    <h6 class=" p-2 mb-0">Reservas</h6>
                                </div>
                                <div class="col-12 mt-0">
                                    <div class="row reservas_hotel">
                                        <div class="col-3 mt-3">
                                            <div class="new-reserva"> Crear Reserva</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="campos_hotel" style='display:none'>
                                    <div class="row">
                                        <hr class="mt-3">
                                        <div class="d-block w-100">
                                            <h6 class=" p-2">Fechas</h6>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="form-label" for="fentrada"> <span class="dtr-form-subtext">Fecha
                                                    de entrada</span></p>
                                            <input name="fentrada" class="form-control border required text" type="date"
                                                placeholder="John" id="fentrada"
                                                value='<?php echo $generales_form['F_ENTRADA']?>'>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="fsalida"> <span
                                                    class="dtr-form-subtext">Fecha de salida</span></label>
                                            <input name="fsalida" class="form-control border required text" type="date"
                                                placeholder="Martínez Pérez" id="fsalida"
                                                value='<?php echo $generales_form['F_SALIDA']?>'>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="d-block w-100">
                                                <h6 style="margin-top: 30px;">Noches <span class="badge bg-secondary"
                                                        id="noches">0</span></h6>
                                            </div>
                                        </div>
                                        <div class="d-block w-100 mt-4">
                                            <h6 class=" p-2">Habitación</h6>
                                        </div>
                                        <?php foreach($habitaciones as $elemento): ?>
                                        <div class="col-4">
                                            <div class="categoria_hab" id='personal'>
                                                <p hidden><?php echo $elemento['PRECIO']; ?></p>
                                                <?php echo $elemento['HABITACION']; ?><br>
                                                (<?php echo $elemento['PRECIO']; ?>€)
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <div class="m-2"></div>
                                        <div class="d-block w-100 mt-4">
                                            <h6 class=" p-2">Método de pago</h6>
                                        </div>
                                        <?php if($m_pagos['TRANSFERENCIA']==1): ?>
                                        <div class="col-3  mb-3">
                                            <div class="m-pago" id='m-pago12'>
                                                <p hidden>TRANSFERENCIA</p>
                                                Pago por Transferencia
                                            </div>
                                        </div>
                                        <?php endif; if($m_pagos['TARJETA_VECI']==1): ?>
                                        <div class="col-3 mb-3">
                                            <div class="m-pago" id='m-pago22'>
                                                <p hidden>TARJETA ECI</p>
                                                Pago con Tarjeta ECI
                                            </div>
                                        </div>
                                        <?php endif; if($m_pagos['TARJETA']==1): ?>
                                        <div class="col-3  mb-3">
                                            <div class="m-pago" id='m-pago32'>
                                                <p hidden>TPV</p>
                                                Pago con Tarjeta
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-3 mb-3 ">
                                            <div class="m-pago" id='m-pago42'>
                                                <p hidden>FREE</p>
                                                Sin Coste
                                            </div>
                                        </div>
                                        <div class="d-block w-100 mt-4">
                                            <h6 class=" p-2">Estado del pago</h6>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <div class="estado-pago-hotel" id='estado-pago12'>
                                                <p hidden>PAGADO</p>
                                                CONFIRMADO
                                            </div>
                                        </div>
                                        <div class="col-3  mb-3">
                                            <div class="estado-pago-hotel" id='estado-pago22'>
                                                <p hidden>PENDIENTE</p>
                                                PENDIENTE DE PAGO
                                            </div>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <div class="estado-pago-hotel" id='estado-pago32'>
                                                <p hidden>DEVOLUCION</p>
                                                PENDIENTE DE DEVOLUCIÓN
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
                                            <h6 class="p-2 mt-3">Observaciones</h6>
                                            <textarea name="nota_reserva" id="nota_reserva"
                                                class="form-control border required text p-3" maxlength="1000"
                                                style="height: 100px;color:#939393"></textarea>
                                        </div>
                                        <div class="col-12 devolver2 mt-3">
                                            <div class="row mx-2 mt-5">
                                                <div class="col-3 border-bottom px-2">CONFIRMADO</div>
                                                <div class="col-9 border-bottom text-end  px-2">0.00€</div>
                                            </div>
                                        </div>
                                        <div class="col-12 devolver3 mt-3" style="display: none;">
                                            <div class="row mx-2">
                                                <div class="col-3 border-bottom px-2">TOTAL</div>
                                                <div class="col-9 border-bottom text-end  px-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 devolver4 mt-3" style="display: none;">
                                            <div class="row mx-2">
                                                <div class="col-3 border-bottom px-2 text-black">COSTE RESERVA</div>
                                                <div class="col-9 border-bottom text-end px-2 text-black"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <button id="update_hotel" class="btn p-3 w-100 rounded-pill px-5 shadow-sm"
                                                style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Actualizar</button>
                                            <button type="button"
                                                class="btn btn-outline-danger me-auto px-5 rounded-pill mt-5"
                                                id="delete-hotel">Eliminar Reserva</button>
                                        </div>
                                        <div id="formalert2"></div>
                                        <div id="result2"></div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary ms-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!------MODAL CATEGORIAS------------------>
<div class="modal fade" id="categorias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="categoriasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriasLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <h6>+ Agregar categoría de usuario nueva</h6>
                        <label class="form-label mt-4"> <span class="dtr-form-subtext">Nombre de la
                                categoría</span></label>
                        <div class="col-8">
                            <input class="form-control border required text" type="text" id="campo_categoria">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-success guardar-hotel py-1 rounded-pill w-100"
                                id='add_categoria'>Agregar</button>
                        </div>
                        <label class="form-label mt-4"> <span class="dtr-form-subtext">Asociar a una
                                cuota</span></label>
                        <div class="col-8 mb-5">
                            <select class="select form-control rounded-pill" name="categoria_asociada">
                                <option value="">Elija una cuota...</option>
                                <?php foreach($cuotas as $elemento):?>
                                <option value='<?php echo $elemento["NAME"];?>'><?php echo $elemento["NAME"];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <h6>Categorías existentes</h6>
                        <?php foreach($categorias as $elemento):?>
                        <div class="btn-group dropend col-6 mb-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle rounded-pill"
                                data-bs-toggle="dropdown" aria-expanded="false"><?php echo $elemento['NAME'] ?></button>
                            <ul class="dropdown-menu rounded-3">
                                <p hidden> <?php echo $elemento['ID'] ?></p>
                                <li class="categoria_edit"><a class="dropdown-item text-warning" href="#">Editar</a>
                                </li>
                                <p hidden> <?php echo $elemento['ID'] ?></p>
                                <li class="categoria_delete"><a class="dropdown-item text-danger" href="#">Eliminar</a>
                                </li>
                            </ul>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------UPDATE USER------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop4Label">Editar Datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <form id="contactform2" method="post">
                        <fieldset>
                            <!-- form two columns start -->

                            <div class="d-block w-100">
                                <h4 class=" p-2">Categoría de Asistente</h4>
                            </div>
                            <!-- form two columns start -->
                            <div class="row g-3 needs-validation">
                                <?php foreach($categorias as $elemento):?>
                                <div class="col-6 py-1">
                                    <div class="categoria" id='<?php $elemento['NAME'] ?>'>
                                        <p hidden><?php echo $elemento['NAME'] ?></p>
                                        <?php echo $elemento['NAME'] ?>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Cuotas</h4>
                                </div>
                                <?php foreach($cuotas as $elemento): if($elemento['TIPO']=="ASISTENTE"):?>
                                <div class="col-3 ">
                                    <div class="cuota">
                                        <p hidden><?php echo $elemento['PRECIO'] ?></p>
                                        <?php echo $elemento['PRECIO'] ?>€
                                    </div>
                                </div>
                                <?php endif; endforeach ?>

                                <div class="d-block w-100">
                                    <h4 class=" p-2">Método de pago</h4>
                                </div>
                                <?php if($m_pagos['TRANSFERENCIA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago1'>
                                        <p hidden>TRANSFERENCIA</p>
                                        Pago por Transferencia
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA_VECI']==1): ?>
                                <div class="col-3">
                                    <div class="m-pago" id='m-pago2'>
                                        <p hidden>TARJETA ECI</p>
                                        Pago con Tarjeta ECI
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago3'>
                                        <p hidden>TPV</p>
                                        Pago con Tarjeta
                                    </div>
                                </div>
                                <?php endif;  ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago4'>
                                        <p hidden>FREE</p>
                                        Sin Coste
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Estado del pago</h4>
                                </div>
                                <div class="col-3">
                                    <div class="estado-pago" id='estado-pago1'>
                                        <p hidden>PAGADO</p>
                                        CONFIRMADO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago2'>
                                        <p hidden>PENDIENTE</p>
                                        PENDIENTE DE PAGO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago3'>
                                        <p hidden>DEVOLUCION</p>
                                        PENDIENTE DE DEVOLUCIÓN
                                    </div>
                                </div>
                                <div class="col-12 devolver_piloto mt-4">
                                    <div class="row mx-2">
                                        <div class="col-3 border-bottom px-2">CONFIRMADO</div>
                                        <div class="col-9 border-bottom text-end px-2">0.00€</div>
                                    </div>
                                </div>
                                <div class="col-12 devolver_piloto2 mt-4">
                                    <div class="row mx-2">
                                        <div class="col-3 border-bottom px-2 text-success">TOTAL PAGADO</div>
                                        <div class="col-9 border-bottom text-end text-success px-2">0.00€</div>
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos Personales</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ) {
            if ( $elemento[ 'TIPO' ] == "USUARIO"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO"
                    and $elemento[ 'CAMPO' ] != "PASS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="<?php echo $elemento['CAMPO'] ?>" id="<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php  elseif ( $elemento[ 'CAMPO' ] == "PASS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="<?php echo $elemento['CAMPO'] ?>" id="<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="password"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php   elseif ( $elemento[ 'CAMPO' ] == "TITULO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select form-control rounded-pill"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            id="<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> Título</option>
                                            <option value='Sr'>Sr</option>
                                            <option value='Sra'>Sra</option>
                                            <option value='Dr'>Dr</option>
                                            <option value='Dra'>Dra</option>
                                        </select>
                                    </div>
                                </div>
                                <?php  elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            id="<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "TIPO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            id="<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
        endif;
        endif;
        }

        if ( $generales_form[ 'ESTADO_PROF' ] == 1 ) {
            ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos de Profesionales</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "PROF"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="P<?php echo $elemento['CAMPO'] ?>"
                                        id="P<?php echo $elemento['CAMPO'] ?>" class="form-control border required text"
                                        type="text" <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php         elseif ( $elemento[ 'CAMPO' ] == "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control "
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            id="P<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>Tipo de Centro</option>
                                            <option value='Clínica'>Clínica</option>
                                            <option value='Hospital'>Hospital</option>
                                            <option value='Universidad'>Universidad</option>
                                            <option value='Clínica Privada'>Clínica Privada</option>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            id="P<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; endif; endforeach;} ?>
                                <?php if($generales_form['ESTADO_FACTURA']==1):?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos de Facturación</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "FACT"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="F<?php echo $elemento['CAMPO'] ?>"
                                        id="F<?php echo $elemento['CAMPO'] ?>" class="form-control border required text"
                                        type="text" <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php
        elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="F<?php echo $elemento['CAMPO'] ?>"
                                            id="F<?php echo $elemento['CAMPO'] ?>" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
        endif;
        endif;
        endforeach;
        endif;
        ?>
                                <?php if($generales_form['ESTADO_EXTRAS']==1): ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Información</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "EXTRA_SER"
                and $elemento[ 'ESTADO' ] == 1 ):
                ?>
                                <div class="col-lg-12 pl-0 col-md-12 my-4 text-left">
                                    <div class="form-check pl-0 text-left px-5">
                                        <input class="form-check-input" type="checkbox" value="No"
                                            name="E<?php echo $elemento['CAMPO'] ?>"
                                            id="E<?php echo $elemento['CAMPO'] ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $elemento['CAMPO'] ?>"><?php echo $elemento['PLACEHOLDER'] ?></label>
                                    </div>
                                </div>
                                <?php
        endif;
        endforeach;
        ?>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "EXTRA"
                and $elemento[ 'ESTADO' ] == 1 ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="E<?php echo $elemento['CAMPO'] ?>"
                                        id="E<?php echo $elemento['CAMPO'] ?>" class="form-control border required text"
                                        type="text" <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php
        endif;
        endforeach;
        ?>
                                <?php  endif; ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Secretaría Técnica</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "INTERNO"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="<?php echo $elemento['CAMPO'] ?>" id="<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php         elseif ( $elemento[ 'CAMPO' ] == "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control "
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>Tipo de Centro</option>
                                            <option value='Clínica'>Clínica</option>
                                            <option value='Hospital'>Hospital</option>
                                            <option value='Universidad'>Universidad</option>
                                            <option value='Clínica Privada'>Clínica Privada</option>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; endif; endforeach; ?>
                                <div class="col-md-12">
                                    <button id="update" class="btn p-3 w-100 rounded-pill px-5 shadow-sm" type="button"
                                        style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Actualizar</button>
                                </div>
                                <div id="formalert2"></div>
                                <div id="result2"></div>
                        </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!------CREATE USER------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop4Label">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <form id="contactform3" method="post">
                        <fieldset>
                            <div class="d-block w-100">
                                <h4 class=" p-2">Categoría de Asistente</h4>
                            </div>
                            <!-- form two columns start -->
                            <div class="row g-3 needs-validation">
                                <?php foreach($categorias as $elemento):?>
                                <div class="col-6 ">
                                    <div class="categoria">
                                        <p hidden><?php echo $elemento['NAME'] ?></p>
                                        <?php echo $elemento['NAME'] ?>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Cuotas</h4>
                                </div>
                                <?php foreach($cuotas as $elemento): if($elemento['TIPO']=="ASISTENTE"):?>
                                <div class="col-3 ">
                                    <div class="cuota" id='cuota1'>
                                        <p hidden><?php echo $elemento['PRECIO'] ?></p>
                                        <?php echo $elemento['PRECIO'] ?>€
                                    </div>
                                </div>
                                <?php endif; endforeach ?>

                                <div class="d-block w-100">
                                    <h4 class=" p-2">Método de pago</h4>
                                </div>
                                <?php if($m_pagos['TRANSFERENCIA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago1'>
                                        <p hidden>TRANSFERENCIA</p>
                                        Pago por Transferencia
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA_VECI']==1): ?>
                                <div class="col-3">
                                    <div class="m-pago" id='m-pago2'>
                                        <p hidden>TARJETA ECI</p>
                                        Pago con Tarjeta ECI
                                    </div>
                                </div>
                                <?php endif; if($m_pagos['TARJETA']==1): ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago3'>
                                        <p hidden>TPV</p>
                                        Pago con Tarjeta
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-3 ">
                                    <div class="m-pago" id='m-pago4'>
                                        <p hidden>FREE</p>
                                        Sin Coste
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Estado del pago</h4>
                                </div>
                                <div class="col-3">
                                    <div class="estado-pago" id='estado-pago1'>
                                        <p hidden>PAGADO</p>
                                        CONFIRMADO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago2'>
                                        <p hidden>PENDIENTE</p>
                                        PENDIENTE DE PAGO
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="estado-pago" id='estado-pago3'>
                                        <p hidden>DEVOLUCION</p>
                                        PENDIENTE DE DEVOLUCIÓN
                                    </div>
                                </div>
                                <div class="col-12 devolver" style="display: none">
                                    <div class="row mx-2">
                                        <div class="col-3 border-bottom px-2">A devolver</div>
                                        <div class="col-9 border-bottom text-end text-danger px-2">-550.00€</div>
                                    </div>
                                </div>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos Personales</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "USUARIO"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO"
                    and $elemento[ 'CAMPO' ] != "PASS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php  elseif ( $elemento[ 'CAMPO' ] == "PASS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="password"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php   elseif ( $elemento[ 'CAMPO' ] == "TITULO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select form-control rounded-pill"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> Título</option>
                                            <option value='Sr'>Sr</option>
                                            <option value='Sra'>Sra</option>
                                            <option value='Dr'>Dr</option>
                                            <option value='Dra'>Dra</option>
                                        </select>
                                    </div>
                                </div>
                                <?php  elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "TIPO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
        endif;
        endif;
        endforeach;

        if ( $generales_form[ 'ESTADO_PROF' ] == 1 ) {
            ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos de Profesionales</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "PROF"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="P<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php         elseif ( $elemento[ 'CAMPO' ] == "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control "
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>Tipo de Centro</option>
                                            <option value='Clínica'>Clínica</option>
                                            <option value='Hospital'>Hospital</option>
                                            <option value='Universidad'>Universidad</option>
                                            <option value='Clínica Privada'>Clínica Privada</option>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; endif; endforeach; }?>
                                <?php if($generales_form['ESTADO_FACTURA']==1):?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Datos de Facturación</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "FACT"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="F<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php
        elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="F<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
        endif;
        endif;
        endforeach;
        endif;
        ?>
                                <?php if($generales_form['ESTADO_EXTRAS']==1): ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Información</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "EXTRA_SER"
                and $elemento[ 'ESTADO' ] == 1 ):
                ?>
                                <div class="col-lg-12 pl-0 col-md-12 my-4 text-left">
                                    <div class="form-check pl-0 text-left px-5">
                                        <input class="form-check-input" type="checkbox" value="No"
                                            id="<?php echo $elemento['CAMPO'] ?>"
                                            name="E<?php echo $elemento['CAMPO'] ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $elemento['CAMPO'] ?>"><?php echo $elemento['PLACEHOLDER'] ?></label>
                                    </div>
                                </div>
                                <?php
        endif;
        endforeach;
        ?>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "EXTRA"
                and $elemento[ 'ESTADO' ] == 1 ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="E<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php
        endif;
        endforeach;
        ?>
                                <?php  endif; ?>
                                <div class="d-block w-100">
                                    <h4 class=" p-2">Secretaría Técnica</h4>
                                </div>
                                <?php
        foreach ( $campos as $elemento ):
            if ( $elemento[ 'TIPO' ] == "INTERNO"
                and $elemento[ 'ESTADO' ] == 1 ):
                if ( $elemento[ 'CAMPO' ] != "PAIS"
                    and $elemento[ 'CAMPO' ] != "TITULO"
                    and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <input name="P<?php echo $elemento['CAMPO'] ?>"
                                        class="form-control border required text" type="text"
                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                </div>
                                <?php         elseif ( $elemento[ 'CAMPO' ] == "TIPO_CENTRO" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['CAMPO'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control "
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'>Tipo de Centro</option>
                                            <option value='Clínica'>Clínica</option>
                                            <option value='Hospital'>Hospital</option>
                                            <option value='Universidad'>Universidad</option>
                                            <option value='Clínica Privada'>Clínica Privada</option>
                                        </select>
                                    </div>
                                </div>
                                <?php elseif ( $elemento[ 'CAMPO' ] == "PAIS" ): ?>
                                <div class="col-md-6">
                                    <p class="form-label"> <span
                                            class="dtr-form-subtext"><?php echo $elemento['PLACEHOLDER'] ?></span></p>
                                    <div class="form-group">
                                        <select class="select rounded-pill form-control"
                                            name="P<?php echo $elemento['CAMPO'] ?>"
                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                            <option value='0'> País</option>
                                            <?php
              foreach ( $paises as $elemento2 ): ?>
                                            <option value="<?php echo $elemento2['PAIS']?>">
                                                <?php echo $elemento2['PAIS']?></option>
                                            <?php
              endforeach;
              ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; endif; endforeach; ?>
                                <div class="col-md-12">
                                    <button type="button" id="create_user"
                                        class="btn p-3 w-100 rounded-pill px-5 shadow-sm"
                                        style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Crear
                                        Usuario</button>
                                </div>
                                <div id="formalert2"></div>
                                <div id="result2"></div>
                        </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto px-5 rounded-pill"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!------MODAL TRABAJANDO------------------>
<div class="modal fade" id="modal_trabajando" tabindex="-1" aria-labelledby="modal_trabajandoLabel5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_trabajandoLabel5">MENSAJE DE LA PAGINA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>En estos momentos estamos trabajando para habilitar este apartado lo antes posible. Inténtelo más
                    adelante. Lamentamos las molestias.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
            </div>
        </div>
    </div>
</div>