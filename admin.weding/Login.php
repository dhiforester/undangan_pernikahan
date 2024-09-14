<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Partial/JsPlugin.php";
        ?>
    </head>
    <body>
        <main class="login_background">
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10 d-flex flex-column align-items-center justify-content-center">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 text-center mb-3">
                                                <img src="assets/img/login_ilustrate.avif" alt="" width="80%">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="pb-2">
                                                    <h5 class="card-title text-center pb-0 fs-4">
                                                        <a href="">Form Login</a>
                                                    </h5>
                                                    <p class="text-center small">Masukan Email Dan Password Untuk Melakukan Login</p>
                                                </div>
                                                <form action="javascript:void(0);" class="row g-3" id="ProsesLogin">
                                                    <div class="col-12">
                                                        <label for="email" class="form-label">Email</label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend">
                                                                <i class="bi bi-envelope"></i>
                                                            </span>
                                                            <input type="email" name="email" class="form-control" id="email" required>
                                                            <div class="invalid-feedback">Please enter your username.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="password" class="form-label">Password</label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key"></i></span>
                                                            <input type="password" name="password" class="form-control" id="password" required>
                                                            <div class="invalid-feedback">Please enter your password.</div>
                                                        </div>
                                                        <small class="credit">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword2" name="TampilkanPassword2">
                                                                <label class="form-check-label" for="TampilkanPassword2">
                                                                    Tampilkan Password
                                                                </label>
                                                            </div>
                                                        </small>
                                                    </div>
                                                    <div class="col-12">
                                                        Pastikan email dan password sudah benar.
                                                    </div>
                                                    <div class="col-12">
                                                        <small  id="NotifikasiLogin"></small>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-lg btn-primary w-100" type="submit">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        // include "_Partial/Copyright.php";
                    ?>
                </section>
            </div>
    </main>
        <?php
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            echo '<script type="text/javascript" src="_Page/Login/Login.js"></script>';
        ?>
        <script>
            //Kondisi saat tampilkan password
            $('#TampilkanPassword2').click(function(){
                if($(this).is(':checked')){
                    $('#password').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                }
            });
        </script>
    </body>

</html>