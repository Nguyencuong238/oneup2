<style>
    .sign-in{
        background: #006ea4;
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        border-radius: 5px;
        padding: 12px 22px;
        text-transform: uppercase;
        float:right;
    }
</style>
<div class="header-main">
    <div class="container">
        <!-- Header Logo Start -->
        <div class="header--logo float--sm-none mt-4" >
            <a href="#" class="logo-text">
                <img src="{{asset('images/logo.png')}}" alt="logo" width="160px">
            </a>
            <div class="sign-in">
                <a href="{{ route('login') }}" style="text-decoration: none; color: white">Sign in</a>
            </div>
        </div>
        
        <!-- Header Logo End -->

        <!-- Header Ad Start -->
        <!-- Header Ad End -->
    </div>
</div>