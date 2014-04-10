@extends('layouts.master')

@section('content')
<form role="form" action="{{ url('auth') }}" method="post">
   <div class="form-group">
      <label for="client_id">Username</label>
      <input type="username" name="username" class="form-control" id="username" placeholder="Enter username" />
   </div>
   <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
   </div>
   <div class="form-group">
   	 <button id="login_btn" type="submit" class="btn btn-primary">Login</input>
   </div>
</form>