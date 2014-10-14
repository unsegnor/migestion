'use strict';

/* Controllers */

angular.module('migestion.controllers', [])
        .controller('controladorplantilla', ['$scope', '$http', function($scope, $http) {
                //Comprobar si el usuario tiene sesión y redirigir a login
                checkLogin($http, nop, function() {
                    redirect("login.php");
                });

                setMenu([
                    {'nombre': 'Anterior', 'enlace': '#'}
                    , {'nombre': 'Plantilla', 'enlace': '#'}
                ]);
            }])
        .controller('controladorindex', ['$scope', '$http', function($scope, $http) {
                redirect("principal.php");
            }])
        .controller('controladorprincipal', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': '#'}
                ]);
            }])
        .controller('controladorclientes', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Clientes', 'enlace': '#'}
                ]);

                //Cargamos los clientes
                allamar($http, 'getClientes', null, function(res) {
                    $scope.clientes = res.resultado;
                });
            }])
        .controller('controladorpresupuestos', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Presupuestos', 'enlace': '#'}
                ]);
            }])
        .controller('controladorfacturas', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Facturas', 'enlace': '#'}
                ]);

                //Cargamos las facturas
                allamar($http, 'getInfoFacturas', null, function(res) {
                    $scope.facturas = res.resultado;
                });
            }])
        .controller('controladorcontratos', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Contratos', 'enlace': '#'}
                ]);
            }])
        .controller('controladornuevafactura', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Facturas', 'enlace': 'facturas.php'}
                    , {'nombre': 'Nueva', 'enlace': '#'}
                ]);

                //Cargamos los clientes
                allamar($http, 'getClientes', null, function(res) {
                    $scope.clientes = res.resultado;
                });

                $scope.guardarFactura = function() {
                    allamar($http, 'addFactura', [$scope.factura], function(res) {
                        //Recuperamos el id del nuevo cliente
                        var id = res.resultado;
                        redirect('detallefactura.php?id=' + id);
                    });
                };

            }])
        .controller('controladornuevocliente', ['$scope', '$http', function($scope, $http) {
                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Clientes', 'enlace': 'clientes.php'}
                    , {'nombre': 'Nuevo', 'enlace': '#'}
                ]);

                $scope.guardarCliente = function() {
                    allamar($http, 'addCliente', [$scope.nuevocliente], function(res) {
                        //Recuperamos el id del nuevo cliente
                        var id = res.resultado;
                        redirect('detallecliente.php?id=' + id);
                    });
                };
            }])
        .controller('controladordetallefactura', ['$scope', '$http', function($scope, $http) {

                setMenu([
                    {'nombre': 'Principal', 'enlace': 'principal.php'}
                    , {'nombre': 'Facturas', 'enlace': 'facturas.php'}
                    , {'nombre': 'Detalle', 'enlace': '#'}
                ]);

                $scope.cargaServicios = function(id) {

                    allamar($http, 'getServiciosFactura', [id], function(res) {
                        alert(JSON.stringify(res));
                        $scope.servicios = res.resultado;
                        //Convertir números y fechas
                        for(var i=0; i<$scope.servicios.length; i++){
                            $scope.servicios[i].base_imponible = parseInt($scope.servicios[i].base_imponible);
                            $scope.servicios[i].tipo_impositivo = parseInt($scope.servicios[i].tipo_impositivo);
                            
                        }
                    });

                };

                $scope.cargaFactura = function(id) {
                    allamar($http, 'getInfoFactura', [id], function(res) {
                        //alert(JSON.stringify(res));
                        $scope.factura = res.resultado;
                    });
                };

                $scope.cargaClientes = function() {
                    //Cargamos los clientes
                    allamar($http, 'getClientes', null, function(res) {
                        //alert(JSON.stringify(res));
                        $scope.clientes = res.resultado;
                    });
                };

                $scope.init = function(id) {
                    $scope.id = id;

                    $scope.cargaClientes();
                    $scope.cargaFactura(id);
                    $scope.cargaServicios(id);
                };

                $scope.addServicio = function() {
                    allamar($http, 'addServicioFactura', [$scope.id, $scope.nuevoservicio], function(res) {
                        $scope.cargaServicios($scope.id);
                    });
                };
            }])
        ;

function pruebafuncion() {
    alert("Prueba");
}