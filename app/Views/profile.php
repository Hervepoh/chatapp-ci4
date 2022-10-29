<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?= $user['firstname'].' '.$user['lastname'] ?></h3>
                <hr>
                <?php if (session()->get('success')) : ?>
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="" action="<?= url_to('profile') ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="firstname">Firstname</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname',$user['firstname']) ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="lastname">Lastname</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname',$user['lastname']) ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input type="text" class="form-control" disabled readonly id="email" value="<?= $user['email'] ?>"   placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="password_confirm">Password confirmation</label>
                                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="">
                            </div>
                        </div>

                        <?php if (isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>