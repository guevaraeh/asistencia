<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 topbar" data-bs-theme="dark">
  <div class="container-fluid">
    @if(auth()->user()->is_admin)
    <span class="navbar-brand mb-0 h1">Administrador</span>
    @else
    <span class="navbar-brand mb-0 h1">Profesor</span>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        
      @can('manage-assistance')
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi-person"></i> Profesores
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('teacher') }}">Lista</a></li>
            <li><a class="dropdown-item" href="{{ route('teacher.create') }}">Crear profesor</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi-card-checklist"></i> Asistencias
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('assistance_teacher') }}">Lista</a></li>
            <li><a class="dropdown-item" href="{{ route('assistance_teacher.create') }}">Crear asistencia</a></li>
          </ul>
        </li>
      </ul>
      @endcan
      <ul class="navbar-nav ms-auto navbar-right">
        <form id="nav-logout" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link"><i class="bi-box-arrow-left"></i> Cerrar Sesión</button>
        </form>
      </ul>

      </ul>
    </div>
  </div>
</nav>