<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}"">
    <div class="sidebar-brand-icon ">
      <i class="fas fa-building"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Library</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Accounts
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-user"></i>
      <span>Employees</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        @if (Auth::user()->level->priority == 1)
        <a class="collapse-item" href="{{ url('/level/list') }}">Levels Management</a>
        @endif
        <a class="collapse-item" href="{{ url('/employee/register') }}">Add an Employee</a>
        <a class="collapse-item" href="{{ url('/employee/list') }}">Employee List</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
      aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-user-circle"></i>
      <span>Students</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ url('/class/list') }}">Classes Management</a>
        <a class="collapse-item" href="{{ url('/student/list') }}">Student Management</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Products
  </div>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooks" aria-expanded="true"
      aria-controls="collapseBooks">
      <i class="fas fa-fw fa-book"></i>
      <span>Books</span>
    </a>
    <div id="collapseBooks" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ url('/kind/list') }}">Kinds Management</a>
        <a class="collapse-item" href="{{ url('/book/list') }}">Books Management</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRentals" aria-expanded="true"
      aria-controls="collapseRentals">
      <i class="fas fa-handshake"></i>  
      <span>Rental</span>
    </a>
    <div id="collapseRentals" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ url('/rental/create') }}"><i class="fas fa-edit"></i> Rental Management</a>
        <a class="collapse-item" href="{{ url('/rental/history') }}"><i class="fas fa-fw fa-history"></i> History</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>