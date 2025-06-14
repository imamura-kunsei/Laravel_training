# タスク管理ツール
ログインユーザーごとのタスクを管理できます。
## タスク一覧画面
タスクの一覧が確認できます。
- ログインユーザーのタスクが自動的に絞り込まれます。
- ステータス（「全て」「未着手」「進行中」「完了」）で絞り込みができます。
- 期限の並べ替え（古→新、新→古）ができます。
- 新規作成ボタンを押下するとタスク登録画面へ遷移します。
- 一覧内のステータスはセレクトボックスになっており、変更すると非同期で更新されます（更新が成功するとメッセージが表示されます）。
- 編集ボタンを押下すると、そのタスクのタスク編集画面へ遷移します。
- 削除ボタンを押下すると、そのタスクを削除します（削除前に確認ダイアログが表示されます）。
- ３件ごとにページネーションを実装しています。
## タスク登録画面
タスクの新規登録ができます。
- タイトルは必須項目で255文字以下、期限は必須項目で本日以降での入力が可能です。
- 上記が守られていない状態で新規登録ボタンを押下すると、エラーメッセージが表示されます（登録できません）。
- ステータスは自動で「未着手」として登録されます。
## タスク編集画面
既存のタスクの編集ができます。
- 該当のタスクのタイトル、詳細、期限、ステータスが反映された状態で表示されます。
- タイトルは必須項目で255文字以下、期限は必須項目で本日以降での入力が可能です。
- 上記が守られていない状態で新規登録ボタンを押下すると、エラーメッセージが表示されます（登録できません）。
