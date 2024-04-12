<!----MODULOS---->
<div class="modal fade" id="modulos" tabindex="-1" aria-labelledby="modulosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modulosLabel">Módulos</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modulos_form">
                    <div class="row mb-4 p-4">
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5 ">
                                    <input class="form-check-input" type="checkbox" role="switch" name="acompa"
                                        val='No'>
                                    <span class="form-check-label">Módulo de Acompñante</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="ser" val='No'>
                                    <span class="form-check-label">Módulo de Servicios</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="alojamiento"
                                        val='No'>
                                    <span class="form-check-label">Módulo de Alojamiento</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="factura"
                                        val='No'>
                                    <span class="form-check-label">Módulo de Facturación</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="profesional"
                                        val='No'>
                                    <span class="form-check-label">Módulo de Profesionales</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_modulo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="streaming"
                                        val='No'>
                                    <span class="form-check-label">Módulo de Streaming</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_modulos'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Guardar
                    Cambios</button>
            </div>
        </div>
    </div>
</div>
<!----MODULOS ENVIO CONFIRMACIONES MASIVO---->

<div class="modal fade" id="masivos_confirmaciones" tabindex="-1" aria-labelledby="masivos_confirmacionesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masivos_confirmacionesLabel">Envío de confirmaciones</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="masivos_form">
                    <div class="p-4">
                        <h4>Usuarios Registrados</h4>
                        <p class="mb-0">Seleccione los usuarios registrados que desea enviar la confirmación de
                            inscripción junto al resumen de los servicios solicitados.</p>
                    </div>
                    <div class="row mb-4 mx-4 px-2" style="max-height: 370px; overflow-y: scroll">
                        <?php foreach($usuarios as $elemento): if($elemento['VISIBILIDAD']==0):?>
                        <div class="col-6 p-1">
                            <div class="bg-light rounded-pill p-1 shadow-sm container_masivo" style="cursor: pointer">
                                <div class="form-check form-switch ps-5 ">
                                    <input class="form-check-input" type="checkbox" name="acompa" val='No'
                                        id="<?php echo $elemento['ID']?>">
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <label class="form-check-label label_masivo" for="<?php echo $elemento['ID']?>">
                                        <span
                                            style='font-size: 11px;color: #575757;font-weight: 700'><?php echo $elemento['ID']?>
                                            | </span><span
                                            style='font-size: 11px;'><?php echo $elemento['NAME']." ".$elemento['SURNAME']."<br>".$elemento['CATEGORIA']?></span></label>
                                </div>
                            </div>
                        </div>
                        <?php endif; endforeach; ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <span>Usuarios Seleccionados: <span id='masivo_counter' class="badge p-1 bg-success">0</span></span>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_masivo'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white"><span
                        class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        style="display: none;"></span> Enviar confirmación</button>
            </div>
        </div>
    </div>
</div>

<!----GENERALES DEL EVENTO---->

<div class="modal fade" id="generales_evento" tabindex="-1" aria-labelledby="generales_eventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generales_eventoLabel">Generales del Evento</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="evento_form">
                    <div class="p-4">
                        <h4>Datos generales</h4>
                        <p class="mb-0">Datos generales del evento</p>
                    </div>
                    <div class="row mb-4 mx-4 px-2">
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Nombre del evento</span></p>
                            <input name="evento_name" class="form-control border required text" type="text"
                                value="<?php echo $evento['NAME']?>">
                        </div>
                        <div class="col-md-6 mb-3"> </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Fecha de inicio</span></p>
                            <input name="evento_finicio" class="form-control border required text" type="date"
                                value="<?php echo $evento['FECHA_INICIO']?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Fecha de cierre</span></p>
                            <input name="evento_fcierre" class="form-control border required text" type="date"
                                value="<?php echo $evento['FECHA_CIERRE']?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Email de Secretaría técnica</span></p>
                            <input name="evento_email" class="form-control border required text" type="text"
                                value="<?php echo $evento['EMAIL_SECRETARIA']?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Teléfono de Secretaría técnica</span>
                            </p>
                            <input name="evento_tel" class="form-control border required text" type="text"
                                value="<?php echo $evento['TEL_SECRETARIA']?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Empresa de Secretaría técnica</span>
                            </p>
                            <input name="evento_empresa" class="form-control border required text" type="text"
                                value="<?php echo $evento['EMPRESA_SECRETARIA']?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Color principal</span></p>
                            <input name="evento_color" class="form-control border required text" type="color"
                                value="<?php echo $evento['COLOR']?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_evento'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<!----CREAR HABITACION---->

