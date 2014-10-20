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
                        //alert(JSON.stringify(res));
                        $scope.servicios = res.resultado;
                        //Convertir números y fechas
                        for (var i = 0; i < $scope.servicios.length; i++) {
                            $scope.servicios[i].base_imponible = parseInt($scope.servicios[i].base_imponible);
                            $scope.servicios[i].tipo_impositivo = parseInt($scope.servicios[i].tipo_impositivo);
                            $scope.servicios[i].fecha_prestacion = f_bdd2html($scope.servicios[i].fecha_prestacion);
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

                $scope.emitirFactura = function() {

                    //Emitir PDF
var imgData = 'data:image/png;base64,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';
var doc = new jsPDF();

//doc.addImage(imgData, 'JPEG', 20, 20, 50, 17);


var margen_superior = 30;
var margen_izquierdo = 20;
//Título factura
doc.setTextColor(0,0,255);
doc.setFontSize(30);
doc.text(margen_izquierdo, margen_superior, 'FACTURA');

//Datos propios
doc.setTextColor(0,0,0);
doc.setFontSize(12);

var principio = 150;
doc.text(principio,margen_superior,'CALA T.I.');
doc.text(principio,margen_superior+5,'Calle Veleta 43');
doc.text(principio,margen_superior+10,'18015 Granada');
doc.text(principio,margen_superior+15,'CIF: 47661755M');

//Pintar rectángulo con contenido

var rx = 20;
var ry = 60;
var rw = 90;
var rh = 30;

doc.rect(rx, ry, rw, rh); // empty square

//Número de factura
doc.text(rx+5, ry+10, 'Número: 0000000000001');

//Fecha de emisión
doc.text(rx+5, ry+20, 'Fecha: 23-01-1987 15:00');




doc.output('dataurlnewwindow');


                };
            }])
        ;

function pruebafuncion() {
    alert("Prueba");
}