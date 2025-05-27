<section class="container my-5">
    <?php if (session()->getFlashdata('alertaExitosa')): ?>
        <div class="alert alert-success text-center col-lg-6 mx-auto" role="alert">
            <?= session()->getFlashdata('alertaExitosa') ?>
        </div>
    <?php endif; ?>

    <?php $validation = \Config\Services::validation(); ?>
    <?php if (isset($usuario)) : ?>
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 700px;">
            <h4 class="text-center mb-4">Editar Usuario</h4>

            <form action="<?= base_url('enviar-user') ?>" method="post" novalidate>
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control <?= $validation->getError('nombre') ? 'is-invalid' : '' ?>" id="Nombre" name="Nombre" value="<?= esc($usuario['Nombre']) ?>" placeholder="Ingrese el nombre">
                        <?php if ($validation->getError('nombre')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nombre') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="Apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control <?= $validation->getError('apellido') ? 'is-invalid' : '' ?>" id="Apellido" name="Apellido" value="<?= esc($usuario['Apellido']) ?>" placeholder="Ingrese el apellido">
                        <?php if ($validation->getError('apellido')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('apellido') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="Usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control <?= $validation->getError('usuario') ? 'is-invalid' : '' ?>" id="Usuario" name="Usuario" value="<?= esc($usuario['Usuario']) ?>" placeholder="Ingrese usuario">
                        <?php if ($validation->getError('usuario')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('usuario') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= $validation->getError('email') ? 'is-invalid' : '' ?>" id="Email" name="Email" value="<?= esc($usuario['Email']) ?>" placeholder="correo@ejemplo.com">
                        <?php if ($validation->getError('email')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('email') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= esc($usuario['id_usuario']) ?>">

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5">Guardar Cambios</button>
                    </div>

                </div>
            </form>
        </div>
    <?php endif; ?>
</section>
