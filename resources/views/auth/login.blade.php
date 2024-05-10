<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        :root {
            --magenta: #3f43fd;
            --magenta-hover: #3235dd;
            --secondary: #808080;
        }
    
        .btn {
            border: none;
            padding: 12px 24px !important;
            border-radius: 8px;
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-main {
            background-color: var(--magenta) !important;
            border: 1px solid var(--magenta) !important;
            color: #fff !important;
        }

        .btn-main:hover {
            background-color: var(--magenta-hover) !important;
        }

        .form-control,
        .form-control::placeholder {
            font-size: 1.2rem !important;
        }

        .background {
            background-color: #f0f0f0;
        }
    
    </style>  

</head>
<body>
    <section class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-sm-6 d-flex flex-column justify-content-center text-black">
      
              <div class="d-flex flex-column justify-content-start gap-2 px-5">
                <div class="d-flex flex-column align-items-start">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/Logo1_RBG.png') }}" alt="Logo" width="50px" height="50px">
                        <span class="h1 fw-bold mb-0">Sistem Bantuan Sosial</span>
                    </div>
                    <div class="px-2 mt-2 mb-4">
                        <span class="fs-4 fw-semi-bold"><code>Halo Pengurus Sisban</code>👋</span>
                        <p>Ayo segera masuk, Kemudian lakukan manajemen bantuan sosial. Kami akan selalu bersama untuk membuat manajemen <cite class="d-inline fw-bold">Bantuan Sosial</cite> menjadi lebih mudah dan menyenangkan</p>
                    </div>
                </div>

                @if(isset($error))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Login Gagal!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                  
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-3 px-2">
                        <x-label for="email" class="fs-5">Email</x-label>
                        <x-input type="email" name="email" placeholder="Masukkan Email Anda"/>

                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>Terdapat Kesalahan!</strong> {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 px-2">
                        <x-label for="password" class="fs-5">Password</x-label>
                        <x-input type="password" name="password" placeholder="Masukkan Password Anda"/>

                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>Terdapat Kesalahan!</strong> {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                    <div class="px-2">
                        <button type="submit" class="btn btn-main w-100">Login</button>
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        <a href="{{ url('forgot-password') }}">Lupa Password?</a>
                    </div>
                </form>
              </div>
      
            </div>
            <div class="background col-lg-8 col-sm-6 px-0 d-none d-sm-flex align-items-center justify-content-center vh-100">
              <img src="{{ asset('assets/img/LoginPage.png') }}"
                alt="Login image" style="object-fit: cover; object-position: left; width: 85%">
            </div>
          </div>
        </div>
      </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>