<div class="modal fade" id="crear_habitacion" tabindex="-1" aria-labelledby="crear_habitacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crear_habitacionLabel">Crear habitación</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="hab_create_form">
                    <div class="row mb-4 mx-4 px-2">
                        <div class="p-4">
                            <h4>Habitaciones</h4>
                            <p class="mb-0">Debe introducir los datos de la habitación que desea ingresar en el sistema.
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Nombre de la Habitación</span></p>
                            <input name="hab_name" class="form-control border required text" type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Precio/noche</span></p>
                            <input name="hab_precio" class="form-control border required text" type="number" step="any">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Hotel</span></p>
                            <input name="hab_hotel" class="form-control border required text" type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Tipo de habitación</span></p>
                            <select name="hab_tipo" class="form-control border required text" type="text">
                                <option value='Personal'>Personal</option>
                                <option value='Doble'>Doble</option>
                                <option value='Triple'>Triple</option>
                                <option value='Bungaló'>Bungaló</option>
                            </select>
                        </div>
                        <div class="p-4">
                            <h4>Habitaciones creadas</h4>
                            <p class="mb-0">Estas son las habitaciones que existen actualmente en el sistema. </p>
                        </div>
                        <?php foreach($habitaciones as $elemento):?>
                        <div class="col-4">
                            <ul class="list-group shadow-sm" style="border-radius: 20px">
                                <li class="list-group-item active" aria-current="true"
                                    style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                    <?php echo $elemento['HABITACION'] ?></li>
                                <li class="list-group-item border-bottom p-2 bg-none"><strong>Hotel:</strong>
                                    <?php echo $elemento['HOTEL'] ?></li>
                                <li class="list-group-item border-bottom p-2 bg-none"><strong>Precio:</strong>
                                    <?php echo $elemento['PRECIO'] ?>€</li>
                                <li class="list-group-item p-2 bg-none"><strong>Tipo:</strong>
                                    <?php echo $elemento['TIPO'] ?></li>
                                <li class="list-group-item p-2 bg-none"
                                    style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
                                    <div class="d-flex px-4">
                                        <p hidden><?php echo $elemento['ID'] ?></p>
                                        <p class="text-warning opt  lista_hab me-auto">Editar</p>
                                        <p hidden><?php echo $elemento['ID'] ?></p>
                                        <p class="text-danger delete_hab_card opt ms-auto">Eliminar</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_hab_create'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<!------HOTELES CAPACIDADES------------------>
<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop3Label" aria-hidden="true">
    <div class="modal-dialog modal-xl " style="z-index:5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdrop3Label">Gestión de Capacidades</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-4">
                    <h6>Fecha de Entrada y salidas de reservas.</h6>
                    <form id="fechas_hoteles">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="form-label"> <span class="dtr-form-subtext">Inicio de Reservas</span></p>
                                <input name="fecha_inicial_reservas" class="form-control border required text"
                                    type="date" value="<?php echo $generales_form["F_ENTRADA"] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="form-label"> <span class="dtr-form-subtext">Fin de Reservas</span></p>
                                <input name="fecha_final_reservas" class="form-control border required text" type="date"
                                    value="<?php echo $generales_form["F_SALIDA"] ?>">
                            </div>
                            <div class="col-md-12 mt-2 mb-5">
                                <button id="send_fecha_hoteles" type="button"
                                    class="btn p-2 w-100 rounded-pill px-5 shadow-sm"
                                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">Actualizar
                                    fechas</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container px-4">
                    <h6>Gestione las capacidades de las fechas seleccionadas.</h6>
                    <div class="accordion" id="accordionExample">
                        <?php $cuenta_hotel=0; foreach($hoteles as $elemento): $cuenta_hotel++ ?>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header rounded-pill border">
                                <button class="accordion-button collapsed p-2 rounded-pill px-4" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $cuenta_hotel ?>"
                                    aria-expanded="false" aria-controls="collapse<?php echo $cuenta_hotel ?>">
                                    <?php echo $elemento['FECHA']?> </button>
                            </h2>
                            <div id="collapse<?php echo $cuenta_hotel ?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-4 total_hab">
                                                <label>Agregar cupos</label>
                                                <input class="form-control border required text" type="number"
                                                    value="<?php echo $elemento['TOTAL']?>"
                                                    placeholder=".form-control-lg" aria-label=".form-control-lg example"
                                                    name='codigo'>
                                                <p class="my-4">Disponibilidad:
                                                    <?php if($elemento['DISPONIBLES']>0): echo "<span class='badge-success px-2  rounded'>$elemento[DISPONIBLES]</span>"; else:  echo "<span class='badge-danger px-2 rounded'>$elemento[DISPONIBLES]</span>"; endif;?>
                                                </p>
                                            </div>
                                            <div class="col-4 prebloqueo">
                                                <label>Prebloqueo</label>
                                                <input class="form-control border required text" type="number"
                                                    value="<?php echo $elemento['PRE_BLOQUEO']?>"
                                                    placeholder=".form-control-lg" aria-label=".form-control-lg example"
                                                    name="cantidad">
                                                <p class="my-4">Reservadas:
                                                    <?php  echo "<span class='badge-warning px-2  rounded'>$elemento[RESERVADAS]</span>";?>
                                                </p>
                                            </div>
                                            <div class="col-4"> <br>
                                                <p hidden><?php echo $elemento['FECHA']?></p>
                                                <p>
                                                    <button type="button"
                                                        class="btn btn-success my-2 guardar-hotel rounded-pill">Guardar
                                                        Cambios</button>
                                                </p>
                                            </div>
                                            <div class="col-4"> </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
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

