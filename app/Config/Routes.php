<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('DK', 'Home::index');
$routes->get('Productos', 'Producto_Controller::index');
$routes->get('Comercializacion', 'Home::Comercializacion');
$routes->get('quienessomos', 'Home::quienessomos');
$routes->get('consultas', 'Home::consultas');
$routes->get('terminosycondiciones', 'Home::terminosycondiciones');
$routes->get('FAQs', 'Home::FAQs');
$routes->get('Login', 'Home::Login');

/*rutas del login*/
$routes->get('Login', 'login_controller');
$routes->post('enviarlogin', 'login_controller::auth');
$routes->get('inicio', 'Home::index');
$routes->get('Logout', 'login_controller::logout');	

/*rutas Adm*/
$routes->get('admin', 'Admin_controller::admin_view',['filter' => 'auth']);	
$routes->get('lista_usuario', 'Admin_controller::user_list',['filter' => 'auth']);	
$routes->get('modificar_usuario', 'User_modify_controller::user_modify',['filter' => 'register']);	
$routes->get('modify_user_post', 'User_modify_controller::modify_validacion',['filter' => 'register']);

/*rutas del Registro de Usuarios*/
$routes->post('/Crear','usuario_controller::formValidation');
$routes->get('/Registrar','usuario_controller::formValidation');
$routes->get('/Usuario', 'usuarioController::crud');
$routes->get('login', 'Login_controller::index');


/* rutas producto */
$routes->get('Crud_Producto', 'Producto_controller::crud', ['filter' => 'auth']);
$routes->get('/crear', 'Producto_controller::index', ['filter' => 'auth']);
$routes->get('/agregar', 'Producto_controller::index', ['filter' => 'auth']);
$routes->get('/produ-form', 'Producto_cntroller::Producto_nuevo', ['filter' => 'auth']);


$routes->get('Crud_Usuario', 'usuario_controller::index');
$routes->post('enviar-user', 'usuario_controller::actualizarDatos');
$routes->get('editUsuario/(:num)', 'usuario_controller::editar/$1');
$routes->get('borrarUsuario/(:num)', 'usuario_controller::borrar/$1'); // Dar de baja
$routes->get('darAltaUsuario/(:num)', 'usuario_controller::alta/$1'); //Dar de alta

$routes->post('/enviar-prod', 'Producto_controller::cargarNuevoProducto', ['filter' => 'auth']); // Agregar un producto
$routes->get('borrarProducto/(:num)', 'Producto_controller::borrarProducto/$1'); // Dar de baja
$routes->get('darAltaProducto/(:num)', 'Producto_controller::darAltaProducto/$1'); //Dar de alta
$routes->post('/enviar-cat', 'Producto_controller::agregarCategoria'); //  Agrega una categoria
$routes->get('editarProd/(:num)', 'Producto_controller::editar/$1');    // Editar un producto la vista
$routes->post('/editar-prod', 'Producto_controller::actualizarProducto');   //Editar un producto envio de formulario


$routes->get('/editar/(:num)', 'Producto_controller::singleproducto/$1', ['filter' => 'auth']);
$routes->get('/modifica/(:num)', 'Producto_controller::modifica/$1', ['filter' => 'auth']);
$routes->get('/borrar', 'Producto_controller::deleteproducto/$1');
$routes->get('/eliminados', 'Producto_controller::eliminados', ['filter' => 'auth']);
$routes->get('/activar_pro/(:num)', 'Producto_controller::activarproducto/$1', ['filter' => 'auth']);

/* Filtros */
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// --- Carrito_controller ---
$routes->get('/todos_p', 'Carrito_controller::Productos', ['filter' => 'auth']); // (si existe ese método)
$routes->get('/muestro', 'Carrito_controller::muestra', ['filter' => 'auth']);
$routes->get('/carrito', 'Carrito_controller::muestra', ['filter' => 'auth']); // para compatibilidad
$routes->post('/carrito_agrega', 'Carrito_controller::add', ['filter' => 'auth']);
$routes->get('/carrito_eliminar/(:any)', 'Carrito_controller::remove/$1', ['filter' => 'auth']);
$routes->post('/carrito_actualiza', 'Carrito_controller::borrarCarrito', ['filter' => 'auth']);
$routes->get('/borrar', 'Carrito_controller::borrarCarrito', ['filter' => 'auth']);
$routes->get('carrito/sumar/(:any)', 'Carrito_controller::sumar/$1');
$routes->get('carrito/restar/(:any)', 'Carrito_controller::restar/$1');
$routes->post('/carrito-comprar', 'Ventascontroller::registrar_venta',['filter' => 'auth']);
$routes->get('Carrito', 'Carrito_controller::muestra');
$routes->get('Carrito', 'Carrito_controller::');

$routes->post('carrito/comprar', 'Carrito_controller::comprar');



/* Crud */
$routes->get('usuario/crud', 'UsuarioController::Usuario_Crud');

/* Consultas */
$routes->get('consultas', 'Consulta_Controller::index');
$routes->post('guardar-consultas', 'Consulta_Controller::guardar');
$routes->get('listar-consultas', 'Consulta_Controller::listar');
$routes->get('Consultas/listar', 'Consulta_Controller::listar');
$routes->get('Consultas/atender_consulta/(:num)', 'Consulta_Controller::atender_consulta/$1');
$routes->get('Consultas/eliminar_consulta/(:num)', 'Consulta_Controller::eliminar_consulta/$1');




/* ventas */
$routes->get('ventas/carrito', 'Ventas::carrito');
$routes->post('ventas/actualizar', 'Ventas::actualizar_carrito');
$routes->get('ventas/eliminar/(:segment)', 'Ventas::eliminar_producto/$1');
$routes->get('ventas/borrar', 'Ventas::borrar_carrito');
$routes->post('ventas/procesar', 'Ventas::procesar_compra');
$routes->get('ventas', 'Ventascontroller::mostrar', ['filter' => 'auth']);
$routes->post('ventas/borrarDetalle/(:num)', 'Ventascontroller::borrarDetalle/$1');
$routes->get('Ventas/Mostrar_Ventas', 'Ventascontroller::mostrar');
$routes->post('ventas/reiniciarStock', 'Ventascontroller::reiniciarStock');
//$routes->get('post-venta/(:num)', 'Ventascontroller::resumen/$1');
$routes->get('Ventas/factura/(:num)', 'Ventascontroller::factura/$1');
$routes->get('post-venta', 'Ventascontroller::ventasUsuario');
$routes->get('factura/(:num)', 'Ventascontroller::factura/$1');
$routes->get('post-venta', 'Ventascontroller::listado');





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

