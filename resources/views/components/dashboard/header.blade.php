<div class="dashboard-header">
    <div class="d-flex">
        <a href="#menu-toggle" id="menu-toggle"><img src="{{asset('images/menu.svg')}}" alt="" /></a>
        <h2 class="my-0 mx-2 mx-lg-4">Dashboard</h2>
    </div>
    <p class="user-profile m-0">{{ auth()->user()->name }}</p>
</div>