<!---- SLECCION DE CAMPOS ---->

<div class="modal fade" id="campos_formularios" tabindex="-1" aria-labelledby="campos_formulariosLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campos_formulariosLabel">Campos del Formulario</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="masivos_form">
                    <div class="p-4">
                        <h4>Configuración de campos del formulario</h4>
                        <p class="mb-0">Seleccione los campos que desea agregar al formulario de inscripci'on para cada
                            módulo disponible.</p>
                    </div>
                    <div class="row mb-4 mx-4 px-2">
                        <h6>Datos personales</h6>
                        <?php
            foreach ( $campos as $elemento ) {
                if ( $elemento[ 'TIPO' ] == 'USUARIO' ):
                    if ( $elemento[ 'ESTADO' ] == 0 ):
                        ?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='<?php echo $elemento['TIPO']?>'>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm "
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                        </div>
                        <?php else:?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No' checked>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php
            endif;
            endif;
            }
            ?>
                    </div>
                    <?php if($generales_form['ESTADO_PROF']==1): ?>
                    <div class="row mb-4 mx-4 px-2">
                        <h6>Datos profesionales</h6>
                        <?php
            foreach ( $campos as $elemento ) {
                if ( $elemento[ 'TIPO' ] == 'PROF' ):
                    if ( $elemento[ 'ESTADO' ] == 0 ):
                        ?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No'>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php else:?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No' checked>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php
            endif;
            endif;
            }
            ?>
                    </div>
                    <?php endif; if($generales_form['ESTADO_ACOMPA']==1): ?>
                    <div class="row mb-4 mx-4 px-2">
                        <h6>Datos de Acompañante</h6>
                        <?php
            foreach ( $campos as $elemento ) {
                if ( $elemento[ 'TIPO' ] == 'ACOMPA' ):
                    if ( $elemento[ 'ESTADO' ] == 0 ):
                        ?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No'>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php else:?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No' checked>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php
            endif;
            endif;
            }
            ?>
                    </div>
                    <?php endif;?>
                    <?php if($generales_form['ESTADO_FACTURA']==1): ?>
                    <div class="row mb-4 mx-4 px-2">
                        <h6>Datos de Facturación</h6>
                        <?php
            foreach ( $campos as $elemento ) {
                if ( $elemento[ 'TIPO' ] == 'FACT' ):
                    if ( $elemento[ 'ESTADO' ] == 0 ):
                        ?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No'>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php else:?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No' checked>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php
            endif;
            endif;
            }
            ?>
                    </div>
                    <?php endif;?>
                    <div class="row mb-4 mx-4 px-2">
                        <h6>Secretaría Técnica</h6>
                        <?php
            foreach ( $campos as $elemento ) {
                if ( $elemento[ 'TIPO' ] == 'INTERNO'
                    and $elemento[ 'CAMPO' ] != "ACOMPA"
                    and $elemento[ 'CAMPO' ] != "PAGO"
                    and $elemento[ 'CAMPO' ] != "IMPORT"
                    and $elemento[ 'CAMPO' ] != "VISIBILIDAD"
                    and $elemento[ 'CAMPO' ] != "CATEGORIA" ):
                    if ( $elemento[ 'ESTADO' ] == 0 ):
                        ?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No'>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php else:?>
                        <div class="col-6 px-3 py-2 d-flex bloque_campos">
                            <div class="bg-light shadow-sm container_masivo d-flex"
                                style="cursor: pointer;width: 80%;border-top-left-radius: 30px;border-bottom-left-radius: 30px;font-size: 11px;">
                                <div class="form-check form-switch ps-5 pt-1">
                                    <input class="form-check-input mt-1" type="checkbox"
                                        name="<?php echo $elemento['ID']?>" val='No' checked>
                                    <p hidden><?php echo $elemento['ID']?></p>
                                    <span class="form-check-label mt-1"
                                        style='font-size: 11px;color: #575757;font-weight: 700'> </span><span
                                        style='font-size: 11px;'><?php echo $elemento['PLACEHOLDER']?>
                                </div>
                            </div>
                            <?php if($elemento['PRIORIDAD']==""):?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php else: ?>
                            <div class="form-check form-switch my-0 ms-auto d-flex ps-0 requerido"
                                style="font-size: 11px;z-index:99999999">
                                <button type="button" class="btn btn-sm btn-outline-secondary m-0 btn-sm active"
                                    style=" width:90px;border-top-right-radius: 30px;border-bottom-right-radius: 30px;font-size: 11px;">Obligatorio</button>
                            </div>
                            <?php endif?>
                        </div>
                        <?php
            endif;
            endif;
            }
            ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_campos_formulario'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white"><span
                        class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                        style="display: none;"></span> Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!----CREAR Y ACTUALIZAR CAMPOS---->

