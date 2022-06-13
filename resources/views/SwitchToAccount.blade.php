<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Beltraide Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 400px;
    margin: 120px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
.bg_image  {
	background-image: url("assets/login-back.jpeg");  
}
</style>
</head>
<body class="bg_image">
<div class="">
<div class="login-form">
    <form action="{{url('/SwitchToAccount')}}" method="post">
    {{ csrf_field() }}
        <h4 class="text-center">Please Select Profile</h4>
        <hr>
        <input type="hidden" class="form-control form-control2" name="email" value="{{$email->email}}"/>        
        <div class="form-group">
        <input  type="radio" name="usertype" value="seller" id="option1" >
        <label class="form-check-label" for="option1">&nbsp;<b>As Seller</b></label>
        </div>
        <div class="form-group">
        <input  type="radio" name="usertype" value="buyer" id="option2">
        <label class="form-check-label" for="option2">&nbsp;<b>As Buyer</b></label>
        </div>
        <div class="form-group">
        <input  type="radio" name="usertype" value="trainee" id="option3">
        <label class="form-check-label" for="option3">&nbsp;<b>As Trainee</b></label>
        </div>
        <div class="form-group">
        <input  type="radio" name="usertype" value="investor" id="option4">
            <label class="form-check-label" for="option4">&nbsp;<b>As Investor</b> </label>
        </div>
		<hr>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Continue To Log in</button>
        </div>
    </form>
</div>
</div>
</body>
</html>