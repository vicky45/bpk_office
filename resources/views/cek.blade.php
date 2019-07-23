<html>
<head>
	<title>Tutorial Laravel #24 : Relasi One To Many Eloquent</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
				<h5 class="text-center my-4">Eloquent One To Many Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Judul Article</th>
							<th>Tag</th>
							<th width="15%" class="text-center">Jumlah Tag</th>
						</tr>
					</thead>
					<tbody>
                                            @foreach ($artikel as $ev)
                                        <h5><b>{{$ev->name_event}}</b></h5>
                                        <h6>{{$ev->date_event}}</h6>
                                        <h6>{{$ev->location}}</h6> 
                                        <h6>#{{$ev->code_event}}</h6> 
                                        <h6>{{$ev->name_speaker}}</h6>
                                            @endforeach
                                            
                                            @foreach ($ev->SpeakerModel as $s)
                                            {{$s->name_speaker}}
                                            @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
 
</body>
</html>