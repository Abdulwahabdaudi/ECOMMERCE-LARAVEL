@extends('layout')

@section('content')


  
  <div class="container vh-100 d-flex">
    <div class="card p-3  m-auto">
        <form class="w-100" action="{{ route('register')}}" method="POST">
            @csrf
         
                <h1 class="text-center ">REGISTER FORM</h1>
                
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter you name...." required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter you email...." required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter you password...." required />
            </div class="">
            <button type="submit" class="btn btn-primary w-100" name="submit">REGISTER</button>
            <p class="text text-center mt-3">Have an account ?<a href="{{ route('login')}}" class=""> Login</a></p>
        </form>
    </div>

@endsection