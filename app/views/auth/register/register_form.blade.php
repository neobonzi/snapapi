@extends('layouts.master')

@section('content')
{{ Form::open(array('url' => 'bootstrap/register')) }}
	<div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" />
   </div>
   <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" />
   </div>
   <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
   </div>
   <div class="form-group">
   	 <button id="login_btn" type="submit" class="btn btn-primary">Login</input>
   </div>
{{ Form::close() }}