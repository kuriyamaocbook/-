<!-- create_form.blade.php -->

<form action="{{ route('calendar.create') }}" method="post">
    @csrf
    <!-- フォームフィールドを追加 -->
    <button type="submit">登録する</button>
</form>
