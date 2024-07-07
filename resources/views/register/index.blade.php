<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
    <title>Dashboard | {{ $title }}</title>
</head>
<body>
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #b90505;">
           <div class="featured-image mb-3">
            <img src="/img/1.png" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;"></p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Selamat datang di Dashboard Stok Barang, Silahkan Daftar</small>
       </div> 
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4 text-center"> 
                     <img src="/img/2.png" style="width:150px" class="me-2"></img></p>
                </div>
                <form action="/register" method="post">
                    @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control form-control-lg bg-light fs-6 @error('name')
                    is-invalid @enderror" id="name" placeholder="Nama" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                         {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control form-control-lg bg-light fs-6  @error('username')
                    is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                  @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                </div>
                @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control form-control-lg bg-light fs-6 @error('email')
                    is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                </div>
                @enderror
            </div>
                <div class="input-group mb-3">
                    <input type="password"  name="password" class="form-control form-control-lg bg-light fs-6 @error('password')
                    is-invalid @enderror" id="password" placeholder="Kata Sandi" required>
                    @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                </div>
                @enderror
            </div>
                <div class="input-group mb-4">
                    <button class="btn btn-lg btn-danger w-100 fs-7" type="submit">Daftar</a></button>
                </form>
                </div>
                <div class="input-group mb-3">
        
                </div>
                <div class="row">
                    <small>Sudah Daftar? <a href="/login">Masuk</a></small>
                </div>
          </div>
         
       </div> 
      </div>
    </div>
</body>
</html>