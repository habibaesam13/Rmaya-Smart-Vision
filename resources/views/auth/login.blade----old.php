{{-- <x-guest-layout>--}}
{{-- <!-- Session Status -->--}}
{{-- <x-auth-session-status class="mb-4" :status="session('status')" />--}}
{{-- <form method="POST" action="{{ route('admin.login') }}">--}} {{-- @csrf--}}
{{-- <!-- Email Address -->--}}
{{-- <div>--}}
{{-- <x-input-label for="email" :value="__('Email')" />--}}
{{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{-- <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{-- </div>--}}
{{-- <!-- Password -->--}}
{{-- <div class="mt-4">--}}
{{-- <x-input-label for="password" :value="__('Password')" />--}}
{{-- <x-text-input id="password" class="block mt-1 w-full"--}}
{{-- type="password"--}}
{{-- name="password"--}}
{{-- required autocomplete="current-password" />--}}
{{-- <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{-- </div>--}}
{{-- <!-- Remember Me -->--}}
{{-- <div class="block mt-4">--}}
{{-- <label for="remember_me" class="inline-flex items-center">--}}
{{-- <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{-- <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}} {{-- </label>--}}
{{-- </div>--}}
{{-- <div class="flex items-center justify-end mt-4">--}}
{{-- @if (Route::has('password.request'))--}}
{{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}} {{-- {{ __('Forgot your password?') }}--}} {{-- </a>--}}
{{-- @endif--}}
{{-- <x-primary-button class="ms-3">--}}
{{-- {{ __('Log in') }}--}} {{-- </x-primary-button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </x-guest-layout>--}} @extends('admin.auth.master') @php $settings = \App\Models\SiteSettings::first(); // dd($settings); @endphp @section('content') 

<style>
  html,
  body {
    overflow-x: hidden;
  }

  body {
    background-color: #f3f6f8;
  }

  ::-webkit-scrollbar {
    width: 10px;
    overflow-x: hidden;
  }

  ::-webkit-scrollbar-track {
    background: #202020;
  }

  ::-webkit-scrollbar-thumb {
    background: #aa2633;
    border-radius: 10px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #aa2633;
  }

  html {
    scrollbar-width: thin;
    scrollbar-color: #aa2633 #202020;
  }

  ::selection {
    background: transparent;
    color: inherit;
  }


 .line-text {
    position: relative;
    text-align: center;
    color: #fff;
    background-color: transparent;
    padding: 0.5rem 2rem;
    max-width: 100%;
    /* overflow: hidden; */
    margin: 15px auto 0 auto;
    font-weight: 600;
    font-size: 18px;
  }

  .line-text::before,
  .line-text::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #fff;
  }

  .line-text::before {
    right: 80%;
    margin-right: 1rem;
  }

  .line-text::after {
    left: 80%;
    margin-left: 1rem;
  }

  .basic-container {
    margin-top: 15px;
    display: flex;
    flex-direction: row;
    align-items: flex-end !important
  }

  .basic-container input[type="checkbox"] {
    margin-left: 10px;
    appearance: none;
    width: 20px;
    height: 20px;
    background-color: #eee;
    border: 1px solid #fff;
    border-radius: 6px;
    position: relative;
    cursor: pointer;
    vertical-align: middle
  }

  .basic-container input[type="checkbox"]:checked {
    border-color: #202020;
    background-color: #202020
  }

  .basic-container input[type="checkbox"]:checked::after {
    content: "✓";
    position: absolute;
    color: #fff;
    font-size: 14px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: 700
  }

  .basic-container label {
    color: #fff;
    padding-left: 15px;
    cursor: pointer
  }

  .basic-container input[type="checkbox"]:checked+label {
    color: #fff
  }

  #particles-js {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: 50% 50%;
    position: fixed;
    top: 0px;
    z-index: 0;
  }


  .container {
    position: relative;
    width: 850px;
    height: 420px;
    background-color: #aa2633;
    border-radius: 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    overflow: hidden;
  }

  .form-box {
    position: absolute;
    height: 100%;
    width: 50%;
    background: #aa2633;
    right: 0;
    display: flex;
    align-items: center;
    color: #fff;
    text-align: center;
    padding: 40px;
    z-index: 1;
    border: 0 !important;
    transition: 0.5s ease-in-out 1s, visibility 0s 1s;
  }

  .container.active .form-box {
    right: 50%;
  }

  .form-box.register {
    visibility: hidden;
  }

  .container.active .form-box.register {
    visibility: visible;
  }

  form {
    width: 100%;
  }

  .container h1 {
    font-size: 33px;
    display: inline-block;
    position: relative;
    font-weight: bold;
    text-transform: uppercase;
  }

  .container h1::after {
    content: '';
    height: 1px;
    width: 30%;
    background: #fff;
    position: absolute;
    left: calc(50% - 10%);
    bottom: -10px;
  }

  .container h2 {
    font-weight: bold;
    line-height: 25px;
    font-size: 33px;
    text-transform: uppercase;
  }

  .container h3 {
    font-weight: bold;
    line-height: 25px;
    font-size: 20px;
    text-transform: uppercase;
  }

  .input-box {
    position: relative;
    margin: 10px 0;
  }

  .input-box input {
    width: 100%;
    padding: 13px 50px 13px 20px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    border-bottom: 1px solid #fff !important;
  }

  .input-box input::placeholder {
    color: #fff;
    font-weight: 400;
  }

  .input-box i {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
    color: #fff;
  }

  .forget-link {
    margin: -15px 0 15px;
  }

  .forget-link a {
    font-size: 12.5px;
    color: #79373a;
    text-decoration: none;
  }

  .btn {
    width: 100%;
    height: 48px;
    background-color: #202020;
    border-radius: 8px;
    box-shadow: 0 0 10px rgb(0, 0, 0, 0.1);
    font-size: 14px;
    border: none;
    cursor: pointer;
    color: #fff;
    font-weight: 600;
    margin-top: 30px;
    color: #fff;
  }

  .btn:hover {
    color: #202020;
    background-color: #fff;
  }

  .container p {
    font-size: 12.5px;
    margin: 15px 0;
  }

  .wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100vh;
  }

  .toggle-box {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .toggle-box::before {
    content: "";
    position: absolute;
    width: 300%;
    height: 100%;
    left: -250%;
    border-radius: 110px;
    background-color: #202020;
    z-index: 2;
    transition: 1.4s ease-in-out;
  }

  .container.active .toggle-box::before {
    left: 50%;
  }

  .toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 2;
    transition: 0.5s ease-in-out;
  }

  .toggle-panel.toggle-left {
    left: 0;
    transition-delay: 1s;
  }

  .container.active .toggle-panel.toggle-left {
    left: -50%;
    transition-delay: 0.5s;
  }

  .toggle-panel.toggle-right {
    right: -50%;
    transition-delay: 0.5s;
  }

  .container.active .toggle-panel.toggle-right {
    right: 0;
    transition-delay: 1s;
  }

  .toggle-panel p {
    margin-bottom: 20px;
  }

  .toggle-panel .btn {
    width: 160px;
    height: 40px;
    background: transparent;
    border: 2px solid #aa2633;
    color: #efdbbf;
    box-shadow: none;
  }

  .toggle-panel .btn:hover {
    background: transparent;
    border: 2px solid #505050;
    color: #fff;
    box-shadow: none;
  }

  @media screen and (max-width: 650px) {
      .container h3 {
    margin-bottom: 0;
    font-size: 18px;}
      
.line-text{margin: 5px auto 0 auto;}

      .wrapper {
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: center;
    min-height: 100dvh; 
    padding: 20px;
  }


    .container {
      height: calc(80vh - 40px);
      width: 100%;
        display: flex;
    justify-content: center;
    }

    .form-box {
      width: 100%;
      height: -webkit-fill-available;
    }

    .container.active .form-box {
      right: 0;
      bottom: 30%;
    }

    .toggle-box::before {
      left: 0;
      top: -260%;
      width: 100%;
      height: 300%;
      border-radius: 100px;
    }

    .container.active .toggle-box::before {
      left: 0;
      top: 70%;
    }

    .toggle-panel {
      width: 100%;
      height: 40%;
    }

    .toggle-panel.toggle-left {
      top: 0;
    }

    .container.active .toggle-panel.toggle-left {
      left: 0;
      top: -30%;
    }

    .toggle-panel.toggle-right {
      right: 0;
      bottom: -30%;
    }

    .container.active .toggle-panel.toggle-right {
      bottom: 0;
    }
  }

  @media screen and (max-width: 400px) {
    .form-box {
     padding: 270px 20px 20px 20px;
    }

    .toggle-panel h1 {
      font-size: 30px;
    }
  }

  input:-webkit-autofill {
    color: #fff !important;
    background: transparent !important;
    -webkit-text-fill-color: #fff !important;
    transition: background-color 5000s ease-in-out 0s;
  }

 
</style>
<div class="wrapper ">
  <div class="container">
    <div class="form-box login">
      <form action="">
        <h1>SIGN IN</h1>
        <div class="input-box">
          <input type="text" placeholder="Username" required>
          <i class="ri-user-line"></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" required>
          <i class="ri-lock-line"></i>
        </div>
        <div class="basic-container ">
          <input type="checkbox" name="" value="Remember me">
          <label> Remember me </label>
        </div>
        <button type="submit" class="btn">
          <i class="ri-login-circle-line"></i> &nbsp;&nbsp; Login </button>
      </form>
    </div>
    <div class="toggle-box">
      <div class="toggle-panel toggle-left">
        <p>
          <a href="index.html" class="auth-brand mb-4">
            <span class="logo-lg"> @if($settings && $settings->logo) <img src="{{ asset('settings/'.$settings->logo) }}" alt="Logo"> @else <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="Default Logo"> @endif </span>
          </a>
        </p>
        <h2> Fujairah </h2>
        <h3> Culture and Media Authority </h3>
        <div class="line-text form-floating"> FCMA </div>
      </div>
    </div>
  </div>
</div>
<div id="particles-js"></div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
  $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function() {
    particlesJS('particles-js', {
      "particles": {
        "number": {
          "value": 100,
          "density": {
            "enable": true,
            "value_area": 500
          }
        },
        "color": {
          "value": "#aa2633"
        },
        "shape": {
          "type": "circle",
          "stroke": {
            "width": 0,
            "color": "#202020"
          },
          "polygon": {
            "nb_sides": 5
          },
          "image": {
            "width": 100,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 5,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": "#ccc",
          "opacity": 0.4,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": true,
            "mode": "repulse"
          },
          "onclick": {
            "enable": true,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 100
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true,
      "config_demo": {
        "hide_card": false,
        "background_color": "#b61924",
        "background_image": "",
        "background_position": "50% 50%",
        "background_repeat": "no-repeat",
        "background_size": "cover"
      }
    });
  });
</script>
<div class="container">
  <div class="row ">
    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
      <form method="POST" action="{{ route('admin.login') }}" class="text-start mb-3"> @csrf <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <input type="email" id="email" class="block mt-1 w-full form-control" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email">
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="d-flex justify-content-between mb-3">
          <div class="form-check">
            {{-- <input type="checkbox" class="form-check-input" id="checkbox-signin">--}}
            {{-- <label class="form-check-label" for="checkbox-signin">Remember me</label>--}}
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Remember me</label>
          </div>
          <!--<a href="auth-recoverpw.html" class="text-muted border-bottom border-dashed">Forget Password</a>--> @if (Route::has('password.request')) <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
          </a> @endif
        </div>
        <div class="d-grid">
          <button class="btn btn-primary fw-semibold" type="submit">Login</button>
        </div>
      </form>
      {{-- <p class="text-muted fs-14 mb-4">Don't have an account? 
															<a href="auth-register.html" class="fw-semibold text-danger ms-1">Sign Up !</a>
														</p>--}}
      {{-- <div class="block mt-4">--}}
      {{-- <label for="remember_me" class="inline-flex items-center">--}}
      {{-- <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
      {{-- <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}} {{-- </label>--}}
      {{-- </div>--}}
      <div class="flex items-center justify-end mt-4"> @if (Route::has('password.request')) <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a> @endif {{-- <x-primary-button class="ms-3">--}}
        {{-- {{ __('Log in') }}--}} {{-- </x-primary-button>--}}
      </div>
      {{-- <p class="mt-auto mb-0">--}}
      {{-- <script>document.write(new Date().getFullYear())</script> © Highdmin - By 
																<span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Coderthemes</span>--}}
      {{-- </p>--}}
    </div>
    <a href="index.html" class="auth-brand mb-4">
      <span class="logo-lg"> @if($settings && $settings->logo) <img src="{{ asset('settings/'.$settings->logo) }}" alt="Logo"> @else <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="Default Logo"> @endif </span>
    </a>
  </div>
</div> @endsection