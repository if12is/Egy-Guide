@extends('layouts.app')

@section('title', 'Welcome to EgyGuide')

@section('content')
    <div class="d-flex justify-content-center align-items-center text-center text-info">
        <img src="https://images.pexels.com/photos/5983865/pexels-photo-5983865.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
            width="100%" height="300px" alt="bg">
        <h1 class="text-info">Welcome to EgyGuide</h1>
        <p>Dear {{ $user->name }},</p>
        <p>Thank you for registering on EgyGuide. We're excited to have you as a member!</p>
        <p>If you have any questions or concerns, please don't hesitate to contact us.</p>
        <p>Best regards,</p>
        <p>The EgyGuide Team</p>
    </div>
@endsection
