<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
  <div class="container py-2">
    <a class="navbar-brand fw-bold" href="#" style="letter-spacing: 3px;"><img class="me-2" src="assets/logo.jpg" height="50" alt="" id="logo"> ALUTRANSCO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white"><i class="fas fa-calendar-alt me-2"></i><?= date("F d, Y") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="trip">Daily Trips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="payroll">Payroll</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="employee">Employees</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="bus">Buses</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="deduction">Deductions</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Adminstrator
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="credentials">Credentials</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="php/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>