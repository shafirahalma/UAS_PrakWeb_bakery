<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-2">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form action="aksi_register.php" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nama" id="inputName" type="text" placeholder="Full name" />
                                            <label for="inputName">Full Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="inputUsername" type="text" placeholder="username" />
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="cekpassword" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="tgl_lahir" id="inputTgl" type="text" placeholder="Date of Birth" />
                                            <label for="inputTgl">Date of Birth</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="alamat" id="inputAlamat" type="text" placeholder="Address" />
                                            <label for="inputAlamat">Address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="kota" id="inputTelp" type="text" placeholder="Phone Number" />
                                            <label for="inputUsername">Asal Kota</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="telepon" id="inputTelp" type="text" placeholder="Phone Number" />
                                            <label for="inputUsername">Phone Number</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select name="jk" class="form-control" id="inputJk" type="text" placeholder="Phone Number">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <label for="inputUsername">Gender</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="role" id="inputRole" type="text" placeholder="Admin" value="Admin" readonly />
                                            <label for="inputUsername">Role</label>
                                        </div>

                                        <div class="mt-2 mb-0">

                                            <div class="d-grid"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="home.php">Back to dashboard</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>