<div class="modal fade" id="crear_campos" tabindex="-1" aria-labelledby="crear_camposLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crear_camposLabel">Configuración de campos</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="campo_create">
                    <div class="row mb-4 mx-4 px-2">
                        <div class="p-4">
                            <h4>Campos</h4>
                            <p class="mb-0">Si desea editar un campo exitente selecciónelo en el apartado <strong>Campos
                                    Existentes</strong>, si de lo contrario desea crear un campo nuevo, mantenga el
                                apartado <strong>Campos Existentes</strong> intacto.</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Campos Existentes </span></p>
                            <select name="campo_existen" class="form-control border required ">
                                <option value='0'>Elija el campo que desea editar</option>
                                <optgroup label="Datos Personales" class="border"></optgroup>
                                <?php
                foreach ( $campos as $elemento ):
                    if ( $elemento[ 'CAMPO' ] != "IMPORT"
                        and $elemento[ 'CAMPO' ] != "ACOMPA"
                        and $elemento[ 'CAMPO' ] != "HABITACION"
                        and $elemento[ 'CAMPO' ] != "F_ENTRADA"
                        and $elemento[ 'CAMPO' ] != "F_SALIDA"
                        and $elemento[ 'CAMPO' ] != "NOCHES"
                        and $elemento[ 'CAMPO' ] != "CATEGORIA"
                        and $elemento[ 'CAMPO' ] != "PAGO"
                        and $elemento[ 'CAMPO' ] != "ID"
                        and $elemento[ 'CAMPO' ] != "PAIS"
                        and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ):
                        if ( $elemento[ 'TIPO' ] == "USUARIO" ):
                            ?>
                                <option value='<?php echo $elemento['ID']?>'><?php echo  $elemento['PLACEHOLDER']?>
                                </option>
                                <?php endif; endif;endforeach;?>
                                <optgroup label="Acompañante"></optgroup>
                                <?php
                foreach ( $campos as $elemento ):
                    if ( $elemento[ 'CAMPO' ] != "IMPORT"
                        and $elemento[ 'CAMPO' ] != "ACOMPA"
                        and $elemento[ 'CAMPO' ] != "HABITACION"
                        and $elemento[ 'CAMPO' ] != "F_ENTRADA"
                        and $elemento[ 'CAMPO' ] != "F_SALIDA"
                        and $elemento[ 'CAMPO' ] != "NOCHES"
                        and $elemento[ 'CAMPO' ] != "CATEGORIA"
                        and $elemento[ 'CAMPO' ] != "PAGO"
                        and $elemento[ 'CAMPO' ] != "ID"
                        and $elemento[ 'CAMPO' ] != "PAIS"
                        and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ):
                        if ( $elemento[ 'TIPO' ] == "ACOMPA" ):
                            ?>
                                <option value='<?php echo $elemento['ID']?>'><?php echo $elemento['PLACEHOLDER']?>
                                </option>
                                <?php endif; endif;endforeach;?>
                                <optgroup label="Datos de Facturación"></optgroup>
                                <?php
                foreach ( $campos as $elemento ):
                    if ( $elemento[ 'CAMPO' ] != "IMPORT"
                        and $elemento[ 'CAMPO' ] != "ACOMPA"
                        and $elemento[ 'CAMPO' ] != "HABITACION"
                        and $elemento[ 'CAMPO' ] != "F_ENTRADA"
                        and $elemento[ 'CAMPO' ] != "F_SALIDA"
                        and $elemento[ 'CAMPO' ] != "NOCHES"
                        and $elemento[ 'CAMPO' ] != "CATEGORIA"
                        and $elemento[ 'CAMPO' ] != "PAGO"
                        and $elemento[ 'CAMPO' ] != "ID"
                        and $elemento[ 'CAMPO' ] != "PAIS"
                        and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ):
                        if ( $elemento[ 'TIPO' ] == "FACT" ):
                            ?>
                                <option value='<?php echo $elemento['ID']?>'><?php echo  $elemento['PLACEHOLDER']?>
                                </option>
                                <?php endif; endif;endforeach;?>
                                <optgroup label="Datos Profesionales"></optgroup>
                                <?php
                foreach ( $campos as $elemento ):
                    if ( $elemento[ 'CAMPO' ] != "IMPORT"
                        and $elemento[ 'CAMPO' ] != "ACOMPA"
                        and $elemento[ 'CAMPO' ] != "HABITACION"
                        and $elemento[ 'CAMPO' ] != "F_ENTRADA"
                        and $elemento[ 'CAMPO' ] != "F_SALIDA"
                        and $elemento[ 'CAMPO' ] != "NOCHES"
                        and $elemento[ 'CAMPO' ] != "CATEGORIA"
                        and $elemento[ 'CAMPO' ] != "PAGO"
                        and $elemento[ 'CAMPO' ] != "ID"
                        and $elemento[ 'CAMPO' ] != "PAIS"
                        and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ):
                        if ( $elemento[ 'TIPO' ] == "PROF" ):

                            ?>
                                <option value='<?php echo $elemento['ID']?>'><?php echo  $elemento['PLACEHOLDER']?>
                                </option>
                                <?php endif; endif;endforeach;?>
                                <optgroup label="Secreataría Técnica"></optgroup>
                                <?php
                foreach ( $campos as $elemento ):
                    if ( $elemento[ 'CAMPO' ] != "IMPORT"
                        and $elemento[ 'CAMPO' ] != "ACOMPA"
                        and $elemento[ 'CAMPO' ] != "HABITACION"
                        and $elemento[ 'CAMPO' ] != "F_ENTRADA"
                        and $elemento[ 'CAMPO' ] != "F_SALIDA"
                        and $elemento[ 'CAMPO' ] != "NOCHES"
                        and $elemento[ 'CAMPO' ] != "CATEGORIA"
                        and $elemento[ 'CAMPO' ] != "PAGO"
                        and $elemento[ 'CAMPO' ] != "ID"
                        and $elemento[ 'CAMPO' ] != "PAIS"
                        and $elemento[ 'CAMPO' ] != "TIPO_CENTRO" ):
                        if ( $elemento[ 'TIPO' ] == "INTERNO" ):
                            ?>
                                <option value='<?php echo $elemento['ID']?>'><?php echo  $elemento['PLACEHOLDER']?>
                                </option>
                                <?php endif; endif;endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Nombre del Campo</span></p>
                            <input name="campo_name" style="text-transform:uppercase;"
                                class="form-control border required " type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"><span class="dtr-form-subtext">Placeholder</span></p>
                            <input name="campo_placeholder" style="text-transform:capitalize;"
                                class="form-control border required" type="text" step="any">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Tipo de campo</span></p>
                            <select name="campo_tipo" class="form-control border required " type="text">
                                <option value='USUARIO' selected>Campo de datos Personales</option>
                                <option value='PROF'>Campo de datos Profesionales</option>
                                <option value='FACT'>Campo de datos Facturación</option>
                                <option value='ACOMPA'>Campo de Acompañante</option>
                                <option value='INTERNO'>Campo Interno</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_create_campo'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<!----CREAR CUOTAS---->

