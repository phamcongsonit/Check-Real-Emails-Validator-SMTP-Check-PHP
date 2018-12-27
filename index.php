<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Email Validator</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>
		#wrapper{
			padding:20px 0;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Email Validator</h1>

					<form action="" id="check-email-form">
						<div class="form-group">
							<label for="">Email</label>
							<textarea name="email" id="email" class="form-control" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block">Check Email(s)</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Result</h1>
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Email</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody class="tbody-data">
							<tr>
								<td>1</td>
								<td>psnsn@gmail.com</td>
								<td><span class="badge badge-success">Success</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(function(){
			$("#check-email-form").submit(function(e){
				e.preventDefault();
				$(".tbody-data").html('');
				emails = $("#email").val().split("\n");
				$.each(emails, function(index, email){
					$(".tbody-data").append("<tr><td>" + (index  + 1 )+ "</td><td>" + email + "</td><td class='email-" + index +"'>Handling ... </td></tr>");
					email = $.trim(email);
					if (email != '') {
						$.ajax({
							url: "handle.php",
							type: "post",
							data: {
								email: email,
								index: index
							}
						}).done(function(result){
							switch(result.code){
								case 0:
									$(".email-" + result.index).html('<span class="badge badge-danger">Fail</span>');
									break;
								case 1:
									$(".email-" + result.index).html('<span class="badge badge-success">Success</span>');
									break;
								case 2:
									$(".email-" + result.index).html('<span class="badge badge-warning">Server dont allow</span>');
									break;
								case 3:
									$(".email-" + result.index).html('<span class="badge badge-dark">Cant connect server</span>');
									break;
							}
						})
					}
				})
				
				
				return false;
			})
		})
	</script>
</body>
</html>


