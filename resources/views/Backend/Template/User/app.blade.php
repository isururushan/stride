

<!DOCTYPE html>
<html lang="en">

@include('Backend.Template.User.header')


<body>

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->


    <div id="app_vue_js">

         <!--  BEGIN NAVBAR  -->
    @include('Backend.Template.User.headnav')

    <!--  BEGIN NAVBAR  -->
    @include('Backend.Template.User.subheader')
    <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN SIDEBAR  -->
            @include('Backend.Template.User.sidebar')
            <!--  END SIDEBAR  -->

            <!--  END SIDEBAR  -->

                @yield('content')

        </div>
        <!-- END MAIN CONTAINER -->
    </div>

</body>

@include('Backend.Template.User.script')


</html>
