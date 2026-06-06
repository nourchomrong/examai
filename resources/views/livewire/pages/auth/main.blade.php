<div id="main-content" class="min-h-screen w-full m-0 sm:m-10 bg-white shadow lg:rounded-lg flex flex-col lg:flex-row">

    <!-- Left Side -->
    <div class="w-full lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col justify-center lg:rounded-l-lg">

        <!-- Logo -->
        <div class="flex flex-col items-center">
            <img src="{{ app(\App\Services\Setting::class)->logoUrl() }}" style="width:200px">
        </div>

        <!-- Title -->
        <div class="flex flex-col items-center mt-6">
            <h1 class="text-2xl xl:text-3xl font-extrabold text-center">Welcome Back!</h1>

            <div class="w-full flex-1 mt-6">
                <div class="mx-auto max-w-xs w-full">

                            <a href="{{ route('joinexam') }}" class="mt-5 w-full py-4 border border-indigo-500 text-indigo-500 rounded-lg flex justify-center items-center gap-2">Join Exam</a>

                         <p class="mt-6 text-sm text-indigo-500 text-center">Or</p>

                            <a href="{{ route('login') }}" class="mt-5 w-full py-4 bg-indigo-500 text-white rounded-lg flex justify-center items-center gap-2">Login</a>

                        <p class="mt-6 text-xs text-gray-600 text-center">
                             By logging in, you agree to our 
                             <a href="#" class="border-b border-gray-500 border-dotted">Terms of Service</a> and <a href="#" class="border-b border-gray-500 border-dotted">Privacy Policy</a>.
                           
                        </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Right Side Image -->
    <div class="flex-1 hidden lg:flex bg-indigo-100 justify-center items-center lg:rounded-r-lg">
        <div class="w-full h-full bg-cover bg-center"
            style="background-image:url('{{ app(\App\Services\Setting::class)->urlForPath('image', 'background.jpg') }}')"></div>
    </div>

</div>