<div class="modal fade" id="crear_cuotas" tabindex="-1" aria-labelledby="crear_cuotasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crear_cuotasLabel">Crear Cuotas</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cuota_create_form">
                    <div class="row mb-4 mx-4 px-2">
                        <div class="py-4">
                            <h4>Gestión de cuotas</h4>
                            <p class="mb-0">Debe introducir los datos de la habitación que desea ingresar en el sistema.
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Nombre de la cuota</span></p>
                            <input name="cuota_name" class="form-control border required text" type="text">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Precio</span></p>
                            <input name="cuota_precio" class="form-control border required text" type="number"
                                step="any">
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"><span class="dtr-form-subtext">Público destino</span></p>
                            <select name="cuota_tipo" class="form-control border required text" type="text">
                                <option value='0'>Elija usuario destino</option>
                                <option value='ASISTENTE'>Asistentes</option>
                                <option value='ACOMPA'>Acompañantes</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Visibilidad</span></p>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="visibilidad_cuota"
                                    name="visibilidad_cuota" checked>
                                <label class="form-check-label" for="visibilidad_cuota">Hacer visible a los
                                    usuarios</label>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="py-4">
                                <h4>Cuotas Creadas</h4>
                                <p class="mb-0">Estas son las cuotas del público objetivo del evento. </p>
                            </div>
                            <div class="row w-100">
                                <?php
                foreach ( $cuotas as $elemento ):
                
                        ?>
                                <div class="col-4 my-3">
                                    <ul class="list-group shadow-sm" style="border-radius: 20px">
                                        <li class="list-group-item active" aria-current="true"
                                            style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                            <?php echo $elemento['NAME'] ?></li>
                                        <li class="list-group-item border-bottom p-2 bg-none"><strong>Tipo de
                                                Cuota:</strong> <?php echo $elemento['TIPO'] ?></li>
                                        <li class="list-group-item border-bottom p-2 bg-none"><strong>Precio:</strong>
                                            <?php echo $elemento['PRECIO'] ?>€</li>
                                        <li class="list-group-item p-2 bg-none"
                                            style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
                                            <div class="d-flex px-4">
                                                <p hidden><?php echo $elemento['ID'] ?></p>
                                                <p class="text-warning opt  lista_cuota me-auto">Editar</p>
                                                <p hidden><?php echo $elemento['ID'] ?></p>
                                                <p class="text-danger delete_cuota_card opt ms-auto">Eliminar</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php  endforeach; ?>
                            </div>
                        </div>
                        <?php if($generales_all['ESTADO_ACOMPA']==1): ?>
                        <div class="col-12">
                            <div class="py-4">
                                <h4>Cuotas de Acompañantes</h4>
                                <p class="mb-0">Cuotas de los acompañantes de los asistentes al evento. </p>
                            </div>
                            <div class="row w-100">
                                <?php
                foreach ( $cuotas as $elemento ):
                    if ( $elemento[ 'TIPO' ] == "ACOMPA" ):
                        ?>
                                <div class="col-4  my-3">
                                    <ul class="list-group shadow-sm" style="border-radius: 20px">
                                        <li class="list-group-item active" aria-current="true"
                                            style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                            <?php echo $elemento['NAME'] ?></li>
                                        <li class="list-group-item border-bottom p-2 bg-none"><strong>Tipo de
                                                Cuota:</strong> <?php echo $elemento['TIPO'] ?></li>
                                        <li class="list-group-item border-bottom p-2 bg-none"><strong>Precio:</strong>
                                            <?php echo $elemento['PRECIO'] ?>€</li>
                                        <li class="list-group-item p-2 bg-none"
                                            style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
                                            <div class="d-flex px-4">
                                                <p hidden><?php echo $elemento['ID'] ?></p>
                                                <p class="text-warning opt  lista_cuota me-auto">Editar</p>
                                                <p hidden><?php echo $elemento['ID'] ?></p>
                                                <p class="text-danger delete_cuota_card opt ms-auto">Eliminar</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_cuota_create'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>




            </div>
        </div>
    </div>
