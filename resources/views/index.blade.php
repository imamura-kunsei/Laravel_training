<head>
	<meta charset="UTF-8">
	<title>タスク管理ツール</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<h1>タスク一覧</h1>
	<h2 id="message"></h2>
	<form>
		<div>
			<label for="due_date" class="form-check-label">ステータス</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="all"><input class="form-check-input" type="radio" value="all" id="all" name="status" {{ $selected_status == 'all' ? 'checked' : '' }} />全て</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="not-started"><input class="form-check-input" type="radio" value="0" id="not-started" name="status" {{ $selected_status == 0 ? 'checked' : '' }}/>未着手</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="progress"><input class="form-check-input" type="radio" value="1" id="progress" name="status" {{ $selected_status == 1 ? 'checked' : '' }}/>進行中</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="completion"><input class="form-check-input" type="radio" value="2" id="completion" name="status" {{ $selected_status == 2 ? 'checked' : '' }}/>完了</label>
		</div>
		<div>
			<label for="due_date" class="form-check-label">並び替え（期限）</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="asc"><input class="form-check-input" type="radio" value="0" id="asc" name="sort" {{ $selected_sort == 0 ? 'checked' : '' }} />昇順（古→新）</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label" for="desc"><input class="form-check-input" type="radio" value="1" id="desc" name="sort" {{ $selected_sort == 1 ? 'checked' : '' }} />降順（新→古）</label>
		</div>
		<div>
			<button type="submit" class="btn btn-secondary">検索</button>
		</div>
	</form>
	<form action="{{ url('tasks/add') }}" method="get" class="form-example">
		<button type="submit" class="btn btn-primary"></i>新規作成</button>
	</form>
	<div class="flex justify-center">
		<table class="table table-striped">
			<tr>
				<th>タイトル</th>
				<th>期限</th>
				<th>ステータス</th>
				<th>編集</th>
				<th>削除</th>
			</tr>
		@foreach ($tasks as $task)
			<tr>
				<td>{{ $task->title }}</td>
				<td>{{ $task->due_date }}</td>
				<td>
					<select class="form-select" name="{{ $task->id }}" id="{{ $task->id }}" class="form-control" onchange="status_update({{ $task->id }})">
						@foreach ($status as $key => $val)
							@if ($key == $task->status)
								<option value="{{ $key }}" selected="selected">{{ $val }}</option>
								@else
								<option value="{{ $key }}">{{ $val }}</option>
								@endif
						@endforeach
					</select>
				</td>
				<td>
					<form action="{{ url('tasks/edit/' . $task->id . '') }}" method="get">
						<button type="submit" class="btn btn-secondary"></i>編集</button>
					</form>
				</td>
				<td>
					<form action="{{ url('tasks/delete/' . $task->id . '') }}" method="post">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-danger" onClick="return Check()"><i class="fa fa-pencil"></i>削除</button>
					</form>
				</td>
			</tr>
		@endforeach
		</table>
		{{$tasks->appends(request()->query())->links()}}
	</div>
</div>
<script>
	function status_update(task_id) {
        let target_status = $('#'+task_id).val();
        console.log(target_status);
        $.ajax({
            type: "PATCH",
            url: "tasks/update/"+task_id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                status: target_status,
            },
        })
        .done(function(res) {
            console.log('success!');
            let message = res.title+'の状態が更新されました。'
			$("#message").text(message);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Ajax request failed:", textStatus, errorThrown);
            alert("通信に失敗しました。");
        });
	}
	function Check(){
      var checked = confirm("削除します");
      if (checked == true) {
          return true;
      } else {
          return false;
      }
  }
</script>
</body>