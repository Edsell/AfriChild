<!doctype html>
<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="{{ asset('bootstrap/assets') }}/"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>@yield('title', 'Login') | {{ config('app.name') }}</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon.png') }}" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/fonts/iconify-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('bootstrap/assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  @stack('styles')

  <script src="{{ asset('bootstrap/assets/vend_or/js/helpers.js') }}"></script>
  <script src="{{ asset('bootstrap/assets/js/config.js') }}"></script>

  <style>
    /* Cover background */
    .auth-cover-bg{
      background:
        linear-gradient(135deg, rgba(17,24,39,.90), rgba(17,24,39,.62)),
        url('{{ asset('assets/auth-bg.jpg') }}');
      background-size: cover;
      background-position: center;
      position: relative;
      overflow: hidden;
      border-radius: 1rem;
      min-height: 560px;
    }
    .auth-cover-bg::after{
      content:"";
      position:absolute;
      inset:-80px;
      background:
        radial-gradient(circle at 18% 20%, rgba(105,108,255,.28), transparent 55%),
        radial-gradient(circle at 82% 72%, rgba(32, 201, 151, .18), transparent 60%);
      filter: blur(2px);
      pointer-events:none;
    }
    .auth-cover-content{ position: relative; z-index: 1; }
    .auth-mini-footer{ font-size: .82rem; }
    .auth-badge{ font-size: .70rem; letter-spacing: .03em; }
    .auth-lead{ opacity: .92; }
  </style>
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-cover py-6 py-md-10">
      <div class="authentication-inner">
        <div class="row g-0 align-items-stretch shadow-sm rounded-4 overflow-hidden bg-white">

          {{-- LEFT: Branding + mission (desktop only) --}}
          <div class="col-lg-7 d-none d-lg-flex">
            <div class="auth-cover-bg w-100 p-8">
              <div class="auth-cover-content d-flex flex-column h-100">

                <div class="d-flex align-items-center gap-3 mb-8">
                  <img
                    src="{{ asset('assets/icon.png') }}"
                    alt="AfriChild Logo"
                    style="width:48px;height:auto"
                    class="rounded" />
                  <div>
                    <h4 class="mb-0 text-white">{{ config('app.name') }}</h4>
                    <div class="text-white auth-lead">Centre of Excellence in the study of the African child</div>
                  </div>
                </div>

                <div class="mb-7">
                  <h3 class="text-white mb-2">Research that strengthens policy and practice.</h3>
                  <p class="text-white mb-0 auth-lead">
                    Access your secure workspace to manage knowledge, publications, programs, and evidence
                    that improves child welfare, protection, education, and health across Africa.
                  </p>
                </div>

                <div class="row g-4 mb-8">
                  <div class="col-6">
                    <div class="d-flex gap-3">
                      <span class="avatar avatar-sm">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-book-content"></i></span>
                      </span>
                      <div>
                        <div class="text-white fw-semibold">Knowledge & Publications</div>
                        <div class="text-white small auth-lead">Reports, briefs, and learning resources</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="d-flex gap-3">
                      <span class="avatar avatar-sm">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-network-chart"></i></span>
                      </span>
                      <div>
                        <div class="text-white fw-semibold">Partners & Programs</div>
                        <div class="text-white small auth-lead">Coordination and delivery tracking</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="d-flex gap-3">
                      <span class="avatar avatar-sm">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-bar-chart-alt-2"></i></span>
                      </span>
                      <div>
                        <div class="text-white fw-semibold">Evidence & Insights</div>
                        <div class="text-white small auth-lead">Dashboards, indicators, and analysis</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="d-flex gap-3">
                      <span class="avatar avatar-sm">
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-lock-alt"></i></span>
                      </span>
                      <div>
                        <div class="text-white fw-semibold">Secure Access</div>
                        <div class="text-white small auth-lead">Roles, permissions, and activity trails</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-auto d-flex align-items-center justify-content-between">
                  <span class="badge bg-label-light auth-badge">EVIDENCE • LEARNING • IMPACT</span>
                  <div class="text-white small auth-lead">
                    <i class="bx bx-shield-quarter me-1"></i> Protected workspace
                  </div>
                </div>

              </div>
            </div>
          </div>

          {{-- RIGHT: Login form --}}
          <div class="col-lg-5 d-flex align-items-center">
            <div class="w-100 p-6 p-md-8">

              <div class="app-brand justify-content-center mb-5">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <span class="text-primary">
                      <img src="{{ asset('assets/icon.png') }}" style="width: 42px;height:auto;" alt="AfriChild">
                    </span>
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">{{ config('app.name') }}</span>
                </a>
              </div>

              <h4 class="mb-1">Welcome back</h4>
              <p class="mb-5 text-muted">
                Sign in to access the AfriChild CMS dashboard.
              </p>

              <x-auth-session-status class="mb-4" :status="session('status')" />

              <form method="POST" action="{{ route('login') }}" class="mb-5">
                @csrf

                <div class="mb-4">
                  <label for="email" class="form-label">Email or Username</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input
                      type="text"
                      class="form-control @error('email') is-invalid @enderror"
                      id="email"
                      name="email"
                      value="{{ old('email') }}"
                      placeholder="e.g. research@africhild.org"
                      autofocus
                      autocomplete="username" />
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-key"></i></span>
                    <input
                      type="password"
                      id="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      placeholder="Enter password"
                      autocomplete="current-password" />
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Toggle password">
                      <i class="bx bx-hide" id="togglePasswordIcon"></i>
                    </button>
                    @error('password')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="remember-me">Remember me</label>
                  </div>

                  @if (Route::has('password.request'))
                    <a class="small" href="{{ route('password.request') }}">Forgot password?</a>
                  @endif
                </div>

                <button class="btn btn-primary w-100" type="submit">
                  <i class="bx bx-log-in-circle me-1"></i> Login
                </button>
              </form>

              <div class="text-center text-muted auth-mini-footer">
                © {{ date('Y') }} {{ config('app.name') }}. {{-- Powered by Dev Impressions Ltd. --}}
              </div>
              <div class="text-center text-muted auth-mini-footer mt-1">
                <i class="bx bx-support me-1"></i> Need help? Contact your system administrator.
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  {{-- Core JS --}}
  <script src="{{ asset('bootstrap/assets/vend_or/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('bootstrap/assets/vend_or/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('bootstrap/assets/vend_or/js/bootstrap.js') }}"></script>
  <script src="{{ asset('bootstrap/assets/js/main.js') }}"></script>

  <script>
    (function () {
      const btn = document.getElementById('togglePassword');
      const input = document.getElementById('password');
      const icon = document.getElementById('togglePasswordIcon');
      if (!btn || !input || !icon) return;

      btn.addEventListener('click', function () {
        const isPassword = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPassword ? 'text' : 'password');
        icon.classList.toggle('bx-hide', !isPassword);
        icon.classList.toggle('bx-show', isPassword);
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>
