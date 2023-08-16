<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FullCalendar</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- FullCalendar ライブラリのスクリプトを追加 -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- vite用の記述忘れずに -->
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
        }
        a {
            color: blue; /* リンクの色を設定 */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- ユーザーの家族の役割を表示 -->
    <div id="family-role" style="display: none;">{{ auth()->user()->family_role }}</div>

    <!-- カレンダーを表示 -->
    <div id='calendar'></div>

    <!-- FullCalendarのスクリプト -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const familyRole = document.getElementById('family-role').innerText;

            // FullCalendarの初期化
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    // ここに予定のデータを追加するオブジェクトを記述
                ],
                eventContent: function(arg) {
                    // イベントの表示をカスタマイズ
                    const familyRole = document.getElementById('family-role').innerText;
                    const eventEl = document.createElement('div');
                    eventEl.innerText = arg.event.title + ' (' + familyRole + ')';
                    return { domNodes: [eventEl] };
                }
            });

            calendar.render();
        });
    </script>

    <!-- カレンダー新規追加モーダル -->
    <div id="modal-add" class="modal">
        <!-- ... ここにモーダルの内容を追加 ... -->
    </div>

    <!-- カレンダー編集モーダル -->
    <div id="modal-update" class="modal">
        <div class="modal-contents">
            <form method="POST" action="{{ route('update') }}" >
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id" value="" />
                <label for="event_title">タイトル</label>
                <input class="input-title" type="text" id="event_title" name="event_title" value="" />
                <label for="start_date">開始日時</label>
                <input class="input-date" type="date" id="start_date" name="start_date" value="" />
                <label for="end_date">終了日時</label>
                <input class="input-date" type="date" id="end_date" name="end_date" value="" />
                <label for="event_body" style="display: block">内容</label>
                <textarea id="event_body" name="event_body" rows="3" value=""></textarea>
                <button type="button" onclick="closeUpdateModal()">キャンセル</button>
                <button type="submit">決定</button>
            </form>
        </div>
    </div>
    @foreach($schedules as $schedule)
    <a href="{{ route('show', ['id' => $schedule->id]) }}">予定の詳細を表示</a>
    @endforeach

    <style>
        /* モーダルのオーバーレイ */
        .modal {
            display: none;
            justify-content: center;
            align-items: center;
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        /* モーダル */
        .modal-contents {
            background-color: white;
            height: 400px;
            width: 600px;
            padding: 20px;
        }

        /* 以下モーダル内要素のデザイン調整 */
        input, textarea, select {
            padding: 2px;
            border: 1px solid black;
            border-radius: 5px;
            width: 80%;
            margin-bottom: 20px;
        }
        .input-date {
            width: 27%;
            margin-right: 5px;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
        }
        .modal-buttons button {
            margin-left: 10px;
        }
        /* 予定の上ではカーソルがポインターになる */
        .fc-event-title-container {
            cursor: pointer;
        }
    </style>
</body>
</html>
