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
{{-- <a  href="{{ route('password.request') }}">--}} {{-- {{ __('Forgot your password?') }}--}} {{-- </a>--}}
{{-- @endif--}}
{{-- <x-primary-button class="ms-3">--}}
{{-- {{ __('Log in') }}--}} {{-- </x-primary-button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </x-guest-layout>--}} 
@extends('auth.master') @php $settings = \App\Models\SiteSettings::first(); // dd($settings); @endphp @section('content')
<style>
  html,
  body {
    overflow-x: hidden;
  }

  body {
  background-color: #f3f6f8;
  background-image:url({{ asset('admin/assets/images/bg-login.jpg') }});
  background-size: cover;    
  background-repeat: no-repeat; 
  background-position: center;  
  height: 100vh;               
  margin: 0;                   
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
    padding: 10px;
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
    right: 10px;
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
      .container p {
    margin: 0 0;
}

   .container h3 {
        margin-bottom: 0;
        font-size: 16px;
    }
.line-text::before, .line-text::after {
    width: 34%;}
   .line-text {
        margin: 0;
    padding: 0.1rem 2rem;
    }
    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      height: calc(100vh - 40px);
      width: 100%;
      display: flex;
      justify-content: center;
    }
.toggle-panel p {
    margin-bottom: 10px;
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
        top: -270%;
        width: 100%;
        height: 300%;
        border-radius: 80px;
    }


    .container.active .toggle-box::before {
      left: 0;
      top: 70%;
    }

    .toggle-panel {
      width: 100%;
      height: 31%;
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
<div class="wrapper">
  <div class="container">
    <div class="form-box login">
      <form method="POST" action="{{ route('login') }}"> @csrf <h1>تسجيل الدخول</h1>
        <div class="input-box">
          <label class="class="d-none" for="email"></label>
          <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Username">
          <i class="ri-user-line pt-3"></i>
        </div>
        <div class="input-box">
          <label for="password" class="d-none"></label>
          <input type="password" id="password" type="password" name="password" required autocomplete="current-password" placeholder="password">
          <i class="ri-lock-line"></i>
        </div>
        <div class="basic-container">
          <input type="checkbox" id="remember_me" value="yes" name="remember">
          <label  for="remember_me">Remember me</label>
        </div> @if (Route::has('password.request')) 
        <!--<a href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a> -->
        @endif <button type="submit" class="btn">
          <i class="ri-login-circle-line"></i> &nbsp;&nbsp; دخـــــــــول </button>
      </form>
    </div>
    <div class="toggle-box">
      <div class="toggle-panel toggle-left">
        <p>
          <a href="index.html" class="auth-brand mb-4">
            <span class="logo-lg"> @if($settings && $settings->logo) <img src="{{ asset($settings->logo) }}" alt="Logo"> @else <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="Default Logo"> @endif </span>
          </a>
        </p>
        <h2> ميادين الريف للرماية </h2>
        <h3> 2025</h3>
        <div class="line-text form-floating"> Rmaya Management System </div>
      </div>
    </div>
  </div>
</div>
<!--<div id="particles-js"></div>-->
@endsection