<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema GED - Página Inicial</title>
		<meta name="viewport" content="width=device-width=initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" /> 
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>

		<div class="container">
			<div id="tableManager" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Country Name</h2>
							<!-- modal-title -->
						</div>
						<!-- modal-header -->
						<div class="modal-body">
							<input type="text" class="form-control" placeholder="Country Name..." id="countryName" /><br />
							<!-- countryName -->
							<textarea class="form-control" id="shortDesc" placeholder="Short Country Decription"></textarea><br />
							<!-- shortDesc -->
							<textarea class="form-control" id="longDesc" placeholder="Long Country Decription"></textarea>
							<!-- longDesc -->
						</div>
						<!-- modal-body -->
						<div class="modal-footer">
							<input type="button" onclick="manageData('addNew')" class="btn btn-success" value="Save" />
						</div>
						<!-- modal-footer -->
					</div>
					<!-- modal-content -->
				</div>
				<!-- modal-dialog -->
			</div>
			<!-- tableManager -->

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2>MySQL Table Manager</h2>
					<input type="button" class="btn btn-success" id="addNew" value="Add New" />
					<!-- addNew -->	
					<br /><br />
					<table class="table table-hover table-bordered">
						<thead>
							<td>ID</td>
							<td>Contry Name</td>
							<td>Options</td>
						</thead>
					</table>
					<!-- table -->
				</div>
				<!-- col-md-8 -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#addNew").on('click', function(){
					$("#tableManager").modal("show");
				});
			});

			function manageData(key) {
				var countryName = $("#countryName");
				var shortDesc = $("#shortDesc");
				var longDesc = $("#longDesc");

				if (isNotEmpty(countryName) && isNotEmpty(shortDesc) && isNotEmpty(longDesc)) {
					$.ajax({
						url: 'ajax.php',
						method: 'POST',
						dataType: 'text',
						data: {
							key: key,
							countryName: countryName.val(),
							shortDesc: shortDesc.val(),
							longDesc: longDesc.val()
						}, success: function (response) {
							alert(response);
						}
					});
				}

			}

			// checa se há campos vazios
			function isNotEmpty(caller) {
				if (caller.val() == '') {
					// adiciona uma borda vermelha aos campos vazios
					caller.css('border', '1px solid red');
					return false;
				} else 
					caller.css('border', '');

				return true;
			}
		</script>
	</body>
</html>