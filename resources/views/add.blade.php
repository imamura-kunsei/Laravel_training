<!Doctype html>
<head>
	<meta charset="UTF-8">
	<title>タスク管理ツール</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1>タスク登録</h1>
		@if ($errors->any())
   			<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif
		<form action="{{ url('tasks/add') }}" method="post" class="form-example">
			{{ csrf_field() }}
			<div class="mb-3">
				<label for="title" class="form-label">タイトル</label>
				<input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"/>
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">詳細</label>
				<textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
			</div>
			<div class="mb-3">
				<label for="due_date" class="form-label">期限</label>
				@if ($errors->any())
					<input type="date" id="due_date" class="form-control" name="due_date" value="{{ old('due_date') }}">
				@else
					<input type="date" id="due_date" class="form-control" name="due_date" value="<?php echo date('Y-m-j');?>">
				@endif
			</div>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>登録</button>
				<a href="{{ url('/tasks') }}" class="btn btn-secondary">キャンセル</a>
			</div>
		</form>
	</div>
</body>