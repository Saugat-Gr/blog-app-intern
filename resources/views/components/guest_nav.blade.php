<nav class="navbar bg-danger-subtle">
  <div class="container-fluid justify-content-between align-items-center">
  
    <div class="d-flex gap-3 align-items-center"> 
        <a class="navbar-brand text-dark" href="#">
           Gates And Policies
        </a>
    </div>

  

    <div class="btn-group d-flex gap-4 ">
        <button type="button" class="btn btn-light dropdown-toggle ml-2 border rounded text-dark" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <!-- <li><button class="dropdown-item" type="button"> <a href="#" class="text-decoration-none text-dark">Edit User </a></button></li> -->
            <li>
                <button class="dropdown-item" type="button"> <a href="{{ route('auth.login') }}" class="text-decoration-none text-dark text-center">Login</a> </button>
            </li>
          </ul>

    </div>
  </div>
</nav>