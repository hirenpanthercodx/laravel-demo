@extends('Layouts.app')
{{-- @section('content') --}}
<div class="bodyMain">
    <div class="main"> 
        <form method="post" action="{{ url('/user/login') }}">
            @csrf
            <h3>Welcome to ELEOS</h3> 
            <h6>Please log-in to your account</h6> 
            <div class="mt-3">
                <label for="email">Email </label> 
                <input type="text" 
                    class="form-control"
                    name="email" 
                    placeholder="Enter your email" required
                > 
            </div>
            <div class="my-3">
                <label for="password">Password:</label> 
                <input type="password"
                    class="form-control"
                    name="password" 
                    placeholder="Enter your Password" required
                > 
            </div>
            <div class="mb-2"> 
                <input type="submit" role="button" name="login" class="btn btn-success w-100" value="Login" />
            </div> 
            <p>Not registered?  
                <a href="register" style="text-decoration: none;">Create an account</a> 
        </p> 
        </form>
    </div> 
</div>
{{-- @endsection --}}