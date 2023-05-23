<div class="dashboard-header">
    <div class="d-flex">
        <a href="#menu-toggle" id="menu-toggle"><img src="{{asset('images/menu.svg')}}" alt="" /></a>
        <h2 class="my-0 mx-2 mx-lg-4">Dashboard</h2>
    </div>
    <div class="d-flex">
        <p class="user-profile mx-2 mx-sm-4 my-0">{{ auth()->user()->name }}</p>
        <form id="logout" action="/logout" method="post">
            @csrf
            <input type="hidden" value="Logout">
            <div class="">
                <a href="javascript:;" onclick="document.getElementById('logout').submit();"><img src="{{asset('images/Logout.svg')}}" class="logout " alt="" />
                </a>
            </div>
        </form>
    </div>
</div>