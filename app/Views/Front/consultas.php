
<!DOCTYPE html>
<html>
  <head>
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/body.css" rel = "stylesheet">
    <link href="assets/CSS/carrusel.css" rel = "stylesheet">
    <link href="assets/CSS/card.css" rel = "stylesheet">
    <link href="assets/CSS/consultas.css" rel = "stylesheet">
    </head>


   
    <body>
<div class="container mt-5 mb-5 d-flex flex-column align-items-center" style="background-color: #c5ac8e;; width: 100%">

  <div class="center-form"> <!-- Alinea el contenido en el centro -->
  <div class="w-50"> <!-- Ajusta el ancho del formulario -->
    <h4 class="mb-4 text-center">CONSULTAS</h4>
    <form class="needs-validation" novalidate>
      <div class="row g-3"> <!-- Ajusta el espaciado entre filas -->
        <div class="col-12 col-md-6"> <!-- Ajusta el tamaño de columnas -->
          <label for="firstName" class="form-label">*Nombre</label>
          <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
          <div class="invalid-feedback">Valid first name is required.</div>
        </div>

        <div class="col-12 col-md-6">
          <label for="lastName" class="form-label">*Apellido</label>
          <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
          <div class="invalid-feedback">Valid last name is required.</div>
        </div>

        <div class="col-12">
          <label for="email" class="form-label">*Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">Valid email is required.</div>
        </div>

        <div class="col-12 col-md-6">
          <label for="address" class="form-label">Ciudad</label>
          <input type="text" class="form-control" id="address" placeholder="Cordoba" required>
          <div class="invalid-feedback">Please enter your city.</div>
        </div>

        <div class="col-12 col-md-6">
          <label for="country" class="form-label">*País</label>
          <select class="form-select" id="country" required>
            <option value="">Choose...</option>
            <option>United States</option>
            <option>Argentina</option>
            <option>Brasil</option>
            <option>Chile</option>
            <option>Paraguay</option>
            <option>Uruguay</option>
          </select>
          <div class="invalid-feedback">Please select a valid country.</div>
        </div>

        <div class="col-12">
          <label for="exampleFormControlTextarea1" class="form-label">Comentario</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>
      <button type="submit" class="w-100 btn btn-primary mt-3">Enviar</button>
    </form>
  </div>
 </div>
</div>       
<script rel="stylesheet" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>