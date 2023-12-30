
@extends('layout')

@section('content')








<div class="container vh-100 d-flex">
    <div class="card p-3  m-auto">
     <form class="w-100" action="{{ route('login')}}"  method="POST">
      @csrf
     
        <h1 class="text-center ">LOGIN FORM</h1>
     
 
     <div class="mb-3" >
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter you email...." required/>
     </div>
     <div class="mb-3">
      <label for="password" class="form-label" >Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter you password...." required/>
     </div>      
       <button type="submit" class="btn btn-primary w-100" name="submit">LOGIN</button>
       <p class="text text-center mt-3">Don't have an account ?<a href="{{ route('register')}}" class=""> Register</a></p>
    </form> 
    </div>
    
  </div>


  @endsection