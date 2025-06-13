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
		<h1>タスク編集</h1>
		@if ($errors->any())
   			<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif
		<form action="{{ url('tasks/edit/' . $task->id . '') }}" method="post" class="form-example">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="mb-3">
				<label for="title" class="form-label">タイトル</label>
				<input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title) }}"/>
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">詳細</label>
				<textarea id="description" name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
			</div>
			<div class="mb-3">
				<label for="due_date" class="form-label">期限</label>
				<input type="date" id="due_date" class="form-control" name="due_date" value="{{ old('due_date', $task->due_date) }}">
			</div>
			<div class="mb-3">
				<div>
					<label for="due_date" class="form-check-label">ステータス</label>
				</div>
				<div class="form-check form-check-inline">
					<label for="not-started">
						<input type="radio" value="0" id="not-started" name="status" class="form-check-input" {{ old('status', $task->status) == 0 ? 'checked' : '' }}/>
					未着手</label>
				</div>
				<div class="form-check form-check-inline">
					<label for="progress" class="form-check-label">
						<input type="radio" value="1" id="progress" name="status" class="form-check-input" {{ old('status', $task->status)== 1 ? 'checked' : '' }}/>
					進行中</label>
				</div>
				<div class="form-check form-check-inline">
					<label for="completion" class="form-check-label">
						<input type="radio" value="2" id="completion" name="status" class="form-check-input" {{ old('status', $task->status) == 2 ? 'checked' : '' }}/>
					完了</label>
				</div>
			</div>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary"></i>登録</button>
				<a href="{{ url('/tasks') }}" class="btn btn-secondary">キャンセル</a>
			</div>
		</form>
	<div class="container">
</body>