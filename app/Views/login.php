<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Login</h3>
                <hr>
                <?php if (session()->get('success')) : ?>
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="" action="<?= url_to('login') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="">
                    </div>
                    
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row mt-3">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="col-12 col-sm-8 text-end">
                            <a href="<?= url_to('register') ?>">Don't have an account yer?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>