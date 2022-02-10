<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Reservas</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <style>
    html {
      line-height: 1.15;
      -webkit-text-size-adjust: 100%;
    }

    a {
      background-color: transparent
    }

    [hidden] {
      display: none
    }

    html {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
      line-height: 1.5
    }

    *,
    :after,
    :before {
      box-sizing: border-box;
      border: 0 solid #e2e8f0
    }

    a {
      color: inherit;
      text-decoration: inherit
    }

    svg,
    video {
      display: block;
      vertical-align: middle
    }

    video {
      max-width: 100%;
      height: auto
    }

    .border-t {
      border-top-width: 1px
    }

    .flex {
      display: flex
    }

    .grid {
      display: grid
    }

    .hidden {
      display: none
    }

    .items-center {
      align-items: center
    }

    .justify-center {
      justify-content: center
    }

    .font-semibold {
      font-weight: 600
    }

    .h-5 {
      height: 1.25rem
    }

    .h-8 {
      height: 2rem
    }

    .h-16 {
      height: 4rem
    }

    .text-sm {
      font-size: .875rem
    }

    .text-lg {
      font-size: 1.125rem
    }

    .leading-7 {
      line-height: 1.75rem
    }

    .mx-auto {
      margin-left: auto;
      margin-right: auto
    }

    .ml-1 {
      margin-left: .25rem
    }

    .mt-2 {
      margin-top: .5rem
    }

    .mr-2 {
      margin-right: .5rem
    }

    .ml-2 {
      margin-left: .5rem
    }

    .mt-4 {
      margin-top: 1rem
    }

    .ml-4 {
      margin-left: 1rem
    }

    .mt-8 {
      margin-top: 2rem
    }

    .ml-12 {
      margin-left: 3rem
    }

    .-mt-px {
      margin-top: -1px
    }

    .max-w-6xl {
      max-width: 72rem
    }

    .min-h-screen {
      min-height: 100vh
    }

    .overflow-hidden {
      overflow: hidden
    }

    .p-6 {
      padding: 1.5rem
    }

    .py-4 {
      padding-top: 1rem;
      padding-bottom: 1rem
    }

    .px-6 {
      padding-left: 1.5rem;
      padding-right: 1.5rem
    }

    .pt-8 {
      padding-top: 2rem
    }

    .fixed {
      position: fixed
    }

    .relative {
      position: relative
    }

    .top-0 {
      top: 0
    }

    .right-0 {
      right: 0
    }

    .shadow {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
    }

    .text-center {
      text-align: center
    }

    .text-gray-200 {
      --text-opacity: 1;
      color: #edf2f7;
      color: rgba(237, 242, 247, var(--text-opacity))
    }

    .text-gray-300 {
      --text-opacity: 1;
      color: #e2e8f0;
      color: rgba(226, 232, 240, var(--text-opacity))
    }

    .text-gray-400 {
      --text-opacity: 1;
      color: #cbd5e0;
      color: rgba(203, 213, 224, var(--text-opacity))
    }

    .text-gray-500 {
      --text-opacity: 1;
      color: #a0aec0;
      color: rgba(160, 174, 192, var(--text-opacity))
    }

    .text-gray-600 {
      --text-opacity: 1;
      color: #718096;
      color: rgba(113, 128, 150, var(--text-opacity))
    }

    .text-gray-700 {
      --text-opacity: 1;
      color: #4a5568;
      color: rgba(74, 85, 104, var(--text-opacity))
    }

    .text-gray-900 {
      --text-opacity: 1;
      color: #1a202c;
      color: rgba(26, 32, 44, var(--text-opacity))
    }

    .underline {
      text-decoration: underline
    }

    .antialiased {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale
    }

    .w-5 {
      width: 1.25rem
    }

    .w-8 {
      width: 2rem
    }

    .w-auto {
      width: auto
    }

    .grid-cols-1 {
      grid-template-columns: repeat(1, minmax(0, 1fr))
    }

    @media (min-width:640px) {
      .sm\:rounded-lg {
        border-radius: .5rem
      }

      .sm\:block {
        display: block
      }

      .sm\:items-center {
        align-items: center
      }

      .sm\:justify-start {
        justify-content: flex-start
      }

      .sm\:justify-between {
        justify-content: space-between
      }

      .sm\:h-20 {
        height: 5rem
      }

      .sm\:ml-0 {
        margin-left: 0
      }

      .sm\:px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem
      }

      .sm\:pt-0 {
        padding-top: 0
      }

      .sm\:text-left {
        text-align: left
      }

      .sm\:text-right {
        text-align: right
      }
    }

    @media (min-width:768px) {
      .md\:border-t-0 {
        border-top-width: 0
      }

      .md\:border-l {
        border-left-width: 1px
      }

      .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr))
      }
    }

    @media (min-width:1024px) {
      .lg\:px-8 {
        padding-left: 2rem;
        padding-right: 2rem
      }
    }

    body {
      font-family: 'Nunito', sans-serif;
      background-position: center;
      background-repeat: repeat-y;
      background-size: cover;
    }

  </style>
</head>

<body class="antialiased" style="background-image: url({{asset('img/calendar.jpg')}});">
  <div class="relative flex justify-center py-4 items-top"
    style="background-color:white; opacity: 0.7;">
    @if (Route::has('login'))
      <div class="fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
          <a href="{{ url('/dashboard') }}" class="text-sm text-gray-800">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="text-sm text-gray-800">{{ __('Login') }}</a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-800">{{ __('Register') }}</a>
          @endif
        @endauth
      </div>
    @endif
  </div>

  <div class="mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-center pt-8 text-gray-800 sm:justify-start sm:pt-0">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-auto h-16" fill="rgb(147 51 234)" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <h1 class="text-xl">RSRV</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2" style="background-color: #1a202c; opacity: 0.7; border-radius: 1rem;">
      <div class="p-6">
        <div class="flex items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
            <path
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
            </path>
          </svg>
          <div class="ml-4 text-lg font-semibold leading-7 text-gray-200">Información</div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-gray-300">
            Información de contacto
          </div>
        </div>
      </div>

      <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
            <path
              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
            </path>
            <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          <div class="ml-4 text-lg font-semibold leading-7 text-gray-200">Equipo</div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-gray-300">
            Quienes somos...
          </div>
        </div>
      </div>

      <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
            <path
              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
          </svg>
          <div class="ml-4 text-lg font-semibold leading-7 text-gray-200">Imágenes</div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-gray-300">
            Espacio reservado para imágenes
          </div>
        </div>
      </div>

      <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
            <path
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
            </path>
          </svg>
          <div class="ml-4 text-lg font-semibold leading-7 text-gray-200">Pide tu Usuario</div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-gray-300">
            Pide tu usuario para acceder al sistema. <br>
            Anímate, es muy fácil.
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="ml-4 text-sm text-center text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div> --}}
  </div>

</body>

</html>
