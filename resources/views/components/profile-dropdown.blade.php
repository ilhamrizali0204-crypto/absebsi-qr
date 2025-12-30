<div class="dropdown-menu dropdown-menu-end p-3 shadow-lg"
     style="width: 250px; border-radius: 12px;">

    <div class="text-center mb-2">
        <div class="rounded-circle bg-primary mx-auto d-flex justify-content-center align-items-center"
             style="width: 70px; height: 70px; color: white; font-size: 26px; font-weight: bold;">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
    </div>

    <h6 class="text-center mb-0">{{ Auth::user()->name }}</h6>
    <p class="text-center text-muted mb-3" style="font-size: 14px;">
        {{ Auth::user()->email }}
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn w-100 text-white" 
                style="background: #e74c3c; border-radius: 8px;">
            <i class="fa fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>
</div>
