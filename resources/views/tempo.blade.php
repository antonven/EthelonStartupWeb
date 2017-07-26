<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>

<body>

<form method="POST" action="{{url('/register')}}">
{{csrf_field()}}

<input type="text" class="form-control" id="name" name="name">
<input type="text" class="form-control" id="name" name="email">
<input type="text" class="form-control" id="name" name="password">

<button type="submit">Register </button>


</form>

</body>
</html>