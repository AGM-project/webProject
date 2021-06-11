<!DOCTYPE html>
<html lang="en">

<?php include("include/head.php");?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/logo-bw.png" alt="logo">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="process/proses_registrasi.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="" name="nama" placeholder="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="L" class="form-check-input" required>
                                                &nbsp;Laki-laki
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="P" class="form-check-input">
                                                &nbsp;Perempuan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir <small>(tgl/bln/thn)</small></label>
                                    <div class="input-group">
                                        <div class="input-group-addon" id="example-date-input">
                                            <i class="fa fa-calendar-o"></i>
                                        </div>
                                            <input type="date" name="tgl_lahir" placeholder="" class="form-control col col-md-5" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div class="input-group">
                                        <textarea name="alamat" id="" rows="5" placeholder="alamat" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto <small>[disarankan 1x1(</i>square</i>)]</small></label>
                                    <div class="input-group m-0">
                                            <input type="file" name="gambar" class="form-control inputGambar border" accept="image/*" style="border:0; overflow: hidden;">
                                    </div>
                                    <div class="input-group">
                                        <img class="col-md-3 ml-5 mt-2 previewGambar" src="#">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="text" id="" name="email" placeholder="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" id="" name="password" placeholder="password" class="form-control" required>
                                    </div>
                                </div>
                                <input type="text" name="role" value="Customer" hidden>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                            </form>
                            <hr>
                            <div class="register-link">
                                <p>
                                    Sudah punya <i>account</i>?
                                    <a href="login.php">Login Disini</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include("include/js.php");?>

</body>

</html>