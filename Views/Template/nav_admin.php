    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombre'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <?php if (!empty($_SESSION['permisos'][1]['leer'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Inicio</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][2]['leer']) || !empty($_SESSION['permisos'][3]['leer'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][2]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][3]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][3]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Configuracion"><i class="icon fa fa-circle-o"></i> Configuración</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][4]['leer']) || !empty($_SESSION['permisos'][14]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-wrench" aria-hidden="true"></i>
                    <span class="app-menu__label">Empleados</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][4]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/empleado"><i class="icon fa fa-circle-o"></i> Empleados</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][14]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/cargos"><i class="icon fa fa-circle-o"></i> Cargos</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][4]['leer']) || !empty($_SESSION['permisos'][14]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-wrench" aria-hidden="true"></i>
                    <span class="app-menu__label">Activo Fijo</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][4]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/activofijo"><i class="icon fa fa-circle-o"></i> Activo Fijo</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][14]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/nuevoactivofijo"><i class="icon fa fa-circle-o"></i> Nuevo Activo Fijo</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][5]['leer']) || !empty($_SESSION['permisos'][10]['leer'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="app-menu__label">Compras</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][5]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/nuevacompra"><i class="icon fa fa-circle-o"></i> Nueva Compra</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/compras"><i class="icon fa fa-circle-o"></i> Gestionar Compras</a></li>
                <?php  } ?>
                <?php if (!empty($_SESSION['permisos'][10]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/proveedor"><i class="icon fa fa-circle-o"></i> Proveedores</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][5]['leer']) || !empty($_SESSION['permisos'][10]['leer'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="app-menu__label">Inventario</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][5]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/inventario"><i class="icon fa fa-circle-o"></i>Inventario</a></li>
                  
                <?php  } ?>

                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][7]['leer'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="app-menu__label">Ventas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][7]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Nuevaventa"><i class="icon fa fa-circle-o"></i> Nueva Venta</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Ventas"><i class="icon fa fa-circle-o"></i> Gestionar Ventas</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Ventas/Ventascontado"><i class="icon fa fa-circle-o"></i> Ventas al contado</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Creditos"><i class="icon fa fa-circle-o"></i> Ventas al créditos</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Creditos/creditosIncobrables"><i class="icon fa fa-circle-o"></i> Ventas incobrables</a></li>

                <?php  } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][8]['leer'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-wrench" aria-hidden="true"></i>
                    <span class="app-menu__label">Clientes</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][9]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Carteraclientes"><i class="icon fa fa-circle-o"></i> Cartera de Clientes</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][11]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Registrocliente"><i class="icon fa fa-circle-o"></i> Registrar Cliente</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][9]['leer']) || !empty($_SESSION['permisos'][11]['r']) || !empty($_SESSION['permisos'][12]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-wrench" aria-hidden="true"></i>
                    <span class="app-menu__label">Productos</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php if (!empty($_SESSION['permisos'][9]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa fa-circle-o"></i> Productos</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][11]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/marca"><i class="icon fa fa-circle-o"></i> Marcas</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][12]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/unidadmedida"><i class="icon fa fa-circle-o"></i> Unidad de Medida</a></li>
                <?php } ?>
                <?php if (!empty($_SESSION['permisos'][13]['leer'])) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/categoria"><i class="icon fa fa-circle-o"></i> Categoria</a></li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>
        
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar Sesion</span>
            </a>
        </li>
      </ul>
    </aside>