</div>

<!----CREAR CUOTAS---->

<div class="modal fade" id="metodo_pago" tabindex="-1" aria-labelledby="metodo_pagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metodo_pagoLabel">Gestión de métodos de pago</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="datos_metodo_pago">
                    <div class="row mb-4 mx-4 px-2">
                        <div class="py-4">
                            <h4>Métodos de pago</h4>
                            <p class="mb-0">Para editar el contenido de cada método de pago primero debe activarlo</p>
                        </div>
                        <div class="col-12 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_pago" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="transferencia"
                                        val='No'>
                                    <span class="form-check-label">Pago por transferencia</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-3" style='display: none'>
                            <div class="row p-4 ">
                                <div class="col-md-6 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">Titular de la cuenta</span>
                                    </p>
                                    <input name="titular_cuenta" class="form-control border required text" type="text">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">Entidad Bancaria</span></p>
                                    <input name="entidad_bancaria" class="form-control border required text"
                                        type="text">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">IBAM</span></p>
                                    <input name="ibam_cuenta" class="form-control border required text" type="text">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">Código Swift</span></p>
                                    <input name="swift_cuenta" class="form-control border required text" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_pago" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="tarjeta_veci"
                                        val='No'>
                                    <span class="form-check-label">Pago por Tarjeta ECI</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style='display: none'></div>
                        <div class="col-12 p-3">
                            <div class="bg-light rounded-pill p-3 shadow-sm container_pago" style="cursor: pointer">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" type="checkbox" role="switch" name="tarjeta"
                                        val='No'>
                                    <span class="form-check-label">Pago por Tarjeta Bancaria (Redsys)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-3" style='display: none'>
                            <div class="row p-4">
                                <h2 class="col-md-12 m-0">Aviso</h2>
                                <p>Debe introducir las claves del <strong>modo producción</strong> no del modo prueba.
                                </p>
                                <div class="col-md-4 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">Clave de comercio</span></p>
                                    <input name="clave_comercio" class="form-control border required text" type="text">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <p class="form-label"> <span class="dtr-form-subtext">Key Privada</span></p>
                                    <input name="key_privada" class="form-control border required text" type="password"
                                        disabled>
                                    <button class="btn btn-outline-secondary rounded-pill btn-sm mt-3" id="mostrar_key"
                                        style="button">Mostrar</button>
                                    <button class=" ms-3 btn btn-outline-secondary rounded-pill btn-sm mt-3"
                                        id="editar_key" style="button">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_cuentas'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<!----CREAR CODIGOS---->

