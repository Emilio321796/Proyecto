<!DOCTYPE html>
<html>
<head>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/comercializacion.css" rel="stylesheet">
    
    <link href="assets/CSS/carrusel.css" rel = "stylesheet">

    <link href="assets/CSS/consultas.css" rel = "stylesheet">
    <link href="assets/CSS/end-nav.css" rel = "stylesheet">
</head>

<body>
<div class="container mt-5 mb-5 d-flex flex-column align-items-center">
    
    <div class="delivery-container ">
        <div class="d-flex align-items-center justify-content-center my-3 gap-2">
            <h2>Tipos de Entregas</h2>
            <img src="assets/img/carrito-de-compras.png" alt="Icono derecha" style="height: 30px;">
        </div>

        <div class="accordion accordion-flush" id="deliveryAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseDelivery1" aria-expanded="false" aria-controls="collapseDelivery1">
                        Entrega a Domicilio
                    </button>
                </h2>
                <div id="collapseDelivery1" class="accordion-collapse collapse" data-bs-parent="#deliveryAccordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            Los clientes pueden optar por recibir sus pedidos directamente en sus hogares o lugares de trabajo.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseDelivery2" aria-expanded="false" aria-controls="collapseDelivery2">
                        Recogida en Local
                    </button>
                </h2>
                <div id="collapseDelivery2" class="accordion-collapse collapse" data-bs-parent="#deliveryAccordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            Los clientes tienen la opción de recoger sus pedidos en persona en uno de los locales de Sabores Express.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseDelivery3" aria-expanded="false" aria-controls="collapseDelivery3">
                        Eventos Especiales
                    </button>
                </h2>
                <div id="collapseDelivery3" class="accordion-collapse collapse" data-bs-parent="#deliveryAccordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            DK ofrece servicios de entrega para eventos especiales como fiestas, reuniones corporativas o celebraciones familiares.
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        </div> 
</div> 

<!-- Modal -->
<div class="modal fade" id="paymentMethodsModal" tabindex="-1" aria-labelledby="paymentMethodsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #f5e0c7;"> <!-- Color de fondo personalizado -->
      <div class="modal-header">
        <h5 class="modal-title" id="paymentMethodsLabel">Formas de Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="payment-methods-container text-center">
          <ul class="list-unstyled d-flex flex-wrap align-items-center justify-content-center gap-3">
            <li class="d-flex flex-column align-items-center">
              <img src="assets/img/efectivo.jpg" alt="Efectivo" style="height: 40px;">
              <span>Efectivo</span>
            </li>
            <li class="d-flex flex-column align-items-center">
              <img src="assets/img/Mastercard.jpg" alt="Mastercard" style="height: 40px;">
              <span>Tarjeta de Crédito/Débito</span>
            </li>
            <li class="d-flex flex-column align-items-center">
              <img src="assets/img/visa.png" alt="Visa" style="height: 40px;">
              <span>Tarjeta de Crédito/Débito</span>
            </li>
            <li class="d-flex flex-column align-items-center">
              <img src="assets/img/Mp.jpg" alt="MercadoPago" style="height: 40px;">
              <span>Mercado Pago</span>
            </li>
            <li class="d-flex flex-column align-items-center">
              <img src="assets/img/PP.png" alt="PayPal" style="height: 40px;">
              <span>PayPal</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


     <div class="attention-hours mt-4">
        <h1>Horarios de Atención</h1>
        <ul>
            <li><strong>Lunes a Domingo:</strong> 11am a 01am Hs.</li>
        </ul>
    </div>
    


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>