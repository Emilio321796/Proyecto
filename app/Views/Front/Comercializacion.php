<!DOCTYPE html>
<html>
<head>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/CSS/comercializacion.css'); ?>">
    <link href="assets/CSS/end-nav.css" rel = "stylesheet">
    <link href="assets/bootstrap/js/bootstrap.bundle.min.js" rel = "stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<style>
    h2 {
      font-weight: bold;
      color: #dc3545;
    }
    .accordion-button {
      font-weight: 500;
      background-color: #f8f9fa;
    }
    .accordion-item {
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .payment-icons li {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #f8f9fa;
      border-radius: 8px;
      padding: 10px 15px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .payment-icons li:hover {
      transform: scale(1.05);
    }


  </style>
</head>

<div class="container my-5">

  <!-- Acordeón: Tipos de Entrega -->
  <div class="d-flex justify-content-center align-items-center mb-4 gap-3">
  <img src="assets/img/carrito-de-compras.png" alt="Entrega rápida" class="img-fluid" style="max-width: 45px;">
  <h2 class="mb-0 text-center">Tipos de Entrega</h2>
  <img src="assets/img/carrito-de-compras.png" alt="Entrega rápida" class="img-fluid" style="max-width: 45px;">
</div>

  <div class="accordion payment-accordion mb-5" id="entregaAccordion">

    <div class="accordion-item">
      <h2 class="accordion-header" id="entregaOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEntregaOne" aria-expanded="true" aria-controls="collapseEntregaOne">
          Entrega a Domicilio
        </button>
      </h2>
      <div id="collapseEntregaOne" class="accordion-collapse collapse show" aria-labelledby="entregaOne" data-bs-parent="#entregaAccordion">
        <div class="accordion-body">
          Los clientes pueden optar por recibir sus pedidos directamente en sus hogares o lugares de trabajo.
          <div class="text-center mt-3">
            
          </div>
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="entregaTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEntregaTwo" aria-expanded="false" aria-controls="collapseEntregaTwo">
          Recogida en Local
        </button>
      </h2>
      <div id="collapseEntregaTwo" class="accordion-collapse collapse" aria-labelledby="entregaTwo" data-bs-parent="#entregaAccordion">
        <div class="accordion-body">
          Los clientes tienen la opción de recoger sus pedidos en persona en uno de los locales de Sabores Express.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="entregaThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEntregaThree" aria-expanded="false" aria-controls="collapseEntregaThree">
          Entrega para Eventos Especiales
        </button>
      </h2>
      <div id="collapseEntregaThree" class="accordion-collapse collapse" aria-labelledby="entregaThree" data-bs-parent="#entregaAccordion">
        <div class="accordion-body">
          Sabores Express ofrece entregas para fiestas, reuniones corporativas o celebraciones familiares.
        </div>
      </div>
    </div>
  </div>

  <!-- Acordeón: Formas de Pago -->
  <h2 class="text-center mb-4">Formas de Pago</h2>
  <div class="accordion payment-accordion" id="pagoAccordion">

    <div class="accordion-item">
      <h2 class="accordion-header" id="pagoOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePagoOne" aria-expanded="true" aria-controls="collapsePagoOne">
          Pago en Efectivo
        </button>
      </h2>
      <div id="collapsePagoOne" class="accordion-collapse collapse show" aria-labelledby="pagoOne" data-bs-parent="#pagoAccordion">
        <div class="accordion-body">
          Puedes pagar en efectivo al momento de la entrega o al recoger el pedido en el local.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="pagoTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePagoTwo" aria-expanded="false" aria-controls="collapsePagoTwo">
          Pago con Tarjeta
        </button>
      </h2>
      <div id="collapsePagoTwo" class="accordion-collapse collapse" aria-labelledby="pagoTwo" data-bs-parent="#pagoAccordion">
        <div class="accordion-body">
          Aceptamos Mastercard y Visa, tanto en línea como en locales físicos.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="pagoThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePagoThree" aria-expanded="false" aria-controls="collapsePagoThree">
          Pago en Línea
        </button>
      </h2>
      <div id="collapsePagoThree" class="accordion-collapse collapse" aria-labelledby="pagoThree" data-bs-parent="#pagoAccordion">
        <div class="accordion-body">
          Realizá pagos seguros a través de PayPal, Stripe, Mercado Pago y otras plataformas confiables.
        </div>
      </div>
    </div>
  </div>



 <!-- Íconos de medios de pago -->
  <ul class="payment-icons list-unstyled d-flex flex-wrap justify-content-center gap-3 mt-4">
    <li><img src="assets/img/efectivo.jpg" alt="Efectivo" style="height: 40px;"> <span>Efectivo</span></li>
    <li><img src="assets/img/Mastercard.jpg" alt="Mastercard" style="height: 40px;"> <span>Mastercard</span></li>
    <li><img src="assets/img/visa.png" alt="Visa" style="height: 40px;"> <span>Visa</span></li>
    <li><img src="assets/img/Mp.jpg" alt="MercadoPago" style="height: 40px;"> <span>Mercado Pago</span></li>
    <li><img src="assets/img/PP.png" alt="PayPal" style="height: 40px;"> <span>PayPal</span></li>
  </ul>
<bk>
<bk>
<bk>
  <!-- Horarios -->
  <div class="attention-hours mt-5 text-center bg-light p-4 rounded shadow">
    <h2>Horarios de Atención</h2>
    <p class="fs-5"><strong>Lunes a Domingo:</strong> 11am a 01am Hs</p>
  </div>
</div>    


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>