<div class="modal fade" id="codigo" tabindex="-1" aria-labelledby="codigoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="codigoLabel">Crear códigos</h5>
                <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="datos_codigo">
                    <div class="row mb-4 mx-4 px-2">
                        <div class="py-4">
                            <h4>Códigos de inscripción</h4>
                            <p class="mb-0">Para editar el contenido de cada método de pago primero debe activarlo</p>
                        </div>

                        <div class="col-md-8 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Código</span></p>
                            <input name="codigo" class="form-control border required text" type="text">
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="form-label"> <span class="dtr-form-subtext">Cupos</span></p>
                            <input name="cupos" class="form-control border required text" type="number">
                        </div>

                        <?php
                        foreach($codes as $elemento):?>
                        <div class="col-4 my-3">
                            <ul class="list-group shadow-sm" style="border-radius: 20px">
                                <li class="list-group-item active" aria-current="true"
                                    style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                    <?php echo $elemento['CODE'] ?></li>
                                <li class="list-group-item border-bottom p-2 bg-none"><strong>Cupos:</strong>
                                    <?php echo $elemento['CUPOS'] ?></li>
                                <li class="list-group-item p-2 bg-none"
                                    style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
                                    <div class="d-flex px-4">
                                        <p hidden><?php echo $elemento['ID'] ?></p>
                                        <p class="text-warning opt lista_codigo me-auto">Editar</p>
                                        <p hidden><?php echo $elemento['ID'] ?></p>
                                        <p class="text-danger delete_codigo_card opt ms-auto">Eliminar</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php  endforeach;
                        ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto rounded-pill" data-bs-dismiss="modal">
                    Volver</button>
                <button type="button" class="btn rounded-pill px-4 shadow-sm" id='send_codigos'
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);border: 2px solid white">
                    Guardar cambios</button>
            </div>
        </div>
    </div>
</div>